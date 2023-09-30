@extends('layout.master')

@section('main')
<title>Editar solicitud {{$solicitud->id}}</title>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Editar Solicitud</h3>
                    <form action="{{ route('solicitud.update', $solicitud->id) }}" method="POST" id="product-form">
                        @csrf
                        @method('PUT')
                        
                        <ul id="product-list" class="list-group mb-4"></ul>
                        
                        <div class="form-group">
                            <label for="producto-id" class="subtitulos">Seleccione un producto:</label>
                            <select class="form-control" id="producto-id" name="producto-id">
                                @foreach ($productos->sortBy('categoria_id') as $producto)
                                    <option value="{{ $producto->id }}:{{ $producto->nombre_producto }}">
                                        {{ $producto->nombre_producto }} ({{ $producto->marca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="producto-cant" class="subtitulos">Cantidad:</label>
                            <input type="number" id="producto-cant" min="1" class="form-control">
                        </div>
                        
                        <button type="button" id="agregar-producto" class="btn btn-primary">
                            <i class="fa-solid fa-pencil"></i> Actualizar producto
                        </button>
                        
                        <input type="hidden" id="json" name="json" value="{{ $solicitud->json }}" rows="10" cols="50">
                        <input type="hidden" id="estado" name="estado" value="M">
                        
                        <div class="form-group mt-3">
                            <a href="{{ route('solicitud.show', $solicitud->id) }}" class="btn btn-warning">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="button" id="enviar-formulario" class="btn btn-success">
                                <i class="fa-regular fa-floppy-disk"></i> Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
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
        
        if (isProductInList(id) && cant > 0) {
            //borra el producto de la lista
            products = products.filter(product => product.id !== id);

            //agrega el producto a la lista
            products.push({
                id: id,
                cant: cant
            });
            
            // actualiza la lista  y comprimer
            updateProductListUI();
            compressToJSON();
        }
    }

    // Función para eliminar un producto de la lista
    // function deleteProductFromList(id) {
    //     products = products.filter(product => product.id !== id);
    //     updateProductListUI();
    //     compressToJSON();
    // }

    // Función para actualizar la lista de productos en la interfaz
    function updateProductListUI() {
        $('#product-list').empty();
        products.forEach(product => {
            $('#product-list').append('<li>' + product.id + ' - cantidad: ' + product.cant + '</li>');
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
        if (isProductInList(productid) && productcant > 0) {
            addProductToList(productid, productcant);
        }
        $('#producto-id').val('');
        $('#producto-cant').val('');
    });

    // Evento para eliminar un producto de la lista
    // $(document).on('click', '.delete-product', function() {
    //     const productId = $(this).data('id');
    //     deleteProductFromList(productId);
    // });

    // Evento al hacer clic en el botón "Enviar"
    $('#enviar-formulario').click(function() {
        // Comprimir a JSON antes de enviar
        compressToJSON();
        // Enviar el formulario
        $('#product-form').submit();
    });

    // Cargar los productos si ya existen (después de enviar el formulario)
    const existingJson = $('#json').val();
    if (existingJson) {
        products = JSON.parse(existingJson);
        updateProductListUI();
    }
</script>




@endsection
