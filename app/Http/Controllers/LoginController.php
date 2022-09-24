<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){

        return view('auth.login');
    }

    public function home(){

        return view('pages.dashboard');
    }

    public function autenticate(Request $request){

        $validatedData = $request->validateWithBag('login', [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($request->email == 'dominus' & $request->password == 'admin') {
            return redirect('professores');
        } else {
            return $this->index();
        }

    }
}
