@extends('layouts.app')

@section('content')


<div class="text-center">
    <h1 class="display-4">TRABAJO DE CAMPO GRUPO N°2</h1>
    <p>Modulo de produccion</p>
</div>

<div class="card">
    <div class="card-header">
        <h2>Lista de Ordenes de Materiales</h2>
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
        <a  href="{{ route('material.create') }}" asp-action="Create" class="btn btn-success btn-sm" >Crear Nuevo</a>

        <hr />


        @if (sizeof($materiales)<=0)
            <div class="alert alert-secondary">No existen materias primas</div>
        @else
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">TipoMaterial</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiales as $material) 

                    <tr>
                        <td scope="row">{{ $material->ID }}</td>
                        <td scope="row">{{ $material->nombre }}</td>
                        <td scope="row">{{ $material->codigo }}</td>
                        @if ($material->esMateriaPrima == 1)
                            <td scope="row">Materia Prima</td>
                        @else
                            <td scope="row">Producto</td>
                        @endif
                        <td>
                            <a href="{{ route('material.edit', $material) }}" class="btn btn-primary btn-sm" >Editar</a> |
                            <a href="{{ route('material.show', $material) }}" class="btn btn-primary btn-sm">Detalle</a> |
                            <form action="{{ route('material.destroy', $material) }}" method="POST" class="d-inline-block">
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
            {!! $materiales->links() !!}
        </div>
        @endif 

    </div>
</div>



@endsection