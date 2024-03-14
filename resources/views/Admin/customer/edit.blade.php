@include("layouts.headerAdmin")

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cliente | {{ $customer->name }} | Editar</title>

    <link rel="stylesheet" href="{{ asset("assets/css/Admin/modules/Customers/form-styles.css") }}">
</head>
<body>
    @includeif('partials.errors')
        <!-- Contenido de página -->
        <section class="contenido-pag">
            <!-- Titulo de ventana -->
            <div class="titulo-ventana">
                <h1>Editar Rol</h1>
            </div>
            <form method="POST" action="{{ route('customers.update', $customer->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf
                @include('Admin.customer.form')

                <!-- Opciones roles -->
                <div class="opciones-roles">
                    <!-- Botón: Cancelar -->
                    <button class="bott-cancelar">
                        <a href="{{ route("customers.index") }}"><h2>Volver</h2></a>
                    </button>
                    <button class="bott-guardar-cambios" type="submit">
                        <h2>Actualizar Cliente</h2>
                    </button>
                </div>
            </form>
        </section>
</body>
</html>
