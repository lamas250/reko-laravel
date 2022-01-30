<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurmasController extends Controller
{
    public function listarFavoritas(){
      $turmas = DB::table('sports_actions')
        ->join('projects', 'projects.id', '=', 'sports_actions.project_id')
        ->where('project_id',1)
        ->select(
          'projects.name as nome_projeto',
          'sports_actions.name',
          'sports_actions.id',
          'sports_actions.project_id'
        )
        ->get();
      
      return response()->json($turmas);
    }
}
