<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wilayah;

class BencanaController extends Controller
{
    public function index(){
        $wilayah = Wilayah::get();
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/4/query?where=1%3D1&outFields=*',
        array(
            'form_params' => array(
                'returnIdsOnly' => false,
                'returnGeometry'=>false,
                'f' => 'json'
            ),
            'verify' => false
            )
        );

        $body = $respObj->getBody();
        $ress = '';
        while (!$body->eof()) {
            //$ress .= $body->read(1024);
            $ress .= $body->read(10240000);
        }
        
        $arrResponsee = json_decode('['.$ress.']');

        $respp = null;
            foreach ($arrResponsee as $key=>$respss) {
                $respp = $respss;
            } 
   
        $featuresdata = $respp->features;
        $this->data['wilayah'] = $wilayah;     
        $this->data['featuresdata'] = $featuresdata;  
        return view('Pages.Bencana.bencana', $this->data);
        
    }

    public function store(Request $request){
        $lat = $request->Latitude;
        $lng = $request->Longitude;

        $adds=[
            'geometry' =>[
                "x"=> $lng,
                "y"=> $lat,
                "z"=> 0,
			"spatialReference"=> ["wkid" => 4326 ],
            ],
            'attributes' =>[
                'tanggalkegiatan'=>$request->tanggalkegiatan,
                'waktu'=>$request->waktu,
                'kabkota'=>$request->kabkota,
                'kecamatan'=>$request->kecamatan,
                'keldes'=> $request->keldes,
                'jenisbencana' =>$request->jenisbencana,
                'sifatbencana'=>$request->sifatbencana,
                'korbanmanusia'=>$request->korbanmanusia,
                'korbanmateriil'=>$request->korbanmateriil,
                'jenispertolongan'=>$request->jenispertolongan,
            ]
            ];
        
            $client = new \GuzzleHttp\Client();
            $sendData = $client->post('https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/4/applyEdits',
                array(
                    'form_params' => array(
                        //'token' => $tokendata,
                        'adds' => json_encode([$adds]),
                        'f' => 'json', 
                    ),
                    'verify' => false

                    )
            );
           
            $result = json_decode($sendData->getBody());
            
            return redirect('/bencana_kebakaran');
    }

    public function getSingleData(Request $request){
        $id = $request->objectid;
        // $sts = 'error';
		// $msg = 'gagal memperbarui proses';

        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/4/query?where=OBJECTID%3D'.$id,
        array(
            'form_params' => array(
                'outFields'=>'*',
                'f' => 'json'
            ),
            'verify' => false
            )
        );

        $result = json_decode($respObj->getBody());
        $getsingledata = $result->features[0]->attributes;

        if($getsingledata){
			return response()->json([
				'status' => 'success',
				'data' => $getsingledata 
			]);
		} else {
			abort(404);
		}
    }

    public function deleteId(Request $request){
        $id = $request->objectid;

        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/4/applyEdits',
        array(
            'form_params' => array(
                'deletes' => $id,
                'f' => 'json'
            ),
            'verify' => false
            )
        );
        $result = json_decode($respObj->getBody());
        return redirect()->to('/bencana_kebakaran')
        ->with('success','User deleted successfully');

}
}
