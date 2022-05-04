<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\utilisateurs;

class AuthentificationController extends Controller
{
   public function connexion(){
       return view('login');
   }
   public function authentification(){
       $utilisateurs= new utilisateurs();
       $utilisateurs->email=$request->email;
       $utilisateurs->password=$request->password;
       $resultat=auth()->attempt([
           'email'=>request('email'),
           'password'=>request('password'),
       ]);
       var_dump($resultat);
       echo"reussi";

   }
}
