@extends('layouts.admin')
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsectio
@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">Inventario</h3>
</div>

@if(session()->has('msj'))
<div class="alert alert-success" role="alert">{{session('msj')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">{{session('error')}}</div>
@endif



<!-- <form action="{{route('createProducto')}}" method="POST">
    @csrf -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="largeSelect">Tipo movimiento</label>
                            <select class="form-select form-control-lg" id="tipo" name="tipo" require>
                                <option value="Selecione una Opcion"> Selecione una Opcion</option>
                                <option value="Entrada Inventario"> Entrada Inventario</option>
                                <option value="Salida Inventario"> Salida Inventario</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Codigo de Inventario </label>
                            <input type="text" class="form-control" id="codInv" name="codInv" placeholder="Ingrese el codigo de Inventario" require />
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Buscar Producto</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Codigo de Barra </label>
                            <input type="text" class="form-control" id="codBarra" name="codBarra" placeholder="Ingrese la descripcion de la Producto" require />
                        </div>
                    </div>
                    <div class="card-action">
                        <button onclick="searchProduct()" class="btn btn-success">Buscar</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- </form> -->


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
                            <label for="text">Cantidad </label>
                            <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" require />
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
                <h4 class="card-title">Listado de Producto</h4>
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Codigo Barra</th>
                                <th>cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <!-- <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    <a href=""><button type="button" class="btn btn-icon btn-round btn-danger"><i class="fas fa-trash-alt"></i> </button></a>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-action">
            <button class="btn btn-success" id="guardar-todos">guardar</button>
        </div>
    </div>
</div>




@endsection
@section('script2')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Carga jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    function searchProduct() {
        var barcode = document.getElementById('codBarra').value;
        limpiar()
        fetch(`/product.${barcode}`)
            .then(response => response.json())
            .then(data => {

                console.log('data:', data)
                document.getElementById('idProd').value = data.id
                document.getElementById('codBarraProd').value = data.codbarra;
                document.getElementById('nombreProd').value = data.nombre;
                // if (data.message) {
                //     document.getElementById('product-info').innerHTML = data.message;
                // } else {
                //     document.getElementById('product-info').innerHTML = `
                //             <p>Nombre: ${data.name}</p>
                //             <p>Precio: ${data.price}</p>
                //             <p>Descripción: ${data.description}</p>
                //         `;
                // }
            })
            .catch(error => console.error('Error:', error));
    }


    function limpiar() {
        document.getElementById('idProd').value = "";
        document.getElementById('codBarraProd').value = "";
        document.getElementById('nombreProd').value = "";
        document.getElementById('cantidad').value = "";
    }

    function agregarProducto() {
        console.log('paso')

        const id = document.getElementById('idProd').value;
        const codigoBarra = document.getElementById('codBarraProd').value;
        const nombre = document.getElementById('nombreProd').value;
        const cantidad = document.getElementById('cantidad').value;


        const tbody = document.querySelector('#basic-datatables tbody');

        // Función para agregar una fila a la tabla

        const tr = document.createElement('tr');

        tr.innerHTML = `
        <td>${id}</td>
        <td>${nombre}</td>
        <td>${codigoBarra}</td>
        <td>${cantidad}</td>
        <td>
            <button type="button" class="btn btn-icon btn-round btn-danger btn-eliminar"><i class="fas fa-trash-alt"></i></button>
        </td>
    `;

        tbody.appendChild(tr);

        // Añadir evento al botón eliminar
        const btnEliminar = tr.querySelector('.btn-eliminar');
        btnEliminar.addEventListener('click', function() {
            tr.remove();
        });
        limpiar()

        // // Agregar todos los productos a la tabla
        // productos.forEach(producto => {
        //     agregarFila(producto);
        // });
    }

    function eliminarTodaTabla() {
        tbody.innerHTML = '';

    }


    const tbody = document.querySelector('#basic-datatables tbody');
    const guardarTodosBtn = document.getElementById('guardar-todos');
    guardarTodosBtn.addEventListener('click', function() {
        const tipoMoviento = document.getElementById('tipo').value;
        const codInv = document.getElementById('codInv').value;
        if (codInv == "") {
            alert('Tienes que ingresar el codigo de inventario')
        } else {
            if (tipoMoviento == "Selecione una Opcion") {
                alert('Tienes que Seleccionar un Tipo de Moviento')
            } else {



                const filas = tbody.querySelectorAll('tr');
                const productos = [];

                filas.forEach(fila => {
                    const columnas = fila.querySelectorAll('td');
                    const producto = {
                        id: columnas[0].innerText,
                        nombre: columnas[1].innerText,
                        codigoBarra: columnas[2].innerText,
                        cantidad: parseInt(columnas[3].innerText),
                        tipo: tipoMoviento,
                        codInv: codInv
                    };
                    productos.push(producto);
                });

                fetch(`{{ route('createInventario')}}`, {
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
                            alert('Todos los productos se guardaron correctamente');
                            location.reload();
                        } else {
                            if (data.codinv) {
                                alert('Error el codigo de inventario repetido');
                            } else {
                                alert('Error al guardar los productos');
                                eliminarTodaTabla();
                                agregarProductoArray(data.body);
                            }


                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

        }

    });




    function agregarProductoArray(productos) {
        // Agregar todos los productos a la tabla
        productos.forEach(producto => {

            const tbody = document.querySelector('#basic-datatables tbody');

            // Función para agregar una fila a la tabla

            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${producto.codigoBarra}</td>
                <td>${producto.cantidad}</td>
                <td>
                    <button type="button" class="btn btn-icon btn-round btn-danger btn-eliminar"><i class="fas fa-trash-alt"></i></button>
                </td>
                 `;

            tbody.appendChild(tr);

            // Añadir evento al botón eliminar
            const btnEliminar = tr.querySelector('.btn-eliminar');
            btnEliminar.addEventListener('click', function() {
                tr.remove();
            });



        });






    }
</script>

@endsection