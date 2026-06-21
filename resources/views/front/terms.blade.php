@extends('layouts.app')

@section('title', 'Terms and Conditions')
@section('description', 'Read our terms and conditions for using our platform')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="text-center mb-10" data-aos="fade-up">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                Terms and <span class="text-[#2D6A4F]">Conditions</span>
            </h1>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Please read these terms carefully before using our platform.
            </p>
            <div class="w-20 h-1 bg-[#2D6A4F] mx-auto mt-4 rounded-full"></div>
        </div>
        
        
        
        <!-- Content -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="p-6 md:p-10 prose prose-sm md:prose-base max-w-none">
                {!! $data->terms !!}
            </div>
        </div>
        
        <!-- Version & Download -->
        <div class="mt-8 flex flex-wrap justify-between items-center gap-4" data-aos="fade-up" data-aos-delay="300">
          
            <div class="flex space-x-3">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm font-medium">
                    <i class="fas fa-print mr-2"></i> Print
                </button>
                <button onclick="downloadPage()" class="inline-flex items-center px-4 py-2 bg-[#2D6A4F] text-white rounded-lg hover:bg-[#1B4D3E] transition text-sm font-medium">
                    <i class="fas fa-download mr-2"></i> Download PDF
                </button>
            </div>
        </div>
        
        <!-- Agreement Banner -->
        <div class="mt-10 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl p-6 md:p-8 text-center text-white" data-aos="fade-up">
            <h3 class="text-lg font-bold mb-3">By using our platform, you agree to these terms</h3>
            <p class="text-gray-300 text-sm mb-4">If you have any questions, please don't hesitate to contact us.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-2.5 bg-[#2D6A4F] text-white rounded-lg font-medium hover:bg-[#1B4D3E] transition">
                <i class="fas fa-envelope mr-2"></i> Contact Us
            </a>
        </div>
    </div>
</div>
@include('components.footer')
@push('scripts')
<script>
    function downloadPage() {
        // Simple print-to-PDF functionality
        window.print();
    }
</script>

<style>
    .prose h2 {
        color: #1a202c;
        font-size: 1.25rem;
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .prose p {
        color: #4a5568;
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    .prose ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1rem;
    }
    .prose ul li {
        color: #4a5568;
        margin-bottom: 0.25rem;
    }
    .prose a {
        color: #2D6A4F;
        text-decoration: underline;
    }
    .prose a:hover {
        color: #1B4D3E;
    }
</style>
@endpush
@endsection