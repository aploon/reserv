<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\utilisateurs;

class ConnexionController extends Controller
{
    public function inscription(){
        return view ('login');

    }
    /**
 * create a new user.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function traitementFormulaireInscription(Request $request){
        $utilisateurs =  new utilisateurs();
        $utilisateurs->nom=$request->nom;
        $utilisateurs->prenom=$request->prenom;
        $utilisateurs->telephone=$request->telephone;
        $utilisateurs->email=$request->email;
        $utilisateurs->password=$request->password;
        $utilisateurs->password_confirmation=$request->password_confirmation;
        $utilisateurs->save();
       /* request()->validate([
            'password'=>['confirmed','min:8'],
            'password_confirmation'=>[],

        ]

    );*/
               
/*
       $validated=$request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirmP' => 'required'
        ]);*/
      return redirect()->route("connexion");
    }
   
}
