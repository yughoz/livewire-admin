<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Company ;
use Auth;

class Roles extends Component
{
    
    public $name; 
    public $id_update; 
    public $company ;
    public $selectCompany = [];

    public function render()
    {
        $this->selectCompany = Company::select2()->get();
        return view('livewire.roles.index');
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
            'name'      => 'required',
        ]);

        $createRole = [
            'name' => $this->name,
            'guard_name' => 'web',
            'company_pid' => $this->company ?? Auth::user()->details->company_pid,
        ];
        $role = Role::create($createRole);
        
        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $result = Role::where('id',$id)->leftJoin('ms_company', 'company_pid', 'pid')->first();
        $this->id_update = $id;
        $this->name = $result->name;        
        $this->company = $result->company_pid; 
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
        ]);

        if ($this->id_update) {

            $result = Role::where('id', $this->id_update)->first();
            $result->update([
                'name' => $this->name,
                'company_pid' => $this->company ?? Auth::user()->details->company_pid,
            ]);
            
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
            
            $this->resetInputFields();

        }
    }


    private function resetInputFields(){
        $this->name = '';
        $this->company = '';
    }

    public function delete($id)
    {
        if($id){
            Role::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
        }
    }
    

    public function addPermission($id,$permission_id)
    {
        $role = Role::findById($id);
        $role->givePermissionTo($permission_id);
        $this->emit('reloadPermission');
    }

    public function removePermission($id,$permission_id)
    {
        $role = Role::findById($id);
        $role->revokePermissionTo($permission_id);
        $this->emit('reloadPermission');
    }


    
}
