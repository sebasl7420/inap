@extends('layout.masterinvitado')

@section('main')
<title>Home</title>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Formulario de Pedido -->
                <h3 class="mb-3">Formulario de Pedido</h3>
                <p class="mb-4">
                    Este formulario ha sido diseñado con el propósito de hacer más fácil y sencillo para ti el proceso de
                    solicitud de nuevo material.
                    Nos tomamos muy en serio este proceso y nos comprometemos a trabajar contigo para entender todos tus
                    necesidades y garantizar que el producto entregado sea justo lo que estabas buscando 😊
                </p>
                <form action="{{ route('solicitud.store') }}" method="POST" id="product-form">
                    @csrf
                    @if (Auth::check())
                        <input type="hidden" id="user" name="user" value="{{ Auth::user()->username }}">
                    @else
                        <input type="hidden" id="user" name="user" value="Usuario no autenticado">
                    @endif
                    <div class="mb-3">
                        <label for="producto-id">Seleccione un producto:</label>
                        <select class="form-control" id="producto-id" name="producto-id">
                            @foreach ($productos->sortBy('categoria_id') as $producto)
                                <option value="{{ $producto->id }}:{{ $producto->nombre_producto }}">
                                    {{ $producto->categoria->nombre_categoria }} - {{ $producto->nombre_producto }}
                                    ({{ $producto->marca }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="producto-cant">Cantidad:</label>
                        <input type="number" id="producto-cant" min="1" class="form-control">
                    </div>
                    <button type="button" id="agregar-producto" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar producto
                    </button>
                    <ul id="product-list" class="mt-3"></ul>
                    <input type="hidden" id="json" name="json" rows="10" cols="50">
                    <button type="button" id="enviar-formulario" class="btn btn-success mt-3">
                        <i class="fas fa-paper-plane"></i> Enviar
                    </button>
                </form>
            </div>

            <div class="col-md-6">
                <!-- Listado de Productos -->
                <h3 class="mb-3">Productos Disponibles en {{ $dependencia }}</h3>
                <div class="table-responsive" style="max-height: 59vh;">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Nombre</th>
                                <th>Existencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productoslist as $productolist)
                                <tr>
                                    <td>{{ $productolist->categoria->nombre_categoria }}</td>
                                    <td>{{ $productolist->nombre_producto }} - {{ $productolist->marca }}</td>
                                    <td>{{ $productolist->stock_empaque }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            @if ($productoslist->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        href="{{ $productoslist->previousPageUrl() }}">Anterior</a></li>
                            @endif

                            @if ($productoslist->hasMorePages())
                                <li class="page-item"><a class="page-link"
                                        href="{{ $productoslist->nextPageUrl() }}">Siguiente</a></li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>





    {{-- funciones de la pagina --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Array para almacenar los productos
        let products = [];

        // Función para verificar si un producto ya está en la lista
        function isProductInList(id) {
            return products.some(product => product.id === id);
        }

        // Función para agregar un producto a la lista
        function addProductToList(id, cant) {
            if (!isProductInList(id) && cant > 0) {
                products.push({
                    id: id,
                    cant: cant
                });
                updateProductListUI();
            }
        }

        // Función para eliminar un producto de la lista
        function deleteProductFromList(id) {
            products = products.filter(product => product.id !== id);
            updateProductListUI();
        }

        // Función para actualizar la lista de productos en la interfaz
        function updateProductListUI() {
            $('#product-list').empty();
            products.forEach(product => {
                $('#product-list').append('<li>' + product.id + ' - ' + product.cant +
                    '<button class="btn btn-sm btn-danger delete-product" data-id="' + product.id +
                    '"><i class="fa-solid fa-xmark"></i></button></li>');
            });
        }

        // Función para comprimir los productos en JSON y mostrarlo en el input oculto
        function compressToJSON() {
            const jsonString = JSON.stringify(products);
            $('#json').val(jsonString);
        }

        // Evento al hacer clic en el botón "Agregar producto"
        $('#agregar-producto').click(function() {
            const productid = $('#producto-id').val();
            const productcant = parseFloat($('#producto-cant').val());
            if (!isProductInList(productid) && productcant > 0) {
                addProductToList(productid, productcant);
            }
            $('#producto-id').val('');
            $('#producto-cant').val('');
        });

        // Evento para eliminar un producto de la lista
        $(document).on('click', '.delete-product', function() {
            const productId = $(this).data('id');
            deleteProductFromList(productId);
        });

        // Evento al hacer clic en el botón "Enviar"
        $('#enviar-formulario').click(function() {
        // Comprimir a JSON antes de enviar si hay productos en la lista
        if (products.length > 0) {
            compressToJSON();
            // Enviar el formulario
            $('#product-form').submit();
        } else {
            alert('Debe agregar al menos un producto a la lista antes de enviar el formulario.');
        }
    });
    </script>
@endsection
