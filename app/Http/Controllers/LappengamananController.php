<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wilayah;

class LappengamananController extends Controller
{
    public function index(){
        $wilayah = Wilayah::get();
        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/3/query?where=1%3D1&outFields=*',
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
        return view('Pages.Pengamanan.lapPengamanan', $this->data);
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
                'namobj'=>$request->namobj,
                'tanggalkegiatan'=>$request->tanggalkegiatan,
                'waktu'=>$request->waktu,
                'kabkota'=>$request->kabkota,
                'kecamatan'=>$request->kecamatan,
                'keldes'=> $request->keldes,
                'jenispengamanan' =>$request->jenispengamanan,
                'jumlahtps'=>$request->jumlahtps,
                'jumlahpersonil'=>$request->jumlahpersonil,
                'permasalahan'=>$request->permasalahan,
                'pemecahanmasalah'=>$request->pemecahanmasalah,
                'instansiterkait'=>$request->instansiterkait,
                'keterangan'=>$request->keterangan,
            ]
            ];
        
            $client = new \GuzzleHttp\Client();
            $sendData = $client->post('https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/3/applyEdits',
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
            
            return redirect('/pengamanan');
    }

    public function getSingleData(Request $request){
        $id = $request->objectid;
        // $sts = 'error';
		// $msg = 'gagal memperbarui proses';

        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/3/query?where=OBJECTID%3D'.$id,
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
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/3/applyEdits',
        array(
            'form_params' => array(
                'deletes' => $id,
                'f' => 'json'
            ),
            'verify' => false
            )
        );
        $result = json_decode($respObj->getBody());
        return redirect()->to('/pengamanan')
        ->with('success','User deleted successfully');

}

}
