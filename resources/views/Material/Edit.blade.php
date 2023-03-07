@extends('layouts.app')
@section('content')


<div class="container">
    <div class="card-header">
        <h2>Editar de Material</h2>
    </div>
    <div class="row">
      @if (session('warning'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('warning') }}
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('success') }}
      </div>
      @endif
        <div class="col-md-12">
            <form  action="{{ route('material.update',$material) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')
              <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre del material</label>
                <input type="text" class="form-control shadow-none" id="nombre" name="nombre" value="{{ old('nombre',$material->nombre)}}">
                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="codigo" class="form-label">Codigo del material</label>
                <input type="text" class="form-control shadow-none" id="codigo" name="codigo" value="{{ old('codigo',$material->codigo) }}">
                @error('codigo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
              <label for="material"> Tipo de Material</label>
              <div class="form-check">
                <input type="radio" name="material" id="mp" value="1" {{ old('material',$material->esMateriaPrima)=='1' ? 'checked' : '' }}>
                <label for="mp" class="form-check-label">Materia Prima</label>
              </div>
              <div class="form-check">
                <input type="radio" name="material" id="nomp" value="0" {{ old('material',$material->esMateriaPrima)=='0' ? 'checked' : '' }}>
                <label for="nomp" class="form-check-label">Producto</label>
              </div>
              @error('material')
              <small class="text-danger">Seleccione una tipo de material</small>
              @enderror
          </div>


              <div class="col-md-12">
                <a class="btn btn-danger float-right" href="{{ route('material.index') }}">Volver al menu principal</a>		
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
        </div>
    </div>
</div>


@endsection