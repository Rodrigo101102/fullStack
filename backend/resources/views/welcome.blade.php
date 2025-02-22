<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caballero Urbano</title>
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
</head>
<body>

    <!-- Pasamos los productos desde Laravel a una variable global en JavaScript -->
    <script>
        window.products = @json($productos ?? []); // ✅ Evita error si `$productos` no está definido
        console.log("Productos cargados desde Laravel:", window.products);
    </script>

    <div id="app"></div>
</body>
</html>
