{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDIH Kemenkes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">
    @include('components.loading-screen')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">
                {{ config('app.name') ?? 'JDIH Kemenkes' }}
            </h1>
        </div>
    </header>
    
    <div class="min-h-screen flex flex-col">
        @livewire('components.layouts.navbar')
   
        <main class="flex-grow">
            {{ $slot }}
        </main>
        @livewire('components.layouts.footer')
    </div>

    @livewireScripts
</body>
</html> --}}