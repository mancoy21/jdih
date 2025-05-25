<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Jaringan Dokumentasi dan Informasi Hukum Kementerian Kesehatan RI">
    <meta name="keywords" content="JDIH, Kemenkes, Hukum, Peraturan, Kesehatan">
    <meta name="author" content="Kementerian Kesehatan RI">
    <title>{{ config('app.name') ?? 'JDIH Kemenkes' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 min-h-screen flex flex-col">
    @include('components.loading-screen')
    
    <!-- Main Container -->
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        @livewire('components.layout.header')
        
        <!-- Navbar -->
        @livewire('components.layout.navbar')
        
        <!-- Main Content -->
        <main class="flex-grow pt-16">
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        @livewire('components.layout.footer')
    </div>

    @livewireScripts
    
    <script>
        // Global JS functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize any global JS here
            console.log('JDIH Kemenkes Application Loaded');
        });
    </script>
</body>
</html>