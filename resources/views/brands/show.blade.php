<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{$brand->name ?? 'Marca'}}</title>
</head>
<body>
    <main class="container">
        <section class="row">
            <div class="col-12">
                <h2 class="text-center">{{$brand->name ?? 'Marca'}}</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <section class="row">
            <form action="{{route('brands.update', ['brand' => $brand])}}" method="POST" class="col-md-12">
                @csrf
                @method('PUT')
                <div class="row card p-2">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{$brand->name}}">
                    </div>
                    <input type="hidden" name="brand_id" value="{{$brand->id}}">
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal_add_product">Agregar Producto</button>
                    </div>
                </div>
            </form>
        </section>
        <section class="row mt-3">
            <div class="col-md-12">
                <h3 class="text-center">Listado de productos</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <form action="{{ route('products.delete', $product) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="modal_add_product">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Agregar Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <input type="hidden" name="brand_id" value="{{$brand->id}}">
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
  </div>
  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
