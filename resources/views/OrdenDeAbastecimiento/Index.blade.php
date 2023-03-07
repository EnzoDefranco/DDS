@extends('layouts.app')

@section('content')


<div class="text-center">
    <h1 class="display-4">TRABAJO DE CAMPO GRUPO N°2</h1>
    <p>Modulo de produccion</p>
</div>

<div class="card">
    <div class="card-header">
        <h2>Lista de Ordenes de Abastecimiento</h2>
    </div>


    

    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if (session('danger'))
        <div class="alert alert-danger" role="alert">
            {{ session('danger') }}
        </div>
        @endif
        <a  href="{{ route('ordenDeAbastecimiento.create') }}"  class="btn btn-success btn-sm" >Crear Nuevo</a>
        <hr />


        @if (sizeof($ordenes)<=0)
            <div class="alert alert-secondary">No existen Ordenes de Abastecimiento</div>
        @else
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">FechaEmision</th>
                    <th scope="col">Plazo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordenes as $orden) 

                    <tr>
                        <td scope="row">{{ $orden->ID }}</td>
                        <td scope="row">{{ $orden->fechaEmision }}</td>
                        <td scope="row">{{ $orden->plazo }}</td>
                        <td>
                            <a href="{{ route('ordenDeAbastecimiento.edit', $orden) }}" class="btn btn-primary btn-sm" >Editar</a> |
                            <a href="{{ route('ordenDeAbastecimiento.show', $orden) }}" class="btn btn-primary btn-sm">Detalle</a> |
                            <form action="{{ route('ordenDeAbastecimiento.destroy', $orden) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('¿Estás seguro de eliminar?')" >Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center" >
            {!! $ordenes->links() !!}
        </div>
        @endif 

    </div>
</div>



@endsection