<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product as MP;
use Auth;

class Product_list extends Component
{

    public $link;     
    public $json;
    public $id_update = false;
    public $dataProduct = [];
    
    

    public function render()
    {
        $this->dataProduct = MP::get();

        return view('livewire.product_list.index');
    }
    
    public function get_data()
    {
        
    }


    public function get_img($image_json)
    {
        $imgarr = json_decode($image_json,true);

        return $imgarr[0];
    }
    


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // $this->validate([
        //     'link'     => 'required',
        // ]);

        $jsonData = json_decode($this->json);
     
        // dd($jsonData->data);
        $prodGet = Mp::where('itemid',$jsonData->data->itemid)->first();

        if ($prodGet) {
            $prodGet->update([
                'itemid' => $jsonData->data->itemid,
                'name' => $jsonData->data->name,
                'local_name' => $jsonData->data->name,
                'price' => $jsonData->data->price,
                'stock' => $jsonData->data->stock,
                'rating_start' => $jsonData->data->item_rating->rating_star,
                'historical_sold' => $jsonData->data->historical_sold,
                'shop_location' => $jsonData->data->shop_location,
                'description' => $jsonData->data->description,
                'images' => json_encode($jsonData->data->images),
            ]);
        } else {
            $product = MP::create([
                'itemid' => $jsonData->data->itemid,
                'name' => $jsonData->data->name,
                'local_name' => $jsonData->data->name,
                'price' => $jsonData->data->price,
                'stock' => $jsonData->data->stock,
                'rating_start' => $jsonData->data->item_rating->rating_star,
                'historical_sold' => $jsonData->data->historical_sold,
                'shop_location' => $jsonData->data->shop_location,
                'description' => $jsonData->data->description,
                'images' => json_encode($jsonData->data->images),
            ]);
        }




        $this->resetInputFields();
        $this->emit('reloadAll');
        $this->emit('refreshLivewireDatatable');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $setting = Mp::where('id',$id)->first();
        $this->id_update = $id;
        $this->link = $setting->link;
        $this->text = $setting->text;
        $this->tags  = $setting->tags;
        $this->company = $setting->company_pid;
        
        // echo print_r($setting->roles->first()->id);
    }

    public function cancel()
    {
        $this->id_update = false;
        $this->resetInputFields();

    }

    public function update()
    {
        $validatedDate = $this->validate([
            'link' => 'required',
            'text' => 'required',
        ]);

        if ($this->id_update) {

            $setting = Mp::where('id', $this->id_update)->first();
            $setting->update([
                'link' => $this->link,
                'text' => $this->text,
                'company_pid' => $this->company ?? Auth::user()->details->company_pid,
                'tags' => $this->tags,
            ]);

            // $setting->givePermissionTo('add');

            if (!empty($this->role)) {
                $setting->roles()->detach();
                $setting->assignRole($this->role);
            }

            
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
            
            $this->resetInputFields();

        }
    }


    private function resetInputFields(){
        $this->json = '';
        $this->link = '';
    }

    public function delete($id)
    {
        if($id){
            Mp::where('id',$id)->delete();
            session()->flash('message', 'Mps Deleted Successfully.');
            $this->emit('reloadAll');
            $this->emit('refreshLivewireDatatable');
        }
    }

}
