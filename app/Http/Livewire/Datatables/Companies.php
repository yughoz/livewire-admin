<?php

namespace App\Http\Livewire\Datatables;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\Company as Company_model;

class Companies extends LivewireDatatable
{
    public $model = Company_model::class;
  
    public $module_name = "user";
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            NumberColumn::name('pid')
                ->label('ID')
                ->sortBy('pid'),
            Column::name('company_name'),
            Column::name('address'),
            DateColumn::name('modified')
                ->label('Update Date'),
            Column::callback(['pid'], function ($pid) {
                return view('livewire.helpers.table-actions', ['id' => $pid, 'module_name' => $this->module_name]);
            })
        ];
    }
}
