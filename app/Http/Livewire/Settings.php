<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\Company;
use Auth;

class Settings extends Component
{

    public $keys; 
    public $text; 
    public $tags; 
    public $company;     
    public $company_pid;
    public $id_update = false;
    public $selectCompany = [];

    

    public function render()
    {
        $this->selectCompany = Company::select2()->get();
        return view('livewire.settings.index');
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
            'keys'     => 'required',
            'text'     => 'required',
            'tags'     => 'required',
        ]);

        $setting = Setting::create([
            'keys' => $this->keys,
            'text' => $this->text,
            'tags' => $this->tags,
            'company_pid' => $this->company ?? Auth::user()->details->company_pid,
        ]);

        if (!empty($this->role)) {
            $setting->assignRole($this->role);
        }

        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $setting = Setting::where('id',$id)->first();
        $this->id_update = $id;
        $this->keys = $setting->keys;
        $this->text = $setting->text;
        $this->tags  = $setting->tags;
        $this->company = $setting->company_pid;
        
        // echo print_r($setting->roles->first()->id);
    }

    public function cancel()
    {
        $this->id_update = false;
        $this->resetInputFields();

    }

    public function update()
    {
        $validatedDate = $this->validate([
            'keys' => 'required',
            'text' => 'required',
        ]);

        if ($this->id_update) {

            $setting = Setting::where('id', $this->id_update)->first();
            $setting->update([
                'keys' => $this->keys,
                'text' => $this->text,
                'company_pid' => $this->company ?? Auth::user()->details->company_pid,
                'tags' => $this->tags,
            ]);

            // $setting->givePermissionTo('add');

            if (!empty($this->role)) {
                $setting->roles()->detach();
                $setting->assignRole($this->role);
            }

            
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
            
            $this->resetInputFields();

        }
    }


    private function resetInputFields(){
        $this->name = '';
        $this->keys = '';
        $this->password = '';
        $this->role = '';
    }

    public function delete($id)
    {
        if($id){
            Setting::where('id',$id)->delete();
            session()->flash('message', 'Settings Deleted Successfully.');
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
        }
    }

}
