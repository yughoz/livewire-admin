<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    public $name; 
    public $checkbox_crud = false; 
    public $id_update; 
    public function render()
    {
        return view('livewire.permissions.index');
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

        if ($this->checkbox_crud) {
            $crud_label = ["read","create","update","delete"];
            foreach ($crud_label as $key => $value) {
                $createRole = [
                    'name' => $value." ".$this->name,
                    'guard_name' => 'web',
                ];
                $role = Permission::create($createRole);
            }
        } else {
            $createRole = [
                'name' => $this->name,
                'guard_name' => 'web',
            ];
            $role = Permission::create($createRole);
        }

       
        
        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $result = Permission::where('id',$id)->first();
        $this->id_update = $id;
        $this->name = $result->name;        
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

            $result = Permission::where('id', $this->id_update)->first();
            $result->update([
                'name' => $this->name,
            ]);
            
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
            
            $this->resetInputFields();

        }
    }


    private function resetInputFields()
    {
        $this->name = '';
        $this->id_update = false; 
        $this->checkbox_crud = false; 
    }

    public function delete($id)
    {
        if($id){
            Permission::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
        }
    }
}
