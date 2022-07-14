<?php

namespace App\Http\Livewire\Datatables;

use Livewire\Component;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use App\Models\MsApplication;

class Application extends LivewireDatatable
{
    public $model = MsApplication::class;
  
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
  
            Column::name('name'),
            Column::callback(['pid', 'name'], function ($pid, $name) {
                return view('livewire.helpers.table-actions', ['id' => $pid, 'name' => $name]);
            })
        ];
    }
}
