<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #0A1928 0%, #0D2A3A 40%, #1B4D3E 100%);
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="hero-gradient min-h-screen flex items-center justify-center px-4 relative overflow-hidden">
    
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-72 h-72 bg-[#2D6A4F]/20 rounded-full blur-3xl float-animation"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-[#1B4D3E]/20 rounded-full blur-3xl float-animation"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl"></div>
    </div>
    
    <!-- Main Content -->
    <div class="relative z-10 max-w-2xl w-full text-center">
        
        <!-- Error Code -->
        <h1 class="text-8xl md:text-9xl font-bold text-white/10 tracking-wider select-none">
            404
        </h1>
        
        <!-- Icon -->
        <div class="flex justify-center -mt-8">
            <div class="w-24 h-24 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center">
                <i class="fas fa-map-signs text-4xl text-[#2D6A4F]"></i>
            </div>
        </div>
        
        <!-- Title -->
        <h2 class="text-2xl md:text-3xl font-bold text-white mt-6">
            Page Not Found
        </h2>
        
        <p class="text-gray-300 text-base md:text-lg mt-3 max-w-md mx-auto">
            Sorry, the page you are looking for doesn't exist or has been moved.
        </p>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
            <a href="{{ url('/') }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-xl font-medium transition shadow-lg hover:shadow-xl">
                <i class="fas fa-home mr-2"></i>
                Go Home
            </a>
            <a href="javascript:history.back()" 
               class="inline-flex items-center justify-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-xl font-medium transition border border-white/10">
                <i class="fas fa-arrow-left mr-2"></i>
                Go Back
            </a>
        </div>
        
        <!-- Footer -->
        <div class="mt-12">
            <p class="text-gray-500 text-xs">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>
    
</body>
</html>