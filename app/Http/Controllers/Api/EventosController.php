<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EventHasBenefiteds;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventosController extends Controller
{
    public function listarEventos($id){
      $eventos = DB::table('events')
        ->where('sport_action_id',$id)
        ->get();

      return response()->json($eventos);
    }

    public function listarBeneficiados($id){
      $beneficiados = DB::table('sports_actions')
        ->join('sportaction_has_benefiteds','sportaction_has_benefiteds.sportaction_id','=','sports_actions.id')
        ->join('benefiteds','benefiteds.id','=','sportaction_has_benefiteds.benefited_id')
        ->leftjoin('event_has_benefiteds','event_has_benefiteds.benefited_id','=','benefiteds.id')
        ->where('sports_actions.id', $id)
        ->select(
          'benefiteds.id',
          'benefiteds.name',
          'benefiteds.cpf',
          'benefiteds.rg',
          'benefiteds.email',
          'benefiteds.avatar_path',
          'photo_path',
          'photo_time'
        )
        ->get();

      return response()->json($beneficiados);
    }


    public function compararBeneficiado(Request $request){
      // return response()->json($request->event_id);
      $client = new RekognitionClient([
        'region' => env('AWS_DEFAULT_REGION'),
        'version' => 'latest'
      ]);

      $beneficiado = DB::table('benefiteds')->where('id', $request->beneficiado_id)->first();

      if($request->file('file')){
        $file = $request->file('file');
        $exte = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        // $name = $this->clean($name);
        $doc = $file->storeAs($request->beneficiado_id, $name, 's3');

      }else{
        return response()->json(['path' => 'FALHOU']);
      }

      $result = $client->compareFaces([
        'QualityFilter' => 'AUTO',
        'SimilarityThreshold' => 60,
        'SourceImage' => [ 
          'Bytes' => file_get_contents($beneficiado->avatar_path)
        ],
        'TargetImage' => [
          'Bytes' => file_get_contents('https://reko250.s3.us-east-2.amazonaws.com/' . $doc)
        ],
      ]);

      if($result){
        $FaceMatchesResult = $result['FaceMatches'] ? $result['FaceMatches'][0]['Similarity'] : 'Vazio';
  
        if($FaceMatchesResult > 80){
          $saveData = new EventHasBenefiteds();
          $saveData->event_id = $request->event_id;
          $saveData->benefited_id = $request->beneficiado_id;
          $saveData->photo_path = $doc;
          $saveData->save();

          return response()->json(['result' => 1, 'percentage' => $FaceMatchesResult ]);
        }
  
        return response()->json(['result' => 0, 'percentage' => $FaceMatchesResult ]);
      }
      
      return response()->json('Falha na comparacao');
    }
}
