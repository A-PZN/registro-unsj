<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">

    <title>AnimalApp</title>
    <!--cargamos los archivos css y js desde el servidor Vite-->
       @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Nunito', sans-serif; }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen flex flex-col">

<!-- Navabr-->
    <nav class="bg-gray-800 border-b border-gray-700 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('animales.index') }}" class="text-2xl font-extrabold text-white tracking-tight">
                Animal<span class="text-fuchsia-400">App</span>
            </a>

            <div class="flex space-x-8">
                <a href="{{ route('animales.index') }}" class="text-sm font-bold text-gray-300 hover:text-fuchsia-400 transition">
                    Inicio
                </a>
                <a href="{{ route('animales.create') }}" class="text-sm font-bold text-gray-300 hover:text-fuchsia-400 transition">
                    Registra
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenido principal aqui se inyecta las vistas hijas  -->
    <main class="container mx-auto p-6 flex-grow w-full">
        @yield('content')
    </main>
<!--Footer-->
    <footer class="bg-gray-800 border-t border-gray-700 p-6 text-center text-gray-400 text-sm mt-auto">
        &copy; 2026 AnimalApp - Desarrollo Backend I
    </footer>

</body>
</html>