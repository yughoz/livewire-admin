<?php

namespace App\Http\Livewire\CustomEdition;

use Livewire\Component;
use App\Models\ApiFlag;

class Markets extends Component
{
    public function render()
    {
        $datas = $this->get_data();
        $datas['last_flag'] = ApiFlag::orderByDesc('updated_at')
        ->limit(5)->get();
        return view('livewire.custom-edition.markets',$datas);
    }


	public function get_data()
	{
		// echo "woke";

		$pair_id = $_GET['pair_id'] ?? false;
		$from_url = $_GET['from'] ?? false;

        $url = 'https://indodax.com/api/summaries';
        if ($pair_id) {
            // echo $pair_id;die;
            $url = 'https://indodax.com/api/ticker/'.$pair_id."idr";
        }

        // echo $url ;die;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_HTTPHEADER => $headers,
            CURLOPT_URL => $url,
            // CURLOPT_POST => true,
            // CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true
        ));

        $response = curl_exec($curl);
            // echo $response ;die;    

        curl_close($curl);
        // echo $response ;die;    
        $json = json_decode ($response);

        


        $tradplus = [];
        $rekomend = [];

        if ($pair_id) {
            if ($json->error) {
                echo $response ;die;    
            }
            $margin = ($json->ticker->sell - $json->ticker->buy)/$json->ticker->buy * 100;
            $tradplus[] = [
                "key" => $pair_id,
                "percent" => $margin,
                $json->ticker
            ] ;
        }

        foreach ($json->tickers as $key => $value) {
            $checkidr = explode("_",$key);

            if ($checkidr[1] == "idr") {

                if ($value->last > 100 || $pair_id) {
                    $margin = ($value->sell - $value->buy)/$value->buy * 100;
                    if ($margin > 1 &&  $value->vol_idr > 1000000000) {
                        $rekomend[] = [
                            "key" => $key,
                            "last" => number_format($value->last),   
                            "name" => $value->name,   
                            "difference" => $margin,
                            "volume" => $this->custom_number_format($value->vol_idr,0),
                        ] ;

                        if ($margin >5 &&  $from_url) {
                            $msg = "\n key : ".$key;
                            $msg .= "\n name : ".$value->name;
                            $msg .= "\n margin : ".$margin;
                            $msg .= "\n last price: ".$value->last;
                            $msg .= "\n vol_idr : ".$this->custom_number_format($value->vol_idr,0);
                            $this->send_notif($msg);
                        }
                    }



                    // if ($margin > 1 || $pair_id) {
                        $tradplus[] = [
                            "key" => $key,
                            "last" => number_format($value->last),
                            "name" => $value->name,
                            "difference" => $margin,
                            "volume" => $this->custom_number_format($value->vol_idr,0),
                        ] ;
                    // }
                }

            }
            
        }



		return ["high"=> $rekomend,"all_data"=>$tradplus,"count" => count($tradplus)];
	}

    function custom_number_format($n, $precision = 3) {
        if ($n < 1000000) {
            // Anything less than a million
            $n_format = number_format($n);
        } else if ($n < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($n / 1000000, $precision) . 'M';
        } else {
            // At least a billion
            $n_format = number_format($n / 1000000000, $precision) . 'B';
        }

        return $n_format;
    }

    public function send_notif($message = ""){
        $curl = curl_init();
        $data = http_build_query([
                    "phone"     => "085693784939" ,
                    "message"   => "Test : ".$message ,
                ]);

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://149.129.248.52/wakitadev/API/Outbox/sendMessage/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "authorization: YVA0eGVwZTh5RzRuTUgyVEdCMFlETXhxWXMweWh4Mm1NU2tCYUhsOFl4TmtqZDZjdkFsNEJldXZOWGFuZDczdg",
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // $this->Loging("cron_auto_replay_error" , $err);
            // echo "cURL Error #:" . $err;
        } else {
            // $this->Loging("cron_auto_replay_success" , ['response' => $response]);
            // echo $response;
        }
    }
	
}
