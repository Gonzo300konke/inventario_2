<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Base</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 text-xl font-bold">
                    🚀 Mi Proyecto
                </div>

                <!-- Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ url('/') }}" class="hover:text-gray-200">Inicio</a>
                    <a href="{{ route('organismos.index') }}" class="hover:text-gray-200">Organismos</a>
                    <a href="#" class="hover:text-gray-200">Usuarios</a>
                    <a href="#" class="hover:text-gray-200">Reportes</a>
                </div>

                <!-- Botón de login/acción -->
                <div>
                    <a href="#"
                       class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Ingresar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="flex flex-col items-center justify-center py-20">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenido a tu aplicación Laravel</h1>
        <p class="text-lg text-gray-600">Este es un menú base con Tailwind + Vite</p>
    </main>

</body>
</html>


