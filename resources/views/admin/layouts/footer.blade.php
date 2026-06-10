<footer class="bg-white border-t border-gray-200 py-4 px-6 mt-auto">
    <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
        <div>
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
        <div class="flex space-x-4 mt-2 md:mt-0">
            <a href="#" class="hover:text-gray-900 transition">Terms</a>
            <a href="#" class="hover:text-gray-900 transition">Privacy</a>
            <a href="#" class="hover:text-gray-900 transition">Support</a>
        </div>
    </div>
</footer>