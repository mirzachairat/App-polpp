<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wilayah;

class KegiatanlainnyaController extends Controller
{
    public function index(){
        $wilayah = Wilayah::get();
        $wilayah = Wilayah::get();
        $client = new \GuzzleHttp\Client();
        $respObj = $client->post(
            'https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/6/query?where=1%3D1&outFields=*',
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
        return view('Pages.Kegiatan.kegiatanLainnya', $this->data);
        }

    public function store(Request $request){
            $koordinat = $request->koordinat;
            $lat = $request->Longitude;
            $lng = $request->Latitude;
    
            $adds=[
                'geometry' =>[
                    "x"=> $lat,
                    "y"=> $lng,
                    "z"=> 0,
                "spatialReference"=> ["wkid" => 4326 ],
                ],
                'attributes' =>[
                    'namobj'=>$request->namobj,
                    'tanggalkegiatan'=>$request->tanggalkegiatan,
                    'kabkota'=> $request->kabkota,
                    'kecamatan' => $request->kecamatan,
                    'keldes' => $request->keldes,
                    'jeniskegiatan' => $request->jeniskegiatan, 
                    'permasalahan' => $request->permasalahan,
                    'pemecahanmasalah' => $request->pemecahanmasalah,
                    'instansiterkait' => $request->instansiterkait,
                    'keterangan' => $request->keterangan,
                ] 
                ];
               
                $client = new \GuzzleHttp\Client();
                $sendData = $client->post('https://satudata.bantenprov.go.id/server/rest/services/SATPOLPP/SATPOLPP_Update/FeatureServer/6/applyEdits',
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
                
                return redirect('/kegiatan_lainnya')->with('status','Berhasil di tambahkan');
        }
}
