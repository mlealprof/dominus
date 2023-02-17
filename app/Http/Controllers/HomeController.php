<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function salvar(Request $request){

        

        $arquivo = fopen('aviso.txt','r');
        if ($arquivo == false) die('Não foi possível abrir o arquivo.');

        $arquivo = fopen('aviso.txt','w+');
        if ($arquivo) {
            if (!fwrite($arquivo, $request->aviso)) die('Não foi possível atualizar o arquivo.');
            fclose($arquivo);
        }
             dd($request->aviso);
        return viem ('home');
    }
}
