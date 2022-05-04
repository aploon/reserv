<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Materiel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        $materiaux = Materiel::all();
        $reservations = Reservation::all();

        return view('reservations.index', [
            'categories' => $categories,
            'reservations' => $reservations,
            'materiaux' => $materiaux
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Categorie::all();
        $materiaux = Materiel::all();

        return view('reservations.create', [
            'categories' => $categories,
            'materiaux' => $materiaux,
            'request' => $request
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservation = Reservation::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'date_debut' => date('Y-m-d H:i:s', strtotime($request->date_debut)),
            'date_fin' => date('Y-m-d H:i:s', strtotime($request->date_fin)),
            'materiel_id' => $request->materiel_id,
            'user_id' => $request->user_id,
        ]);

        if($reservation){
            $statut_insert_reserv = 'insérer';
        }else{
            $statut_insert_reserv = 'non insérer';
        }

        $categories = Categorie::all();
        $materiaux = Materiel::all();
        $reservations = Reservation::all();

        return view('reservations.index', [
            'categories' => $categories,
            'reservations' => $reservations,
            'materiaux' => $materiaux,
            'statut_insert_reserv' => $statut_insert_reserv
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
