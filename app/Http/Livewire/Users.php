<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserManagement\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\Company;
use App\Models\Users_detail;
use Auth;

class Users extends Component
{

    public $email; 
    public $name; 
    public $password; 
    public $role ; 
    public $role_label ; 
    public $company ; 
    public $company_label ; 
    public $password_confirmation; 
    public $id_update = false;
    public $selectCompany = [];
    public $selectRole = [];   
    

    public function render()
    {
        
        $roles = Role::select('name as text', 'id as value');
    
        if (!auth()->user()->can('all companies')) {
            $roles->where('company_pid' ,Auth::user()->details->company_pid);
        }
        // $this->role_label = "woke";
        $this->selectRole = $roles->get();
        $this->selectCompany = Company::select2()->get();

        return view('livewire.users.index');
    }

    public function selectedAction($id,$text,$model)
    {
        if ($model == "company") {
            $this->company_label = $text;
            $this->company = $id;
        } else {
            $this->role_label = $text;
            $this->role = $id;
        }

    }
    
    public function get_data()
    {
        
    }
    


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate([
            'email'     => 'required|email',
            'name'      => 'required',
            'password'  => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Users_detail::create([
            'user_id' => $user->id,
            'company_pid' => $this->company ?? Auth::user()->details->company_pid,
        ]);

        if (!empty($this->role)) {
            $user->assignRole($this->role);
        }

        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::where('id',$id)
        ->leftJoin('users_detail', 'users_detail.user_id', 'users.id')
        ->leftJoin('ms_company', 'users_detail.company_pid', 'pid')
        ->first();
        $this->id_update = $id;
        $this->name = $user->name;
        $this->email = $user->email; 
        $this->role = $user->roles->first()->id ?? "";
        $this->role_label = $user->roles->first()->name ?? "";
        $this->company = $user->company_pid;
        $this->company_label = $user->company_name;
        
    }

    public function cancel()
    {
        $this->id_update = false;
        $this->resetInputFields();

    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($this->id_update) {

            $user = User::where('id', $this->id_update)->first();
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            $user->details->update([
                'company_pid' => $this->company ?? Auth::user()->details->company_pid,
            ]);

            if (!empty($this->role)) {
                $user->roles()->detach();
                $user->assignRole($this->role);
            }

            
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
            
            $this->resetInputFields();

        }
    }


    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
    }

    public function delete($id)
    {
        if($id){
            User::where('id',$id)->delete();
            Users_detail::where('user_id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
        }
    }

}
