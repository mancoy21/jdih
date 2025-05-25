<div 
    x-data="headerScroll()" 
    x-init="init()" 
    x-bind:class="hide ? '-translate-y-full' : 'translate-y-0'" 
    class="fixed top-0 left-0 w-full bg-white border-b border-gray-200 z-50 transform transition-transform duration-300"
>
    <header>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo and Site Title -->
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="h-10 w-10 bg-[#03A791] rounded-full flex items-center justify-center overflow-hidden mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold text-gray-900">JDIH</h1>
                                <p class="text-xs text-gray-500 -mt-1">Kementerian Kesehatan RI</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="hidden md:flex items-center text-sm text-gray-600 hover:text-[#03A791]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Kontak
                    </a>
                    <a href="#" class="hidden md:flex items-center text-sm text-gray-600 hover:text-[#03A791]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        FAQ
                    </a>
                    <a href="#" class="flex items-center text-sm font-medium text-white bg-[#03A791] hover:bg-[#028a77] px-3 py-1 rounded-md transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </header>
</div>

@push('scripts')
<script>
function headerScroll() {
    return {
        lastScroll: 0,
        hide: false,
        init() {
            window.addEventListener('scroll', () => {
                const current = window.scrollY;
                this.hide = current > this.lastScroll && current > 50;
                this.lastScroll = current;

                // Kirim sinyal ke navbar
                window.navShouldStick = this.hide;
                window.dispatchEvent(new CustomEvent('nav-scroll-change'));
            });
        }
    }
}
</script>
@endpush
