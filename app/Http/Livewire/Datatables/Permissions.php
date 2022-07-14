<?php

namespace App\Http\Livewire\Datatables;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permissions extends LivewireDatatable
{
    public $model = Permission::class;
    public $module_name = "permission";
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
  
            Column::name('name'),
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('livewire.helpers.table-actions', ['id' => $id, 'module_name' => $this->module_name]);
            })
        ];
    }
}
