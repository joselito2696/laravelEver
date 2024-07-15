@extends('layouts.admin')
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')

<div class="page-header">
    <h3 class="fw-bold mb-3">Corizacion</h3>
</div>
@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif


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
                    <table id="basic-datatables2" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Codigo Barra</th>
                                <th>precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Codigo Barra</th>
                                <th>precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($producto as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>{{$item->codbarra}}</td>
                                <td>{{$item->precioventa}}</td>
                                <td>{{$item->stock}}</td>
                                <td>
                                    <button type="button" class="btn btn-icon btn-round btn-success" onclick="agregarProductoDetalle('{{json_encode($item)}}')"><i class="fas fa-check"></i> </button>
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






<!-- Ingreso del producto buscado -->
<input type="hidden" id="idProd" name="idProd" />

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Datos del Producto Producto</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Nombre Producto</label>
                            <input type="text" class="form-control" id="nombreProd" name="nombreProd" placeholder="Ingrese el nombre de la Producto" readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Codigo de Barra </label>
                            <input type="text" class="form-control" id="codBarraProd" name="codBarraProd" placeholder="Ingrese el codigo de Barra" readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Precio </label>
                            <input type="text" class="form-control" id="precioProd" name="precioProd" placeholder="" readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Cantidad </label>
                            <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" oninput="handleInput(event)" require />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Subtotal </label>
                            <input type="text" class="form-control" id="subtotal" name="subtotal" placeholder="" require readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success" onclick="agregarProducto()">agregar</button>
                </div>
            </div>

        </div>
    </div>
</div>









<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Carrito de Cotizacion</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Codigo Barra</th>
                                <th>cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th> </th>
                                <th></th>
                                <th>TOTAL Bs</th>
                                <th id="total"></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-action">
                <button class="btn btn-success" id="guardar-todos">guardar</button>
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
    function handleInput(event) {
        // Obtener el valor actual del primer campo de entrada
        const cantidad = event.target.value;

        // Modificar el valor del segundo campo de entrada
        const precio = document.getElementById('precioProd').value;

        const subtotal = precio * cantidad;
        document.getElementById('subtotal').value = subtotal;
    }

    function agregarProductoDetalle(producto) {
        prod = JSON.parse(producto);
        if (prod.stock > 0) {
            document.getElementById('idProd').value = prod.id
            document.getElementById('codBarraProd').value = prod.codbarra;
            document.getElementById('nombreProd').value = prod.nombre;
            document.getElementById('precioProd').value = prod.precioventa;

        } else {
            alert("stock en cero no se puede seleccionar")
        }
    }
    let total = 0;

    function agregarProducto() {
        console.log('paso')

        const id = document.getElementById('idProd').value;
        const codigoBarra = document.getElementById('codBarraProd').value;
        const nombre = document.getElementById('nombreProd').value;
        const cantidad = document.getElementById('cantidad').value;
        const precio = document.getElementById('precioProd').value;
        const subtotal = document.getElementById('subtotal').value;
        total = total + parseFloat(subtotal);
        let totalTh = document.getElementById('total');
        totalTh.innerText = total;
        const tbody = document.querySelector('#basic-datatables tbody');

        // Función para agregar una fila a la tabla

        const tr = document.createElement('tr');

        tr.innerHTML = `
        <td>${id}</td>
        <td>${nombre}</td>
        <td>${codigoBarra}</td>
        <td>${cantidad}</td>
        <td>${precio}</td>
        <td>${subtotal}</td>
        <td>
            <button type="button" class="btn btn-icon btn-round btn-danger btn-eliminar"><i class="fas fa-trash-alt"></i></button>
        </td>
    `;

        tbody.appendChild(tr);

        // Añadir evento al botón eliminar
        const btnEliminar = tr.querySelector('.btn-eliminar');
        btnEliminar.addEventListener('click', function() {
            // let tr = button.closest('tr');
            // let tdValue = tr.querySelector('td')[1].innerText;
            let subtotalTable = tr.querySelectorAll('td')[5].innerText;
            total = total - parseFloat(subtotalTable);
            let totalTh = document.getElementById('total');
            totalTh.innerText = total;
            tr.remove();

        });
        limpiar()

        // // Agregar todos los productos a la tabla
        // productos.forEach(producto => {
        //     agregarFila(producto);
        // });
    }

    function limpiar() {
        // document.getElementById('idProd').value = "";
        // document.getElementById('codBarraProd').value = "";
        // document.getElementById('nombreProd').value = "";
        // document.getElementById('cantidad').value = "";
        // document.getElementById('precioProd').value = "";
        // document.getElementById('subtotal').value = "";
        // document.getElementById('codBarra').value = "";

        document.getElementById('idProd').value = ""
        document.getElementById('codBarraProd').value = ""
        document.getElementById('nombreProd').value = ""
        document.getElementById('precioProd').value = ""
        document.getElementById('cantidad').value = "";
        document.getElementById('subtotal').value = "";
    }

    const tbody = document.querySelector('#basic-datatables tbody');
    const guardarTodosBtn = document.getElementById('guardar-todos');

    guardarTodosBtn.addEventListener('click', function() {
        const filas = tbody.querySelectorAll('tr');
        const productos = [];
        filas.forEach(fila => {
            const columnas = fila.querySelectorAll('td');
            const producto = {
                id: columnas[0].innerText,
                nombre: columnas[1].innerText,
                codigoBarra: columnas[2].innerText,
                cantidad: parseInt(columnas[3].innerText),
                precio: parseInt(columnas[4].innerText),
                subtotal: parseInt(columnas[5].innerText),
                total: total

            };
            productos.push(producto);
        });

        fetch(`{{ route('createCotizacion')}}`, {
                method: 'POST',
                body: JSON.stringify({
                    productos: productos
                }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {

                console.log("inventario:", data)
                if (data.success) {
                    alert('Cotizacion realiazada correctamente');
                    location.reload();
                } else {
                    console.log("message", data.message)
                    alert(data.message)


                }
            })
            .catch(error => console.error('Error:', error));
        // }



    });
</script>
<script>
    $(document).ready(function() {
        $("#basic-datatables2").DataTable({});

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