@extends('layouts.app')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
        </div>
        <div class="col-md-12">
            <div class="card mx-auto" style="width: 50%;">
              <div class="card-header">
                Material
              </div>
              <div class="card-body text-center">
                @if ($material->esMateriaPrima == 1)
                <h5 class="card-title">ID de la Materia Prima: {{ $material->ID }}</b></h5>
                        @else
                        <h5 class="card-title">ID del Producto: {{ $material->ID }}</b></h5>
                        @endif
                <h5 class="card-title">Nombre: {{ $material->nombre }}</b></h5>
                <h5 class="card-title">Codigo: {{ $material->codigo }}</b></h5>
              </div>
              <div class="col-md-12">
                  <a class="btn btn-danger float-right" href="{{ route('material.index') }}">Volver al menu principal</a>		
                </div>
            </div>
        </div>
    </div>
</div>



@endsection