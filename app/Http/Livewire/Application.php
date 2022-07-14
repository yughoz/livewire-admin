<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MsApplication;

class Application extends Component
{
    public $name; 
    public $id_update; 
    public function render()
    {
        return view('livewire.application');
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

        $createData = [
            'pid' => $this->get_pid("Apps"),
            'name' => $this->name,
        ];
        $result = MsApplication::create($createData);
        
        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $result = MsApplication::where('pid',$id)->first();
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

            $result = MsApplication::where('pid', $this->id_update)->first();
            // $result->update([
            //     'name' => $this->name,
            // ]);

            $result->name = $this->name;
            $result->save();
            
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
            
            $this->resetInputFields();

        }
    }


    private function resetInputFields(){
        $this->name = '';
        $this->id_update = false; 
    }

    public function delete($id = "123")
    {
        if($id){
            MsApplication::where('pid',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
        }
    }

    function get_pid($code=''){
        //format datetime
        // $datetime = new date();
        $datetime = date('Ymdhis');
        // format milliseconds
        $mt  = explode(' ', microtime());
        $mls = ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
        $mls = substr($mls, -3);

        return $code.$datetime.$mls;
    }
}
