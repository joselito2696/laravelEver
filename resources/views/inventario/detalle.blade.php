@extends('layouts.admin')
@section('content')

<!-- <div class="page-header">
    <h3 class="fw-bold mb-3">Detalle de Inventario</h3>
</div>
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif -->



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detalle de Inventario</h4>
               
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                            <th>Id</th>
                                <th>Codigo</th>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>cantidad</th>
                                <th>Tipo Movimiento</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>cantidad</th>
                                <th>Tipo Movimiento</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($inventario as $item)
                            <tr>

                                <td>{{$item->id}}</td>
                                <td>{{$item->codigoinv}}</td>
                                <td>{{$item->fecha}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->cantidad}}</td>
                                <td>{{$item->tipo_movimiento}}</td>
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