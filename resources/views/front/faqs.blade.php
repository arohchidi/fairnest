@extends('layouts.app')

@section('title', 'Frequently Asked Questions')
@section('description', 'Find answers to the most common questions about our platform')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Frequently Asked <span class="text-[#2D6A4F]">Questions</span>
            </h1>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Find answers to the most common questions about our platform, booking process, and more.
            </p>
            <div class="w-20 h-1 bg-[#2D6A4F] mx-auto mt-4 rounded-full"></div>
        </div>
        
        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto mb-10" data-aos="fade-up" data-aos-delay="100">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="faqSearch" placeholder="Search for questions..." 
                       class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2D6A4F] focus:border-transparent transition shadow-sm bg-white">
                <p class="text-xs text-gray-400 mt-2" id="searchCount"></p>
            </div>
        </div>
        
        <!-- Tabs Navigation -->
        <div class="flex flex-wrap justify-center gap-2 mb-10" data-aos="fade-up" data-aos-delay="200">
            <button class="tab-btn active px-6 py-2.5 bg-[#2D6A4F] text-white rounded-full text-sm font-medium transition hover:bg-[#1B4D3E]" data-tab="all">
                <i class="fas fa-list mr-2"></i> All
            </button>
            @foreach($categories as $category)
                <button class="tab-btn px-6 py-2.5 bg-gray-200 text-gray-700 rounded-full text-sm font-medium transition hover:bg-gray-300" data-tab="{{ ucfirst($category) }}">
                    <i class="fas {{ $category->icon ?? 'fa-question-circle' }} mr-2"></i> {{ ucfirst($category) }}
                </button>
            @endforeach
        </div>
        
        <!-- FAQ Content -->
        <div class="space-y-4" id="faqContainer">
            @forelse($faqs as $category => $items)
              @foreach($items as $faq )
                
              
                <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all" 
                     data-category="{{ $faq->category }}" 
                     data-question="{{ strtolower($faq->question) }}" 
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    
                    <button class="faq-toggle w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition group" onclick="toggleFaq(this)">
                        <div class="flex items-center space-x-3 pr-4">
                            <span class="flex-shrink-0 w-8 h-8 bg-[#2D6A4F]/10 rounded-full flex items-center justify-center text-[#2D6A4F] text-sm font-bold">
                                {{ $loop->index + 1 }}
                            </span>
                            <span class="font-medium text-gray-800 group-hover:text-[#2D6A4F] transition">{{ $faq->question }}</span>
                        </div>
                        <span class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 group-hover:bg-[#2D6A4F] group-hover:text-white transition">
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                        </span>
                    </button>
                    
                    <div class="faq-answer hidden px-6 pb-4">
                        <div class="pt-2 border-t border-gray-100 text-gray-600 leading-relaxed">
                            {!! $faq->answer !!}
                        </div>
                        @if($faq->category)
                            <div class="mt-3">
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-500 text-xs rounded-full">
                                    <i class="fas fa-tag mr-1"></i> {{ $faq->category }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @empty
                <div class="text-center py-16 bg-white rounded-xl border border-gray-100">
                    <i class="fas fa-question-circle text-5xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">No FAQs found</p>
                    <p class="text-gray-400 text-sm mt-1">Check back later for answers to your questions.</p>
                </div>
            @endforelse
        </div>
        
        <!-- No Results Message -->
        <div id="noResults" class="hidden text-center py-16 bg-white rounded-xl border border-gray-100">
            <i class="fas fa-search text-5xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No matching questions found</p>
            <p class="text-gray-400 text-sm mt-1">Try adjusting your search terms</p>
        </div>
        
        <!-- Still Have Questions -->
        <div class="mt-12 bg-gradient-to-r from-[#0A1928] to-[#0D2A3A] rounded-2xl p-8 text-center text-white" data-aos="fade-up">
            <h3 class="text-xl font-bold mb-3">Still Have Questions?</h3>
            <p class="text-gray-300 mb-6">We're here to help. Reach out to our support team for personalized assistance.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-[#2D6A4F] text-white rounded-xl font-semibold hover:bg-[#1B4D3E] transition">
                <i class="fas fa-envelope mr-2"></i> Contact Support
            </a>
        </div>
    </div>
</div>
@include('components.footer')
@push('scripts')
<script>
    // FAQ Toggle function - must be globally accessible
    function toggleFaq(button) {
        const item = button.closest('.faq-item');
        const answer = item.querySelector('.faq-answer');
        const icon = button.querySelector('.fa-chevron-down');
        const isOpen = !answer.classList.contains('hidden');
        
        // Close all others
        document.querySelectorAll('.faq-item').forEach(otherItem => {
            if (otherItem !== item) {
                const otherAnswer = otherItem.querySelector('.faq-answer');
                const otherIcon = otherItem.querySelector('.fa-chevron-down');
                if (!otherAnswer.classList.contains('hidden')) {
                    otherAnswer.classList.add('hidden');
                    otherIcon.style.transform = 'rotate(0deg)';
                }
            }
        });
        
        // Toggle current
        if (isOpen) {
            answer.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        } else {
            answer.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        }
    }
    
    // Tab Filtering
    const tabButtons = document.querySelectorAll('.tab-btn');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('noResults');
    const searchInput = document.getElementById('faqSearch');
    const searchCount = document.getElementById('searchCount');
    
    let currentTab = 'general';
    let currentSearch = '';
    
    function filterFAQs() {
        let visibleCount = 0;
        
        faqItems.forEach(item => {
            const category = item.dataset.category;
            const question = item.dataset.question;
            
            const tabMatch = currentTab === 'all' || category === currentTab;
            const searchMatch = !currentSearch || question.includes(currentSearch);
            
            if (tabMatch && searchMatch) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
        
        if (searchCount) {
            searchCount.textContent = `${visibleCount} result${visibleCount !== 1 ? 's' : ''} found`;
        }
    }
    
    function setActiveTab(tabSlug) {
        tabButtons.forEach(btn => {
            btn.classList.remove('active', 'bg-[#2D6A4F]', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-700');
            
            if (btn.dataset.tab === tabSlug) {
                btn.classList.remove('bg-gray-200', 'text-gray-700');
                btn.classList.add('active', 'bg-[#2D6A4F]', 'text-white');
            }
        });
    }
    
    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            currentTab = this.dataset.tab;
            setActiveTab(currentTab);
            filterFAQs();
            
            document.querySelectorAll('.faq-answer').forEach(answer => {
                answer.classList.add('hidden');
            });
            document.querySelectorAll('.fa-chevron-down').forEach(icon => {
                icon.style.transform = 'rotate(0deg)';
            });
        });
    });
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase().trim();
            filterFAQs();
        });
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Set default tab
        const generalExists = Array.from(tabButtons).some(btn => btn.dataset.tab === 'general');
        currentTab = generalExists ? 'general' : 'all';
        setActiveTab(currentTab);
        filterFAQs();
        
        // Open first FAQ by default
        const firstFaq = document.querySelector('.faq-item');
        if (firstFaq) {
            const toggleBtn = firstFaq.querySelector('.faq-toggle');
            if (toggleBtn) {
                setTimeout(() => toggleFaq(toggleBtn), 400);
            }
        }
    });
</script>

<style>
    .faq-item {
        transition: all 0.3s ease;
    }
    .faq-item:hover {
        border-color: #2D6A4F;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }
    .faq-answer {
        animation: slideDown 0.3s ease-out;
    }
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .tab-btn.active {
        box-shadow: 0 4px 15px rgba(45, 106, 79, 0.3);
    }
</style>
@endpush
@endsection