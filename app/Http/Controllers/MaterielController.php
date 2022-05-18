<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Image;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

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

                        //Pour avoir le compte d'un utilisateur
                        $user = DB::table('users')
                                        ->where('id', Auth::id())
                                        ->first();

                        $materiaux_html .= '
                        
                        <!-- Update materiel Modal-->
                        <div class="modal fade" id="materiel_modal_' . $materiel->id . '"
                            data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form
                                        action="' . Route('materiaux.update', ['materiaux' => $materiel->id]) . '"
                                        method="POST">
                                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                                        <input name="_method" type="hidden" value="PUT">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="materiel_modal_label">Modification
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nom du materiel</label>
                                                <input required type="text" name="nom" value="' . $materiel->nom . '"
                                                    class="form-control form-control-solid" />
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleTextarea">Description</label>
                                                <textarea required name="description" class="form-control form-control-solid"
                                                    rows="3">' . $materiel->description . '</textarea>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label>Quantité en stock</label>
                                                    <input required name="qte" type="number"
                                                        value="' . $materiel->qte . '"
                                                        class="form-control form-control-solid" />
                                                </div>
                                                <div class="col">
                                                    <label>Numéro de série</label>
                                                    <input name="num_serie" type="text"
                                                        value="' . $materiel->num_serie . '"
                                                        class="form-control form-control-solid" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Catégorie</label>
                                                <select required name="categorie_id"
                                                    class="form-control form-control-solid">';
                                                    
                                                    $materiaux_html_select = '';
                                                    $categories = Categorie::all();
                                                    foreach ($categories as $categorie) {
                                                        if ($categorie->nom == $materiel->categorie->nom) {
                                                            $materiaux_html_select .= '<option selected value="' . $categorie->id . '">
                                                                ' . $categorie->nom . '</option>';
                                                        }else{
                                                            $materiaux_html_select .= '<option value="' . $categorie->id . '">
                                                                ' . $categorie->nom . '</option>';
                                                        }
                                                    }

                                                    $materiaux_html .= $materiaux_html_select;

                    $materiaux_html .=          '</select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                data-dismiss="modal">Annuler</button>
                                            <button type="submit"
                                                class="btn btn-primary font-weight-bold">Modifier</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        ';

                        if ($user->compte == 'Administrateur') {
                            $materiaux_html .= '<div class="div_btn_reserv row d-flex justify-content-end"
                            style="position: absolute; bottom: 5px; right: 15px; display: none !important;">
                            <button class="btn btn-light btn-text-primary btn-hover-text-primary" title="Disponible actuellement">' . $materiel_dispo . '</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#materiel_modal_' . $materiel->id .'"
                                style="margin-left: 10px">Modifier</button>
                                    </div>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->';
                        }else{
                            $materiaux_html .= '<div class="div_btn_reserv row d-flex justify-content-end"
                            style="position: absolute; bottom: 5px; right: 15px; display: none !important;">
                            <button class="btn btn-light btn-text-primary btn-hover-text-primary" title="Disponible actuellement">' . $materiel_dispo . '</button>
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
        $materiel = Materiel::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'qte' => $request->qte,
            'num_serie' => $request->num_serie,
            'categorie_id' => $request->categorie_id
        ]);

        $image = Image::create([
            'nom' => $request->nom,
            'chemin' => 'template/assets/img/ordinateur.jpg',
            'materiel_id' => $materiel->id
        ]);

        if($materiel && $image){
            return back();
        }
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
        $materiel = Materiel::find($id);

        $materiel->nom = $request->nom;
        $materiel->description = $request->description;
        $materiel->qte = $request->qte;
        $materiel->num_serie = $request->num_serie;
        $materiel->categorie_id = $request->categorie_id;

        if($materiel->save()){
            return back();
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
        //
    }
}
