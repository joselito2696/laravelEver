@extends('layouts.admin')
@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
<div class="page-header">
    <h3 class="fw-bold mb-3">Realizar Ventas</h3>
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
                <div class="card-title">Buscar Clientes</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">CI o NIT</label>
                            <input type="text" class="form-control" id="ci" name="ci" placeholder="Ingrese el CI o NIT cliente" require />
                        </div>
                    </div>
                    <div class="card-action">
                        <button onclick="searchCliente()" class="btn btn-success">Buscar</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



<input type="hidden" id="idcliente" name="idcliente" />

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Datos del Cliente</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">CI o NIT Cliente</label>
                            <input type="text" class="form-control" id="clienteCi" name="clienteCi" readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Nombre Cliente</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Apellido Paterno </label>
                            <input type="text" class="form-control" id="paterno" name="paterno" readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                            <label for="text">Apellido Materno</label>
                            <input type="text" class="form-control" id="materno" name="materno" readonly />
                            <!-- <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone
                else.</small> -->
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
                document.getElementById('precioProd').value = data.precioventa;
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


    function searchCliente() {
        var ci = document.getElementById('ci').value;
        limpiar()
        fetch(`/cliente.${ci}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('data:', data)
                    document.getElementById('idcliente').value = data.cliente.id
                    document.getElementById('clienteCi').value = data.cliente.ci
                    document.getElementById('nombre').value = data.cliente.name;
                    document.getElementById('paterno').value = data.cliente.apellidomaterno;
                    document.getElementById('materno').value = data.cliente.apellidopaterno;
                    document.getElementById('ci').value = "";
                } else {
                    alert('cliente no encontrado')
                }

            })
            .catch(error => console.error('Error:', error));
    }

    function handleInput(event) {
        // Obtener el valor actual del primer campo de entrada
        const cantidad = event.target.value;

        // Modificar el valor del segundo campo de entrada
        const precio = document.getElementById('precioProd').value;

        const subtotal = precio * cantidad;
        document.getElementById('subtotal').value = subtotal;
    }


    function limpiar() {
        document.getElementById('idProd').value = "";
        document.getElementById('codBarraProd').value = "";
        document.getElementById('nombreProd').value = "";
        document.getElementById('cantidad').value = "";
        document.getElementById('precioProd').value = "";
        document.getElementById('subtotal').value = "";
        document.getElementById('codBarra').value = "";
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

    function eliminarTodaTabla() {
        total = 0;
        tbody.innerHTML = '';

    }


    const tbody = document.querySelector('#basic-datatables tbody');
    const guardarTodosBtn = document.getElementById('guardar-todos');
    guardarTodosBtn.addEventListener('click', function() {
        const idcliente = document.getElementById('idcliente').value;
        // const codInv = document.getElementById('codInv').value;
        if (idcliente == "") {
            alert('Tienes que ingresar el codigo de inventario')
        } else {
            // if (tipoMoviento == "Selecione una Opcion") {
            //     alert('Tienes que Seleccionar un Tipo de Moviento')
            // } else {



            const filas = tbody.querySelectorAll('tr');
            const productos = [];
            // const cliente = {
            //     codCliente: idcliente
            // }
            // productos.push(cliente);
            filas.forEach(fila => {
                const columnas = fila.querySelectorAll('td');
                const producto = {
                    id: columnas[0].innerText,
                    nombre: columnas[1].innerText,
                    codigoBarra: columnas[2].innerText,
                    cantidad: parseInt(columnas[3].innerText),
                    precio: parseInt(columnas[4].innerText),
                    subtotal: parseInt(columnas[5].innerText),
                    codCliente: idcliente,
                    total:total

                };
                productos.push(producto);
            });

            fetch(`{{ route('createVenta')}}`, {
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
                        alert('Venta realiazada correctamente');
                        location.reload();
                    } else {

                        alert(data.message)
                        // if (data.codinv) {
                        //     alert('Error el codigo de inventario repetido');
                        // } else {
                        //     alert('Error al guardar los productos');
                            
                        //     agregarProductoArray(data.body);
                        // }


                    }
                })
                .catch(error => console.error('Error:', error));
            // }

        }

    });
</script>

@endsection