<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wilayah;

class LinmastibumController extends Controller
{
    public function index(){
        $wilayah = Wilayah::get();
        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/5/query?where=1%3D1&outFields=*',
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
        return view('Pages.Tibum.linmasTibum', $this->data);
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

                'tanggalkegiatan'=> $request->tanggalkegiatan,
                'kabkota'=> $request->kabkota,
                'kecamatan' => $request->kecamatan,
                'keldes' => $request->keldes,
                'jenisgangguan' => $request->jenisgangguan, 
                'permasalahan' => $request->permasalahan,
                'pemecahanmasalah' => $request->pemecahanmasalah,
                'instansiterkait' => $request->instansiterkait,
                'keterangan' => $request->keterangan,
            ] 
            ];
        
            $client = new \GuzzleHttp\Client();
            $sendData = $client->post('https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/5/applyEdits',
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
            
            return redirect('/linmas_tibum');
    }

    public function deleteId(Request $request){
        $id = $request->objectid;

        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/5/applyEdits',
        array(
            'form_params' => array(
                'deletes' => $id,
                'f' => 'json'
            ),
            'verify' => false
            )
        );
        $result = json_decode($respObj->getBody());
        return redirect()->to('/linmas_tibum')
        ->with('success','User deleted successfully');

}

public function getSingleData(Request $request){
    $id = $request->objectid;
    // $sts = 'error';
    // $msg = 'gagal memperbarui proses';

    $client = new \GuzzleHttp\Client();
    $respObj = $client->post(
        'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/5/query?where=OBJECTID%3D'.$id,
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
        'kabkota'=> $request->kabkota,
                'kecamatan' => $kecamatan,
                'keldes' => $keldes,
                'jenisgangguan' => $jenisgangguan, 
                'permasalahan' => $permasalahan,
                'pemecahanmasalah' => $pemecahanmasalah,
                'instansiterkait' => $instansiterkait,
                'keterangan' => $keterangan,
        ] 
    ];
    dd($updates);
        $client = new \GuzzleHttp\Client();
        $sendDataUpdate = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/5/applyEdits',
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
