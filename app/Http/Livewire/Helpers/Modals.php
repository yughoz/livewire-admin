<?php

namespace App\Http\Livewire\Helpers;

use Livewire\Component;

class Modals extends Component
{
    
    public $body;
    public $action;
    public $modal_id;
    public $module_code;
    public function render()
    {
        return view('livewire.helpers.modals');
    }
}
