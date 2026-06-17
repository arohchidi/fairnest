<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>
    <meta name="description" content="@yield('description', 'Find your perfect rental property')">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style> 
    
    @stack('styles')
</head>
@extends('layouts.frontend')
@section('content')

<body class="bg-gray-50">
    
<div class="bg-white min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4">
        
        <!-- Success Animation -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-6 animate-bounce">
                <i class="fas fa-check-circle text-green-500 text-5xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Booking Confirmed </h1>
            <p class="text-gray-500">Your inspection appointment has been successfully submitted.</p>
        </div>
        
        <!-- Booking Details Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-4 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A]">
                <div class="flex items-center justify-between">
                    <h2 class="text-white font-semibold text-lg">Booking Details</h2>
                    <span class="bg-[#2D6A4F] text-white text-xs px-3 py-1 rounded-full">Confirmed</span>
                </div>
            </div>
            
            <div class="p-6 space-y-5">
                <!-- Booking Reference -->
                <div class="text-center pb-4 border-b border-gray-100">
                    <p class="text-sm text-gray-500 uppercase tracking-wide">Booking Reference</p>
                    <p class="text-2xl font-bold text-[#2D6A4F] font-mono mt-1">{{ $booking->reference ?? '#' . strtoupper(uniqid()) }}</p>
                </div>
                
                <!-- Property Info -->
                <div class="flex items-start space-x-4 pb-4 border-b border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-building text-2xl text-gray-400"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-500">Property</p>
                        <p class="font-semibold text-gray-800">{{ $property['title'] }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">
                            <i class="fas fa-map-marker-alt text-[#2D6A4F] text-xs mr-1"></i>
                            {{ ucfirst($property['address']) }}, {{ ucfirst($property['city']) }}, {{ucfirst($property['country'])}}
                        </p>
                    </div>
                </div>
                
                <!-- Guest Info -->
                <div class="grid grid-cols-2 gap-4 pb-4 border-b border-gray-100">
                    <div>
                        <p class="text-sm text-gray-500">Name</p>
                        <p class="font-medium text-gray-800">{{ $booking['username']  }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-800">{{ $booking['email']  }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="font-medium text-gray-800">{{ $booking['phone']  }}</p>
                    </div>
                </div>
                
                <!-- Travel Dates -->
                <div class="grid grid-cols-2 gap-4 pb-4 border-b border-gray-100">
                    <div>
                        <p class="text-sm text-gray-500">Inspection Date</p>
                        <div class="flex items-center mt-1">
                            <i class="fas fa-calendar-alt text-[#2D6A4F] mr-2 text-sm"></i>
                            <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($booking['booking_date'])->format('l, M d, Y') }}</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-1"></p>
                    </div>
                
                </div>
               
                
                <!-- Price Breakdown -->
                <div class="space-y-2 pt-2">
                    <p class="text-sm text-gray-500">Payment Structure</p>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Rent</span>
                        <span class="text-gray-800">{{ App\Helper::formatNaira(number_format($property['rent_fee'],0)) }} </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Legal fee</span>
                        <span class="text-gray-800">{{ App\Helper::formatNaira(number_format($property['legal_fee'],0)) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Service fee</span>
                        <span class="text-gray-800">{{ App\Helper::formatNaira(number_format($property['mgt_fee'],0)) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Caution fee</span>
                        <span class="text-gray-800">{{ App\Helper::formatNaira(number_format($property['caution_fee'],0)) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Agency fee</span>
                        <span class="text-gray-800">{{ App\Helper::formatNaira(number_format($property['agency_fee'],0)) }}</span>
                    </div>

                    <div class="flex justify-between pt-2 border-t border-gray-200">
                        <span class="font-bold text-gray-800">Total paid</span>
                        <span class="text-2xl font-bold text-[#2D6A4F]">${{ number_format($property['agency_fee'] + $property['caution_fee'] + $property['caution_fee'] + $property['mgt_fee'] + $property['legal_fee'] + $property['rent_fee']) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- What Happens Next Card -->
        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200 mb-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-clock text-[#2D6A4F] mr-2"></i>
                What happens next?
            </h3>
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-[#2D6A4F] text-xs font-bold">1</span>
                    </div>
                    <p class="text-sm text-gray-600">You'll receive a confirmation email with your booking details.</p>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-[#2D6A4F] text-xs font-bold">2</span>
                    </div>
                    <p class="text-sm text-gray-600">The property owner will be notified of your booking request.</p>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <span class="text-[#2D6A4F] text-xs font-bold">3</span>
                    </div>
                    <p class="text-sm text-gray-600">You'll receive check-in instructions 48 hours before arrival.</p>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
           
            <a href="{{ route('property.listings') }}" class="px-6 py-3 bg-[#2D6A4F] hover:bg-[#1B4D3E] text-white rounded-xl font-medium transition text-center">
                Browse More Properties
            </a>
        </div>
        
        <!-- Need Help -->
        <div class="text-center mt-8">
            <p class="text-sm text-gray-500">
                Need help? <a href="{{ route('contact') }}" class="text-[#2D6A4F] hover:underline">Contact our support team</a>
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce {
        animation: bounce 0.6s ease-in-out;
    }
</style>
@include('components.footer')
</body>
@endsection