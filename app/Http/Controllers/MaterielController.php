<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){

        $categories = Categorie::all();
        $materiaux = Materiel::all();

        return view('materiaux.index', [
            'categories' => $categories,
            'materiaux' => $materiaux
        ]);
    }

    public function search(Request $request){
        
        if(isset($request->categorie_id)){
            $materiaux = Materiel::where('nom', 'LIKE', '%' . $request->search_value . '%')
            ->where('categorie_id', $request->categorie_id)
            ->get();
        }else{
            $materiaux = Materiel::where('nom', 'LIKE', '%' . $request->search_value . '%')->get();
        }

        $materiaux_html = "";

        foreach ($materiaux as $materiel){

            $materiaux_html .= '<!--begin::Item-->
                <div class="d-flex align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-100 mr-5">
                        <img src="' . asset($materiel->image->chemin) . '" alt="" srcset="">
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="div_materiel_hover d-flex flex-column font-weight-bold" style="position: relative">
                        <a href="#"
                            class="text-dark text-hover-primary mb-1 font-size-lg">' . $materiel['nom'] . '</a>
                        <span class="text-muted">' . $materiel['description'] . '</span>';

                        $current_reserv = DB::table('reservations')
                            ->where('materiel_id', $materiel->id)
                            ->Where(function ($query) {
                                $query
                                    ->where('date_debut', '>=', date('Y-m-d H:i:s', strtotime(now())))
                                    ->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime(now() . '+2 hours')))
                                    ->orWhere(function ($query) {
                                        $query->where('date_fin', '>=', date('Y-m-d H:i:s', strtotime(now())))->where('date_debut', '<=', date('Y-m-d H:i:s', strtotime(now() . '+2 hours')));
                                    });
                            })
                            ->get();
                        
                        $materiel_dispo = $materiel->qte - $current_reserv->count();
                        
            $materiaux_html .= '<div class="div_btn_reserv row d-flex justify-content-end"
                            style="position: absolute; bottom: 5px; right: 15px; display: none !important;">
                            <button class="btn btn-light btn-text-primary btn-hover-text-primary">' . $materiel_dispo . '</button>
                                <form method="POST" action="' . Route('reservations.create') . '" class="m-0">
                                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                                    <input type="text" name="materiel_id" hidden value="' . $materiel->id . '">
                                    <button type="submit"
                                        class="btn btn-primary" style="margin-left: 10px">Réserver</button>
                                </form>
                        </div>
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Item-->';
        }

        if($materiaux->count() <= 0){
            return json_encode('material no found');
        }else{
            return json_encode($materiaux_html);
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categorie_name)
    {
        $categories = Categorie::all();
        $categorie = Categorie::where('nom', $categorie_name)->firstOrFail();
        $materiaux = $categorie->materiels;

        return view('materiaux.show', [
            'categorie_name' => $categorie_name,
            'categories' => $categories,
            'materiaux' => $materiaux
        ]);
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
