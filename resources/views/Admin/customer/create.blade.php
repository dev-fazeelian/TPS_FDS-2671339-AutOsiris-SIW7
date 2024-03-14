@include("layouts.headerAdmin")

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes | Añadir</title>

    {{-- Hoja de estilos --}}
    <link rel="stylesheet" href="{{ asset("assets/css/Admin/modules/Customers/form-styles.css") }}">
</head>
<body>
    @includeif('partials.errors')
        <!-- Contenido de página -->
        <section class="contenido-pag">
            <!-- Titulo de ventana -->
            <div class="titulo-ventana">
                <h1>Añadir Cliente</h1>
            </div>

            <form method="POST" action="{{ route('customers.store') }}"  role="form" enctype="multipart/form-data" id="form-roles">
                @csrf
                @include('Admin.customer.form')

                <!-- Opciones roles -->
                <div class="opciones-roles">
                    <!-- Botón: Cancelar -->
                    <button class="bott-cancelar">
                        <h2><a href="{{ route("customers.index") }}">Volver</a></h2>
                    </button>
                    <button class="bott-guardar-cambios" type="submit">
                        <h2>Añadir Cliente</h2>
                    </button>
                </div>
            </form>
        </section>
</body>
</html>
