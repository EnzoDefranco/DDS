@extends('layouts.app')
@section('content')


<div class="container">
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
  </div>
  @endif
  <div class="row">
      <div class="col-md-12">
      </div>
      <div class="col-md-12">
          <div class="card mx-auto" style="width: 50%;">
            <div class="card-header">
              Orden de Abastecimiento <b>{{$ordenDeAbastecimiento->ID  }}</b>
            </div>
            <div class="card-body">
              <h5 class="card-title"> <b>Fecha de Emisión:</b>  {{ $ordenDeAbastecimiento->fechaEmision }}</b></h5>
              <h5 class="card-title"> <b>Plazo:</b>  {{ $ordenDeAbastecimiento->plazo }}</b></h5>
            </div>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-md-12">
    </div>
    <div class="col-md-12">
        <div class="card mx-auto" style="width: 50%;">
          <div class="card-header">
            Detalle de la Orden de Abastecimiento
          </div>
              @if ($materiales->count() > 0)
              <div class="card-body">
                <div class="align-items-end row mb-4 mt-4">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($materiales as $materiall)
                                <tr>
                                    <td>{{ $materiall->nombre }}</td>
                                    <td>{{ $materiall->pivot->cantidad }}</td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
              @else
              <div class="card-body">
                <b>No se encontraron materiales relacionados con esta orden.</b>
              </div>
              @endif
          <div class="col-md-12">
            <a class="btn btn-success float-right" href="{{ route('ordenDeAbastecimiento.edit',$ordenDeAbastecimiento) }}">Editar</a>
            <a class="btn btn-danger float-right" href="{{ route('ordenDeAbastecimiento.index') }}">Volver al menu principal</a>		
          </div>
        </div>
    </div>
</div>
</div>


@endsection