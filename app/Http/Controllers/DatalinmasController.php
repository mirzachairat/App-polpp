<?php

namespace App\Http\Controllers;

use Dotenv\Result\Result; 
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Wilayah;

use GuzzleHttp\Exception\GuzzleException;

class DatalinmasController extends Controller
{
    public function index(){
        $wilayah = Wilayah::get();
        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/0/query?where=1%3D1&outFields=*',
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
        return view('Pages.Datalinmas.dataLinmas', $this->data);
    }

    public function store(Request $request){
        $koordinat = $request->koordinat;
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
                'kabkota'=> $request->kabkota,
                'kecamatan' => $request->kecamatan,
                'keldes' => $request->keldes,
                'jeniskelamin' => $request->jeniskelamin, 
                'jenissatlinmas' => $request->jenissatlinmas,
                'smbad' => $request->smbad,
                'smban' => $request->smban,
                'noskpelantikan' => $request->noskpelantikan
            ] 
            ];
           
            $client = new \GuzzleHttp\Client();
            $sendData = $client->post('https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/0/applyEdits',
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
            
            return redirect('/datalinmas');
    }

    public function deleteId(Request $request){
            $id = $request->objectid;

            $client = new \GuzzleHttp\Client();
            $respObj = $client->post(
                'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/0/applyEdits',
            array(
                'form_params' => array(
                    'deletes' => $id,
                    'f' => 'json'
                ),
                'verify' => false
                )
            );
            $result = json_decode($respObj->getBody());
            return redirect()->to('/datalinmas')
            ->with('success','User deleted successfully');

    }

    public function getSingleData(Request $request){
        $id = $request->objectid;
        // $sts = 'error';
		// $msg = 'gagal memperbarui proses';

        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/0/query?where=OBJECTID%3D'.$id,
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

    public function updateData(Request $request){
        
        
        
        $updates=[
            // 'geometry' => [
            // "hasZ" => true,
            // "hasM" => false,
            //  "rings"=> [json_decode($koordinat)],
            //  "spatialReference"=> ["wkid" => 4326]
            // ],
            'attributes' =>[
            'objectId' => $objectid,	
            'kabkota'=> $kabkota,
            'kecamatan' => $kecamatan,
            'keldes' => $keldes,
            'jeniskelamin' => $jeniskelamin, 
            'jenissatlinmas' => $jenissatlinmas,
            'smbad' => $smbad,
            'smban' => $smban,
            'noskpelantikan' => $noskpelantikan,
            ] 
        ];
        dd($updates);
            $client = new \GuzzleHttp\Client();
            $sendDataUpdate = $client->post(
                'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/0/applyEdits',
                array(
                    'form_params' => array(
                        'updates' => json_encode([$updates]),
                        'f' => 'json', 
                    ),
                    'verify' => false
                    )
            );
            $result = json_decode($sendDataUpdate->getBody());
            dd($result);
    }
}