<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\OrdenDeAbastecimiento;
use App\Models\Faltante;
use Illuminate\Http\Request;

class OrdenDeAbastecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes=OrdenDeAbastecimiento::orderBy('fechaEmision', 'ASC')->paginate(5);
        return view('OrdenDeAbastecimiento.Index',['ordenes'=>$ordenes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Material::all();
        return view('OrdenDeAbastecimiento.Create',['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // El punto (.) se utiliza para separar el nombre del campo del nombre del índice del array que se está validando. En este caso, nombres.* significa que estamos validando el campo nombres y todos sus elementos.

        // El asterisco (*) se utiliza como comodín para indicar que la validación se aplicará a todos los elementos del array. En otras palabras, el asterisco significa "cualquier índice".
        $validatedData= $request->validate([
            'productos.*' => 'required',
            'cantidades.*' => 'required|numeric|min:1',
            'fechaEmision' => 'required',
            'plazo' => 'required'
        ]);


        $Orden= $request->only('fechaEmision','plazo');
        $Orden = OrdenDeAbastecimiento::create($Orden);


         $productos = $request->productos;
         $cantidades = $request->cantidades;


        for ($i = 0; $i < count($productos); $i++) {    
            $Orden->materiales()->attach(
                $productos[$i],
                ['cantidad' => $cantidades[$i]]

            );
        };

        return redirect()
        ->route('ordenDeAbastecimiento.index')
        ->with('success','Orden de Abastecimiento registrada correctamente');
    }
       // ---------------------------------//

        
        



         
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdenDeAbastecimiento  $ordenDeAbastecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenDeAbastecimiento $ordenDeAbastecimiento)
    {
        $ordenDeAbastecimiento->load('materiales');
        $materiales=$ordenDeAbastecimiento->materiales;

        return view('OrdenDeAbastecimiento.Show',['ordenDeAbastecimiento'=>$ordenDeAbastecimiento,'materiales'=>$materiales]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdenDeAbastecimiento  $ordenDeAbastecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenDeAbastecimiento $ordenDeAbastecimiento)
    {   
        $ordenDeAbastecimiento->load('materiales');
        $materiales=$ordenDeAbastecimiento->materiales;
        $products=Material::all();

        return view('OrdenDeAbastecimiento.Edit',['ordenDeAbastecimiento'=>$ordenDeAbastecimiento,'products'=>$products,'materiales'=>$materiales]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdenDeAbastecimiento  $ordenDeAbastecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenDeAbastecimiento $ordenDeAbastecimiento)
    {
        $ordenDeAbastecimiento->load('materiales');
        $materiales=$ordenDeAbastecimiento->materiales;
        $products=Material::all();

        //Actualizo los detalles de la orden
        $validatedData= $request->validate([
            'productos.*' => 'required',
            'cantidades.*' => 'required|numeric|min:1',
            'fechaEmision' => 'required',
            'plazo' => 'required'
        ]);
        // $ordenDeAbastecimiento->fill($request->only([
        //     'fechaEmision','plazo'
        // ]));

        // if($ordenDeAbastecimiento->isClean()){
        //     return back()->with('warning','Debe realizar aunque sea un cambio para actualizar.');
        // } 

        
        $ordenDeAbastecimiento->update($request->only('fechaEmision','plazo'));


        //Actualizo los detalles de la orden

        $productos = $request->productos;
        $cantidades = $request->cantidades;

        $requestDetails = $request->has('productos') ? $request->input('productos') : [];

        
        // Recorro los detalles de la orden y elimino los que no estén en el request
        foreach ($ordenDeAbastecimiento->materiales as $material) {
            if (!array_key_exists($material->id, $requestDetails)) {
                $ordenDeAbastecimiento->materiales()->detach($material->id);
            }
        }
        
        if (!empty($productos)) {
            foreach ($productos as $key => $producto) {
                $cantidad = $cantidades[$key];
            
                // Busco el material en la relación muchos a muchos
                $material = $ordenDeAbastecimiento->materiales()->where('material_id', $producto)->first();
            
                if ($material) {
                    // Si el material ya está en la orden, actualizo la cantidad
                    $material->pivot->cantidad = $cantidad;
                    $material->pivot->save();
                } else {
                    // Si el material no está en la orden, lo agrego con la cantidad correspondiente
                    $ordenDeAbastecimiento->materiales()->attach($producto, ['cantidad' => $cantidad]);
                }
            }
        } else {
            return redirect()->route('ordenDeAbastecimiento.show', [$ordenDeAbastecimiento->ID]);
        }

        return redirect()->route('ordenDeAbastecimiento.show', [$ordenDeAbastecimiento->ID]) ->with('success','Se actualizo correctamente.');;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdenDeAbastecimiento  $ordenDeAbastecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenDeAbastecimiento $ordenDeAbastecimiento)
    {
        $ordenDeAbastecimiento->delete();
        return back()->with('danger','Material eliminado correctamente.');
    }
}
