<?php

namespace App\Http\Livewire\Datatables;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\UserManagement\User;
use Auth;

class Users extends LivewireDatatable
{
    public $model = User::class;
    public $module_name = "user";
    // ::with('roles')->latest()
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function builder()
    {
        $dataBuilder = User::query()->with('roles')
        ->leftJoin('users_detail', 'users_detail.user_id', 'users.id')
        ->leftJoin('ms_company', 'users_detail.company_pid', 'pid');
        if (!auth()->user()->can('all companies')) {
            $dataBuilder->where('company_pid' ,Auth::user()->details->company_pid);
        }
        return $dataBuilder;
    }

    public function columns()
    {
        return [
            
            Column::name('name'),
            Column::name('email'),
            Column::name('roles.name')->label('Role'),
            Column::name('ms_company.company_name')->label('Company'),
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('livewire.helpers.table-actions', ['id' => $id, 'module_name' => $this->module_name]);
            })
        ];
    }
}
