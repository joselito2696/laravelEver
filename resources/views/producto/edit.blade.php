@extends('layouts.admin')
@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Producto</h3>
</div>
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif


<form action="{{route('updateProducto', $producto[0]->id )}}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Actualizar Producto</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="text">Nombre Producto</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto[0]->nombre}}" placeholder="Ingrese el nombre de la Producto" require />
                                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="text">Descripcion Producto</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$producto[0]->descripcion}}" placeholder="Ingrese la descripcion de la Producto" />
                                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="text">Precio Producto</label>
                                <input type="text" class="form-control" id="precio" name="precio" value="{{$producto[0]->precio}}" placeholder="Ingrese el precio de la Producto" />
                                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="largeSelect">Categorias</label>
                                <select class="form-select form-control-lg" id="categoria" name="categoria" require>
                                    <option value="{{$producto[0]->id_categoria}}"> {{$producto[0]->categoria}}</option>
                                    @foreach($categoria as $item)
                                        @if($item->id != $producto[0]->id_categoria)
                                        <option value="{{$item->id}}"> {{$item->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
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