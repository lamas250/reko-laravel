<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

// use Tymon\JWTAuth\Contracts\Providers\Auth as JWTAuth;

class AuthController extends Controller
{
    /**
     * 
     * Logando usuario e criando token
     *
     */

    public function logout()
    {
      $user = User::find(auth()->user()->id);
      $user->profile_selected_id = null;
      $user->save();
      
      auth()->logout();
      session()->flush();

      if(auth()->user()){
        return response()->json(['message' => 'Falha ao deslogar']);
      }

       return response()->json(['status' => 200, 'message' => 'Logout feito com sucesso']);
    }


    /**
     * 
     *  Manipulando o perfil selecionado do usuario
     * 
     */
    public function listProfiles(){
      $user = auth()->user();
  
      try {
        $profiles = DB::table('user_has_profiles')
          ->join('roles','roles.id','=','user_has_profiles.role_id')
          ->join('companies','companies.id','=','user_has_profiles.company_id')
          ->where('user_id', $user->id)
          ->select(['user_has_profiles.id as profile_id','roles.name','companies.trading_name'])
          ->get();
        return response()->json($profiles);
      } catch (\Throwable $th) {
        return response()->json('Falha ao listar profiles');
      }
    }
  
    public function setProfile(Request $request){
      // try {
        $user = auth()->user();

        if($request->profile_id){
          $user = User::find($user->id);
          $user->profile_selected_id = $request->profile_id;
          $user->save();
  
          $role_permissions = DB::table('user_has_profiles')
            ->join('roles','roles.id','=','user_has_profiles.role_id')
            ->join('role_has_permissions','role_has_permissions.role_id','=','user_has_profiles.role_id')
            ->join('permissions','permissions.id', '=', 'role_has_permissions.permission_id')
            ->join('modules','modules.id','permissions.module_id')
            ->where('user_has_profiles.id',$request->profile_id)
            ->select(['modules.slug as modulo','permissions.name as permissao'])
            ->get();
  
  
            foreach($role_permissions as $p)
            { 
                $arrPermissoes[$p->modulo][] = $p->permissao;
            }
  
            $company_profile = DB::table('user_has_profiles')
            ->join('companies','companies.id','=','user_has_profiles.company_id')
            ->where('user_has_profiles.id',$request->profile_id)
            ->select(['companies.id','company_name','trading_name','logo_path','state_id'])
            ->first();

            $modulos_slug = DB::table('user_has_profiles')
            ->join('roles','roles.id','=','user_has_profiles.role_id')
            ->join('role_has_permissions','role_has_permissions.role_id','=','user_has_profiles.role_id')
            ->join('permissions','permissions.id', '=', 'role_has_permissions.permission_id')
            ->join('modules','modules.id','permissions.module_id')
            ->where('user_has_profiles.id',$request->profile_id)
            ->groupBy('modules.slug')
            ->select('modules.slug')
            ->get();

            $slug_arr = [];
            foreach($modulos_slug as $slug){
              $slug_arr[] = $slug->slug;
            }

            $menus_auth = DB::table('modules')->whereIn('modules.slug',$slug_arr)->get();


            $data_json = [
              "user_auth" => $user,
              "company_auth" => $company_profile, 
              "permissions_auth" => $arrPermissoes,
              "menus_auth" => $menus_auth
            ];
            // $teste = session()->all();
            session()->put('_permissions_auth',$arrPermissoes);

          return response()->json($data_json);
        }
        return response()->json('Falha ao escolher perfil');
  
      // } catch (\Throwable $th) {
      //   return response()->json('Erro ao escolher perfil');
      // }
      
    }

    public function me(){
      // $data_json = auth()->user();
      // $data_json = Session::all();
      // $data_json = Session::get('_permissions_auth');
      $user = auth()->user();
      $role_permissions = DB::table('user_has_profiles')
            ->join('roles','roles.id','=','user_has_profiles.role_id')
            ->join('role_has_permissions','role_has_permissions.role_id','=','user_has_profiles.role_id')
            ->join('permissions','permissions.id', '=', 'role_has_permissions.permission_id')
            ->join('modules','modules.id','permissions.module_id')
            ->where('user_has_profiles.id',$user->profile_selected_id)
            ->select(['modules.slug as modulo','permissions.name as permissao'])
            ->get();
  
  
            foreach($role_permissions as $p)
            { 
                $arrPermissoes[$p->modulo][] = $p->permissao;
            }
  
            $company_profile = DB::table('user_has_profiles')
            ->join('companies','companies.id','=','user_has_profiles.company_id')
            ->where('user_has_profiles.id',$user->profile_selected_id)
            ->select(['companies.id','company_name','trading_name','logo_path','state_id'])
            ->first();

            $modulos_slug = DB::table('user_has_profiles')
            ->join('roles','roles.id','=','user_has_profiles.role_id')
            ->join('role_has_permissions','role_has_permissions.role_id','=','user_has_profiles.role_id')
            ->join('permissions','permissions.id', '=', 'role_has_permissions.permission_id')
            ->join('modules','modules.id','permissions.module_id')
            ->where('user_has_profiles.id',$user->profile_selected_id)
            ->groupBy('modules.slug')
            ->select('modules.slug')
            ->get();

            $slug_arr = [];
            foreach($modulos_slug as $slug){
              $slug_arr[] = $slug->slug;
            }

            $menus_auth = DB::table('modules')->whereIn('modules.slug',$slug_arr)->get();
  
            $data_json = [
              "user_auth" => $user,
              "company_auth" => $company_profile, 
              "permissions_auth" => $arrPermissoes,
              "menus_auth" => $menus_auth
            ];

            return response()->json($data_json);
    }

}
