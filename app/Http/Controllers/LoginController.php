<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        
        return view('auth.login');

    }

    public function sair(){
        session()->flush();
        return view('auth.login');        
    }

    public function home(){

        return view('pages.dashboard');
    }

    public function autenticate(Request $request){


        $validatedData = $request->validateWithBag('login', [
            'cpf' => ['required'],
            'password' => ['required'],
        ]);

        
        $usuario = DB::table('users')->where([['cpf','=',$request->cpf]])->get();

        $login = false;
        
        foreach ($usuario as $user){

            if ($request->cpf == $user->cpf & $request->password == $user->password) {
                session()->flush();
                session(['logado' => 'sim']);
                session(['professor_id' => $user->professor_id]);
                $login=true; 
                return redirect('home');
                
                
                     

            } else {
                return $this->index();
            }
        }
        if ($login == false){
            return $this->index();
        }

    }
    public function usuarios(){
      $usuarios = User::all();
      return view('usuarios.index',[
            'usuarios' => $usuarios            
        ]);
    }


    public function usuario_index(Request $request){

     if((session()->get('logado')<>'sim')or(session()->get('professor_id')<>'')){
        return view('auth.login');
     }

      $search = $request->search;  
      $professor_id =  $request->professor_id;  
      $usuarios = User::all();

     if($professor_id <> ''){
        $search='';
      }
     
      $professores = Professor::all();     

      if ($search <> ''){
      $professores = Professor::where([
                   ['nome','like','%'.$search.'%']
                   ])->get();
      }else{
        if ($professor_id<>''){
           $professores=Professor::findOrFail($professor_id);
        }
      }



      return view('usuarios.create',[
            'usuarios' => $usuarios,
            'professores' => $professores,
            'search' => $search,
            'professor_id' => $professor_id
        ]);
    }
    public function usuario_store(Request $request,User $usuario) {
        $usuario->name = $request->nome;
        $usuario->cpf = $request->cpf; 
        $usuario->password =$request->senha ;       
        $usuario->professor_id =$request->professor_id ;       

        $usuario->save();

        return redirect('/usuarios');
    }
}
