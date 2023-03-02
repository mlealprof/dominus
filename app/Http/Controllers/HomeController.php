<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $arquivo = fopen('aviso.txt', 'r');
        $aviso='';
        if (file_exists("aviso.txt")) {
            $aviso = file_get_contents("aviso.txt");
            $aviso_array = explode("\n", $aviso);
            
        } 

        return view('home',[
             'aviso'=> $aviso_array
        ]);
    }

    public function salvar(Request $request){

        
        $conteudo = $request->conteudo;

        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/aviso.txt","wb");

        fwrite($fp,$conteudo);

        fclose($fp);

             
        return redirect ('/home');
    }
}
