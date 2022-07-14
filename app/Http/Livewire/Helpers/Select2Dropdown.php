<?php

namespace App\Http\Livewire\Helpers;

use Livewire\Component;

class Select2Dropdown extends Component
{
    public $ottPlatform = '';
 
    public $selectData = [];   
    public $model ;
    public $label ; 

    public function render()
    {
        if ($this->model == "company") { 
            return view('livewire.company.select2-dropdown');
        }
        return view('livewire.helpers.select2-dropdown');
    }

    public function show_list()
    {
        
    }
}
