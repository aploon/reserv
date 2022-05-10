<?php

namespace App\Http\Controllers;

use App\DataTables\ReservationsDataTable;
use App\Models\Categorie;
use App\Models\Materiel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

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

    public function mes_reservations(ReservationsDataTable $dataTable)
    {

        $categories = Categorie::all();

        return $dataTable->render('reservations.mes_reservations', [
            'categories' => $categories
        ]);
    }

    public function fullcalendar_reserv(){

        $reservations = Reservation::all();

        return json_encode($reservations);

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

        $control_reserv = DB::table('reservations')
            ->where('materiel_id', $request->materiel_id)
            ->where('date_debut', '>=', date('Y-m-d H:i:s', strtotime($request->date_debut)))
            ->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime($request->date_fin)))
            ->orWhere(function ($query) {
                global $request;
                $query->where('date_fin', '>=', date('Y-m-d H:i:s', strtotime($request->date_debut)))
                    ->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime($request->date_fin)))
                    ->where('materiel_id', $request->materiel_id);
            })
            ->get();

        $materiel_reserv = Materiel::find($request->materiel_id);

        // Si la date de réservation est supérieure à la date courante et 
        // le nombre de matériels en utilisation est inférieure à la qte disponible

        if (strtotime($request->date_debut) > strtotime(now()) && $control_reserv->count() < $materiel_reserv->qte) {

            $reservation = Reservation::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'date_debut' => date('Y-m-d H:i:s', strtotime($request->date_debut)),
                'date_fin' => date('Y-m-d H:i:s', strtotime($request->date_fin)),
                'materiel_id' => $request->materiel_id,
                'user_id' => $request->user_id,
            ]);

            if ($reservation) {
                $statut_insert_reserv = 'insérer';
            } else {
                $statut_insert_reserv = 'non insérer';
            }
        } else {

            if (strtotime($request->date_debut) < strtotime(now())) {

                $statut_insert_reserv = 'date error';
            } else {
                $statut_insert_reserv = 'materiel no found';
            }
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
        $reservation = Reservation::find($id);
        $output = [];


        $output[] = $reservation->nom;
        $output[] = $reservation->description;
        $output[] = $reservation->materiel->id;
        $output[] = $reservation->materiel->nom;
        $output[] = date('m/d/Y g:i A', strtotime($reservation->date_debut));
        $output[] = date('m/d/Y g:i A', strtotime($reservation->date_fin));

        return json_encode($output);
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
        $control_reserv = DB::table('reservations')
            ->where('materiel_id', $request->materiel_id)
            ->where('date_debut', '>=', date('Y-m-d H:i:s', strtotime($request->date_debut)))
            ->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime($request->date_fin)))
            ->orWhere(function ($query) {
                global $request;
                $query->where('date_fin', '>=', date('Y-m-d H:i:s', strtotime($request->date_debut)))
                    ->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime($request->date_fin)))
                    ->where('materiel_id', $request->materiel_id);
            })
            ->get();

        $materiel_reserv = Materiel::find($request->materiel_id);

        // Si la date de réservation est supérieure à la date courante et 
        // le nombre de matériels en utilisation est inférieure à la qte disponible

        if (strtotime($request->date_debut) > strtotime(now()) && $control_reserv->count() <= $materiel_reserv->qte) {

            $reservation = Reservation::find($id);

            $reservation->nom = $request->nom;
            $reservation->description = $request->description;
            $reservation->date_debut = date('Y-m-d H:i:s', strtotime($request->date_debut));
            $reservation->date_fin = date('Y-m-d H:i:s', strtotime($request->date_fin));
            $reservation->materiel_id = $request->materiel_id;
            $reservation->user_id = $request->user_id;

            if ($reservation->save()) {
                return json_encode('Modification effectuée !');
            } else {
                return json_encode('Modification non éffectuée !');
            }

        } else {

            if (strtotime($request->date_debut) < strtotime(now())) {

                return json_encode('date error');

            } else {

                return json_encode('materiel no found');

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation->delete()) {
            return json_encode('Réservation annulée !');
        } else {
            return json_encode('Erreur de suppression !');
        }
    }
}
