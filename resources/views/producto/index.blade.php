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


<form action="{{route('createProducto')}}" method="POST">
  @csrf
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Crear Producto</div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-4">
              <div class="form-group">
                <label for="text">Nombre Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la Producto" require />
                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="form-group">
                <label for="text">Descripcion Producto</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese la descripcion de la Producto" require />
                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
              </div>
            </div>
            <div class="col-md-6 col-lg-4">
              <div class="form-group">
                <label for="text">Precio Producto</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingrese el precio del Producto" require />
                <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
              </div>
            </div>   <div class="col-md-6 col-lg-4">
              <div class="form-group">
                <label for="largeSelect">Categorias</label>
                <select class="form-select form-control-lg" id="categoria" name="categoria" require>
                  <option value="0"> Selecione una categoria</option>
                  @foreach($categoria as $item)
                  <option value="{{$item->id}}"> {{$item->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
         

          </div>
        </div>
        <div class="card-action">
          <button type="submit" class="btn btn-success">Crear</button>
        </div>
      </div>
    </div>
  </div>
</form>











<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Lisatdo de Producto</h4>
        <!-- <button class="btn btn-success">
            <span class="btn-label">
              <i class="fa fa-plus"></i>
            </span>
            Crear Categoria
          </button> -->
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="basic-datatables" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>precio</th>
                <th>Categoria</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>precio</th>
                <th>Categoria</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($producto as $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nombre}}</td>
                <td>{{$item->descripcion}}</td>
                <td>{{$item->precio}}</td>
                <td>{{$item->categoria}}</td>
                <td>
                  <a href="{{route('eliminarProducto',  $item->id )}}"><button type="button" class="btn btn-icon btn-round btn-danger"><i class="fas fa-trash-alt"></i> </button></a>
                  <a href="{{route('modificarProducto', $item->id )}}"><button type="button" class="btn btn-icon btn-round btn-info"><i class="fas fa-edit"></i> </button></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
@section('script2')
<!-- jQuery Scrollbar -->
<script src="js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="js/plugin/datatables/datatables.min.js"></script>
<!-- Kaiadmin JS -->
<script src="js/kaiadmin.min.js"></script>
<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="js/setting-demo2.js"></script>
<script>
  $(document).ready(function() {
    $("#basic-datatables").DataTable({});

    $("#multi-filter-select").DataTable({
      pageLength: 5,
      initComplete: function() {
        this.api()
          .columns()
          .every(function() {
            var column = this;
            var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
              .appendTo($(column.footer()).empty())
              .on("change", function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                  .search(val ? "^" + val + "$" : "", true, false)
                  .draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function(d, j) {
                select.append(
                  '<option value="' + d + '">' + d + "</option>"
                );
              });
          });
      },
    });

    // Add Row
    $("#add-row").DataTable({
      pageLength: 5,
    });

    var action =
      '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

    $("#addRowButton").click(function() {
      $("#add-row")
        .dataTable()
        .fnAddData([
          $("#addName").val(),
          $("#addPosition").val(),
          $("#addOffice").val(),
          action,
        ]);
      $("#addRowModal").modal("hide");
    });
  });
</script>

@endsection