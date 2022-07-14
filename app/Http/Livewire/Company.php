<?php

namespace App\Http\Livewire;
use Livewire\WithPagination;
use App\Models\Company as Company_model;
use Livewire\Component;

class Company extends Component
{
    public $name; 
    public $sort_name; 
    public $address; 
    public $register_date; 
    public $url_server; 
    public $checkbox_crud = false; 
    public $id_update; 

    public function render()
    {
        return view('livewire.company.index');
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
            'sort_name' => 'required',
        ]);

        $createCompany = [
            'pid' => $this->get_pid("COMP"),
            'company_name' => $this->name,
            'company_sort_name' => $this->sort_name,
            'address' => $this->address,
            'register_date' => $this->register_date,
            'url_server' => $this->url_server,
        ];
        $role = Company_model::create($createCompany);


       
        
        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    }
    public function edit($id)
    {
        $this->updateMode = true;
        $result = Company_model::where('pid',$id)->first();
        $this->id_update = $id;
        $this->name = $result->company_name;        
        $this->sort_name = $result->company_sort_name;        
        $this->address = $result->address;        
        $this->register_date = $result->register_date;        
        $this->url_server = $result->url_server;        
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

            $result = Company_model::where('pid', $this->id_update)->first();
            $result->update([
                'company_name' => $this->name,
                'company_sort_name' => $this->sort_name,
                'address' => $this->address,
                'register_date' => $this->register_date,
                'url_server' => $this->url_server,
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
            Company_model::where('pid',$id)->delete();
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
