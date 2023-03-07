@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">
        <h2>Alta de Orden de Abastecimiento</h2>
    </div>
    <div class="row">
        <form action="{{ route('ordenDeAbastecimiento.store') }}" method="POST" class="row g-3" >
            @csrf
            <div class="col-md-6">
                        <label for="fechaEmision" class="form-label">Fecha de Emisión</label>
                        <input type="date" class="form-control shadow-none" id="fechaEmision" name="fechaEmision" value="{{ old('fechaEmision') }}">
                        @error('fechaEmision')
                            <small class="text-danger">Ingrese la Fecha de Emisión</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="plazo" class="form-label">Plazo</label>
                        <input type="date" class="form-control shadow-none" id="plazo" name="plazo" value="{{ old('plazo') }}">
                        @error('plazo')
                        <small class="text-danger">Ingrese el Plazo</small>
                        @enderror
                    </div>
                    <hr>
                    <div class="card-header">
                        <h3>Orden de Abastecimiento Detalle</h3>
                    </div>
                    <div class="card-body">
                        <div class="align-items-end row mb-4 mt-4">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>Cantidad</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla-productos">
                                        <tr>
                                            <td>
                                                @error('productos.*')
                                                <small class="text-danger">Seleccione al menos una materia prima</small>
                                                @enderror
                                                <select class="form-select shadow-none" name="productos[]" id="productos[]">
                                                    <option value="{{ old('ID') }}" selected>Seleccione un Material</option>
                                                    @foreach ($products as $producto)
                                                        <option value="{{ $producto->ID }}" {{ old('ID') == $producto->ID ? 'selected' : '' }} >
                                                            {{ $producto->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                @error('cantidades.*')
                                                <small class="text-danger">Ingrese la cantidad</small>
                                                @enderror
                                                <input type="text" name="cantidades[]" class="form-control">
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-danger eliminar-fila">Eliminar</button>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary agregar-fila" >Agregar producto</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
              
                    </div>
            </div>      
        </form>                      
    </div>
</div>

<script>
    const products = {!! json_encode($products) !!};

    // Agrega una nueva fila a la tabla
    function agregarFila() {
        const tablaProductos = document.querySelector('#tabla-productos');
        const nuevaFila = tablaProductos.insertRow(tablaProductos.rows.length);
        const columnaProducto = nuevaFila.insertCell(0);
        const columnaCantidad = nuevaFila.insertCell(1);
        const columnaEliminar = nuevaFila.insertCell(2);

        const options = products.map(producto => {
            return `
                <option value="${producto.ID}">${producto.nombre}</option>
            `;
        }).join('');

        columnaProducto.innerHTML = `
            <select class="form-select shadow-none" name="productos[]">
                <option value="{{ old('ID') }}" selected>Seleccione un Material</option>
                ${options}
            </select>
        `;
        columnaCantidad.innerHTML = '<input type="text" name="cantidades[]" class="form-control">';
        columnaEliminar.innerHTML = '<button type="button" class="btn btn-danger eliminar-fila">Eliminar</button>';
    }

    // Elimina una fila de la tabla
    function eliminarFila(event) {
        const fila = event.target.closest('tr');
        fila.remove();
    }

    // Agrega una fila al hacer clic en el botón "Agregar producto"
    document.querySelector('.agregar-fila').addEventListener('click', agregarFila);

    // Elimina una fila al hacer clic en el botón "Eliminar"
    document.querySelector('#tabla-productos').addEventListener('click', function(event) {
        if (event.target.classList.contains('eliminar-fila')) {
            eliminarFila(event);
        }
    });
</script>


{{-- <script>
    // Agrega una nueva fila a la tabla
    function agregarFila() {
        const tablaProductos = document.querySelector('#tabla-productos');
        const nuevaFila = tablaProductos.insertRow(tablaProductos.rows.length);
        const columnaProducto = nuevaFila.insertCell(0);
        const columnaCantidad = nuevaFila.insertCell(1);
        const columnaEliminar = nuevaFila.insertCell(2);
        columnaProducto.innerHTML = '<input type="text" name="productos[]" class="form-control">';
        columnaCantidad.innerHTML = '<input type="text" name="cantidades[]" class="form-control">';
        columnaEliminar.innerHTML = '<button type="button" class="btn btn-danger eliminar-fila">Eliminar</button>';
    }

    // Elimina una fila de la tabla
    function eliminarFila(event) {
        const fila = event.target.closest('tr');
        fila.remove();
    }

    // Agrega una fila al hacer clic en el botón "Agregar producto"
    document.querySelector('.agregar-fila').addEventListener('click', agregarFila);

    // Elimina una fila al hacer clic en el botón "Eliminar"
    document.querySelector('#tabla-productos').addEventListener('click', function(event) {
        if (event.target.classList.contains('eliminar-fila')) {
            eliminarFila(event);
        }
    });
</script> --}}

@endsection