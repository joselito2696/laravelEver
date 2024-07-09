@extends('layouts.admin')
@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Categoria</h3>
</div>
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif


<form action="{{route('updateCategoria', $categoria->id )}}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Actualizar Categoria</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="text">Nombre Categoria</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$categoria->nombre}}" placeholder="Ingrese el nombre de la categoria" require />
                                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="text">Descripcion Categoria</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion"value="{{$categoria->descripcion}}" placeholder="Ingrese la descripcion de la categoria" />
                                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection