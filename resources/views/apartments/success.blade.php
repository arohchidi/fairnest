<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="5;url={{ $whatsapp_link }}">
    <title>Request Submitted - {{ config('app.name') }}</title>
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
        .pulse-ring {
            animation: pulse-ring 2s ease-out infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.7; }
            50% { transform: scale(1.05); opacity: 0.3; }
            100% { transform: scale(0.95); opacity: 0.7; }
        }
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            border-radius: 2px;
            animation: confetti-fall 3s linear infinite;
        }
        @keyframes confetti-fall {
            0% { transform: translateY(-100vh) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
        }
        .countdown-bar {
            height: 4px;
            background: linear-gradient(to right, #2D6A4F, #1B4D3E);
            width: 100%;
            animation: countdown 5s linear forwards;
        }
        @keyframes countdown {
            from { width: 100%; }
            to { width: 0%; }
        }
        .whatsapp-button {
            background: #25D366;
            transition: all 0.3s ease;
        }
        .whatsapp-button:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4);
        }
    </style>
</head>
<body class="hero-gradient min-h-screen flex items-center justify-center px-4 relative overflow-hidden">
    
    <!-- Confetti -->
    <div id="confettiContainer"></div>
    
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-72 h-72 bg-[#2D6A4F]/20 rounded-full blur-3xl float-animation"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-[#1B4D3E]/20 rounded-full blur-3xl float-animation"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl"></div>
    </div>
    
    <!-- Main Content -->
    <div class="relative z-10 max-w-2xl w-full">
        
        <!-- Success Card -->
        <div class="bg-white/10 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/10 p-8 md:p-12 text-center">
            
            <!-- Success Icon -->
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <div class="w-28 h-28 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center pulse-ring">
                        <div class="w-20 h-20 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-white text-5xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                Request Submitted! 🎉
            </h1>
            
            <p class="text-gray-300 text-lg mb-2">
                Your apartment request has been received successfully.
            </p>
            
            <!-- Countdown -->
            <div class="mt-6">
                <p class="text-gray-300 text-sm mb-2">
                    <i class="fas fa-clock mr-1"></i>
                    Redirecting to WhatsApp in <span id="countdown" class="font-bold text-white">5</span> seconds
                </p>
                <div class="w-full bg-white/10 rounded-full overflow-hidden">
                    <div class="countdown-bar"></div>
                </div>
            </div>
            
            <!-- WhatsApp Button -->
            <div class="mt-8">
                <a href="{{ $whatsapp_link }}" 
                   target="_blank"
                   class="whatsapp-button inline-flex items-center px-8 py-4 text-white rounded-xl font-semibold text-lg shadow-lg">
                    <i class="fab fa-whatsapp text-2xl mr-3"></i>
                    <span>Chat with Us on WhatsApp</span>
                    <i class="fas fa-arrow-right ml-3"></i>
                </a>
            </div>
            
            <!-- Divider -->
            <div class="flex items-center justify-center space-x-4 mt-8">
                <div class="flex-1 h-px bg-white/10"></div>
                <span class="text-gray-400 text-sm">or</span>
                <div class="flex-1 h-px bg-white/10"></div>
            </div>
            
            <!-- Alternative Actions -->
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="{{ route('property.listings') }}" 
                   class="inline-flex items-center px-6 py-2.5 bg-white/10 backdrop-blur-sm border border-white/10 text-white rounded-xl hover:bg-white/20 transition">
                    <i class="fas fa-search mr-2"></i>
                    Browse Properties
                </a>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-2.5 bg-white/10 backdrop-blur-sm border border-white/10 text-white rounded-xl hover:bg-white/20 transition">
                    <i class="fas fa-home mr-2"></i>
                    Go Home
                </a>
            </div>
            
            <!-- Request Details Summary -->
            <div class="mt-8 pt-6 border-t border-white/10 text-left">
                <p class="text-gray-400 text-sm mb-3">Request Summary:</p>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div>
                        <p class="text-gray-400">Name:</p>
                        <p class="text-white font-medium">{{ $request->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Location:</p>
                        <p class="text-white font-medium capitalize">{{ str_replace('_', ' ', $request->preferred_location) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Apartment:</p>
                        <p class="text-white font-medium capitalize">{{ str_replace('_', ' ', $request->apartment_type) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Budget:</p>
                        <p class="text-white font-medium">{{ str_replace('_', ' - ₦', $request->budget) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-500 text-xs">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>
    
    <script>
        // Countdown
        let seconds = 5;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(function() {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(timer);
                // Redirect to WhatsApp
                window.location.href = "{{ $whatsapp_link }}";
            }
        }, 1000);
        
        // Generate confetti
        function createConfetti() {
            const container = document.getElementById('confettiContainer');
            const colors = ['#2D6A4F', '#1B4D3E', '#25D366', '#FFD700', '#FF6B6B', '#4ECDC4', '#45B7D1'];
            
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = (Math.random() * 8 + 4) + 'px';
                confetti.style.height = (Math.random() * 8 + 4) + 'px';
                confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                confetti.style.animationDelay = (Math.random() * 3) + 's';
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '2px';
                container.appendChild(confetti);
            }
        }
        
        // Create confetti on page load
        document.addEventListener('DOMContentLoaded', createConfetti);
        
        // Prevent accidental navigation
        window.addEventListener('beforeunload', function(e) {
            // Allow navigation
        });
    </script>
</body>
</html>