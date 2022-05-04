<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comptes;

class AuthentificationController extends Controller
{
   public function connexion(){
       return view('login');
   }
   public function authentification(){
       $comptes= new comptes();
       $comptes->email=$request->email;
       $comptes->password=$request->password;
       $resultat=auth()->attempt([
           'email'=>request('email'),
           'password'=>request('password'),
       ]);
       var_dump($resultat);
       echo"reussi";

   }
}
