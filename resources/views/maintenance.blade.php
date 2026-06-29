<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        .hero-gradient {
            background: linear-gradient(135deg, #0A1928 0%, #0D2A3A 40%, #1B4D3E 100%);
        }
        
        .gear-animation {
            animation: spin 8s linear infinite;
        }
        
        .gear-animation-reverse {
            animation: spin-reverse 10s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes spin-reverse {
            from { transform: rotate(360deg); }
            to { transform: rotate(0deg); }
        }
        
        .pulse-ring {
            animation: pulse-ring 2s ease-out infinite;
        }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.7; }
            50% { transform: scale(1.05); opacity: 0.3; }
            100% { transform: scale(0.95); opacity: 0.7; }
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .float-animation-delay {
            animation: float 6s ease-in-out infinite 2s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        .bounce-dot {
            animation: bounce-dot 1.4s ease-in-out infinite;
        }
        
        .bounce-dot:nth-child(1) { animation-delay: 0s; }
        .bounce-dot:nth-child(2) { animation-delay: 0.2s; }
        .bounce-dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes bounce-dot {
            0%, 80%, 100% { transform: scale(0.6); opacity: 0.3; }
            40% { transform: scale(1); opacity: 1; }
        }
        
        .shimmer-text {
            background: linear-gradient(135deg, #2D6A4F 0%, #1B4D3E 50%, #2D6A4F 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .maintenance-icon {
            animation: pulse-maintenance 2s ease-in-out infinite;
        }
        
        @keyframes pulse-maintenance {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="hero-gradient min-h-screen flex items-center justify-center px-4 relative ">
    
    <!-- ============================================ -->
    <!-- BACKGROUND DECORATIONS -->
    <!-- ============================================ -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-10 left-10 w-72 h-72 bg-[#2D6A4F]/20 rounded-full blur-3xl float-animation"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-[#1B4D3E]/20 rounded-full blur-3xl float-animation-delay"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-white/5 rounded-full blur-3xl"></div>
        
        <!-- Floating Gears -->
        <div class="absolute top-20 right-20 text-white/10 text-6xl gear-animation hidden lg:block">
            <i class="fas fa-cog"></i>
        </div>
        <div class="absolute bottom-20 left-20 text-white/10 text-4xl gear-animation-reverse hidden lg:block">
            <i class="fas fa-cog"></i>
        </div>
        <div class="absolute top-1/3 right-1/4 text-white/5 text-3xl gear-animation hidden lg:block">
            <i class="fas fa-cog"></i>
        </div>
    </div>
    
    <!-- ============================================ -->
    <!-- MAIN CONTENT -->
    <!-- ============================================ -->
    <div class="relative z-10 max-w-3xl w-full">
        
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center space-x-3">
                <div class="w-14 h-14 bg-[#2D6A4F] rounded-2xl flex items-center justify-center shadow-2xl maintenance-icon">
                    <i class="fas fa-building text-white text-2xl"></i>
                </div>
                <span class="text-white text-3xl font-bold tracking-tight">{{ config('app.name') }}</span>
            </div>
        </div>
        
        <!-- Maintenance Card -->
        <div class="glass-card rounded-3xl p-8 md:p-12 shadow-2xl border border-white/10">
            
            <!-- Icon -->
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <div class="w-28 h-28 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center pulse-ring">
                        <div class="w-20 h-20 bg-[#2D6A4F] rounded-full flex items-center justify-center">
                            <i class="fas fa-tools text-white text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-white text-center mb-3">
                We're <span class="shimmer-text">Under Maintenance</span>
            </h1>
            
            <p class="text-center text-gray-300 text-lg mb-6 leading-relaxed">
              {{$settings['maintenance_message'] ?? ''}}
            </p>
             <!-- Estimated Time -->
            @if($returnDate ?? false)
                <div class="bg-white/5 rounded-xl p-4 text-center border border-white/10 mb-6">
                    <p class="text-gray-300 text-sm">
                        <i class="fas fa-calendar-alt text-[#2D6A4F] mr-2"></i>
                        Estimated Return: 
                        
                    </p>
                </div>
            @endif
          <div id="countdown"></div>
            <div id="countdowns" class="countdown">
        <div class="time-box">
            <span id="days">00</span>
            <small>Days</small>
        </div>

        <div class="time-box">
            <span id="hours">00</span>
            <small>Hours</small>
        </div>

        <div class="time-box">
            <span id="minutes">00</span>
            <small>Minutes</small>
        </div>

        <div class="time-box">
            <span id="seconds">00</span>
            <small>Seconds</small>
        </div>
    </div>
            <!-- Loading Dots -->
            <div class="flex justify-center space-x-2 mb-8">
                <span class="w-3 h-3 bg-[#2D6A4F] rounded-full bounce-dot"></span>
                <span class="w-3 h-3 bg-[#2D6A4F] rounded-full bounce-dot"></span>
                <span class="w-3 h-3 bg-[#2D6A4F] rounded-full bounce-dot"></span>
            </div>
            
            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                
                <div class="bg-white/5 rounded-xl p-4 text-center border border-white/5 hover:bg-white/10 transition">
                    <div class="w-10 h-10 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-clock text-[#2D6A4F] text-lg"></i>
                    </div>
                    <p class="text-white text-sm font-medium">Scheduled</p>
                    <p class="text-gray-400 text-xs">Planned improvements</p>
                </div>
                
                <div class="bg-white/5 rounded-xl p-4 text-center border border-white/5 hover:bg-white/10 transition">
                    <div class="w-10 h-10 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-shield-alt text-[#2D6A4F] text-lg"></i>
                    </div>
                    <p class="text-white text-sm font-medium">Security</p>
                    <p class="text-gray-400 text-xs">Enhancing protection</p>
                </div>
                
                <div class="bg-white/5 rounded-xl p-4 text-center border border-white/5 hover:bg-white/10 transition">
                    <div class="w-10 h-10 bg-[#2D6A4F]/20 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-rocket text-[#2D6A4F] text-lg"></i>
                    </div>
                    <p class="text-white text-sm font-medium">Performance</p>
                    <p class="text-gray-400 text-xs">Faster experience</p>
                </div>
            </div>
            
           

            
            
            <!-- Contact Support -->
            <div class="text-center">
                <p class="text-gray-400 text-sm mb-4">
                    Need immediate assistance? Our support team is available.
                </p>
                <a href="mailto:{{$settings['email'] ?? ''}}" 
                   class="inline-flex items-center px-6 py-3 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-xl font-medium transition shadow-lg hover:shadow-xl">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Support
                </a>
            </div>
            
        </div>
        
        <!-- Social Links -->
        <div class="text-center mt-8">
            <div class="flex justify-center space-x-4">
                <a href="{{$settings['facebook_url'] ?? ''}}" class="text-gray-400 hover:text-white transition text-lg">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="{{$settings['twitter_url'] ?? ''}}" class="text-gray-400 hover:text-white transition text-lg">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="{{$settings['instagram_url'] ?? ''}}" class="text-gray-400 hover:text-white transition text-lg">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="{{$settings['linkedin_url'] ?? ''}}" class="text-gray-400 hover:text-white transition text-lg">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            
            <p class="text-gray-500 text-xs mt-4">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </div>
    
    <!-- ============================================ -->
    <!-- STATUS INDICATOR -->
    <!-- ============================================ -->
    <div class="absolute bottom-4 right-4 flex items-center space-x-2 bg-white/5 backdrop-blur-sm rounded-full px-4 py-2 border border-white/5">
        <span class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></span>
        <span class="text-gray-400 text-xs">Maintenance in progress</span>
    </div>

   

<script>
const returnDate = new Date("{{ $returnDate }}").getTime();

setInterval(() => {
    const now = new Date().getTime();
    const distance = returnDate - now;

    if (distance <= 0) {
        document.getElementById('countdown').innerHTML =
            'Maintenance completed';
        return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

   

    document.getElementById('countdown').innerHTML =
        document.getElementById('days').textContent = days;
document.getElementById('hours').textContent = hours;
document.getElementById('minutes').textContent = minutes;
document.getElementById('seconds').textContent = seconds;
}, 1000);
</script>
<style>

body{
    overflow:scroll;
}
.countdown {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
}

.time-box {
    width: 120px;
    height: 120px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    transition: transform .3s ease;
}

.time-box:hover {
    transform: translateY(-5px);
}

.time-box span {
    font-size: 3rem;
    font-weight: 900;
    color: #38bdf8;
    text-shadow: 0 0 15px rgba(56, 189, 248, 0.6);
}

.time-box small {
    margin-top: 5px;
    font-size: .9rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #fff;
}
</style>
</body>
</html>