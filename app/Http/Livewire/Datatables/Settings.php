<?php

namespace App\Http\Livewire\Datatables;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Setting;
use Auth;

class Settings extends LivewireDatatable
{
    public $model = Setting::class;
    public $module_name = "user";
    // ::with('roles')->latest()
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function builder()
    {
        $dataBuilder = Setting::query()->with('roles')
        ->company()
        ->leftJoin('ms_company', 'company_pid', 'pid');
        return $dataBuilder;
    }

    public function columns()
    {
        return [
            
            Column::name('keys'),
            Column::name('text'),
            Column::name('tags'),
            Column::name('ms_company.company_name')->label('Company'),
            Column::callback(['id', 'keys'], function ($id, $name) {
                return view('livewire.helpers.table-actions', ['id' => $id, 'module_name' => $this->module_name]);
            })
        ];
    }
}
