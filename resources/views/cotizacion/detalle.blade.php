@extends('layouts.admin')
@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">ID Cotizacion: {{$cotizacions[0]->id}} </h3>
    <h3 class="fw-bold mb-3">/ Cliente: {{$cotizacions[0]->name}} </h3>
    <h3 class="fw-bold mb-3"> / Fecha: {{$cotizacions[0]->fecha}}</h3>
</div>




<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detalle de Cotizacion</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID Cotizacion</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>{{$cotizacions[0]->total}}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($detallecotizacions as $item)
                            <tr>

                                <td>{{$item->id_cotizacion}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->cantidad}}</td>
                                <td>{{$item->precio_unitario}}</td>
                                <td>{{$item->subtotal}}</td>
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