<?php

namespace App\Http\Livewire\Datatables;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Auth;

class Roleselect extends LivewireDatatable
{ 
    public $model = Role::class;
    public $module_name = "role";
    public $action ;
    /**
     * Write code on Method
     *
     * @return response()
     */


    public function builder()
    {
        $dataBuilder =  Role::query()->with('roles')
        ->leftJoin('ms_company', 'company_pid', 'pid');

        if (!auth()->user()->can('all companies')) {
            $dataBuilder->where('company_pid' , Auth::user()->details->company_pid);
        }
        return $dataBuilder;
    }

    public function columns()
    {
        return [
            Column::name('name')->label('Name'),    
            Column::callback(['id','name'], function ($pid,$text) {
                return view('livewire.helpers.table-selection', ['id' => $pid, 'text' => $text,"module_name"=> $this->module_name]);
            }),
        ];
    }
}
