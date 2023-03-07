<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materiales=Material::orderBy('nombre', 'ASC')->paginate(20);
        return view('Material.Index',['materiales'=>$materiales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiales=Material::all();
        return view('Material.Create',['materiales'=>$materiales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=> 'required|unique:material|min:3',
            'codigo'=> 'required|unique:material',
            'material' => 'required' // Proponngo que sea requerido el material
        //     'esMateriaPrima'=> 'required'
        ]);
        $request['esMateriaPrima'] = $request->material; // El material se lo asigno al atributo esMateriaPrima
        
        Material::create($request->all());
        return redirect()
        ->route('material.index')
        ->with('success','Material registrado correctamente');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return view('Material.Show',['material'=>$material]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('Material.Edit',['material'=>$material]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {



        // $request->validate([
        //     'nombre'=> 'required|unique:material|min:3',
        //     'codigo'=> 'required|unique:material',
        //     'material' => 'required' // Proponngo que sea requerido el material
        // //     'esMateriaPrima'=> 'required'
        // ]);
        // $request['esMateriaPrima'] = $request->material; // El material se lo asigno al atributo esMateriaPrima
        // Material::create($request->all());
        // return redirect()
        // ->route('material.index')
        // ->with('success','Material registrado correctamente');





        $request->validate([
            'nombre'=> ['required',Rule::unique('Material')->ignore($material)],
            'codigo'=> ['required',Rule::unique('Material')->ignore($material)],
        ]);
        $request['esMateriaPrima'] = $request->material;
        $material->fill($request->only([
            'codigo','nombre','esMateriaPrima'
        ]));

        if($material->isClean()){
            return back()->with('warning','Debe realizar aunque sea un cambio para actualizar.');
        } 
        $material->update($request->all());
        return back()
        ->with('success','Se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return back()->with('danger','Material eliminado correctamente.');
    }
}
