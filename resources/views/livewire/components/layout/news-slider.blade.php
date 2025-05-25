<div>
    <!-- News Slider Component -->
    <div class="relative overflow-hidden bg-gradient-to-b from-[#f0f7ff] to-white py-16" 
         x-data="newsSlider"
         x-init="init">
        
        <!-- Container -->
        <div class="container max-w-7xl mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-12 relative">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-32 h-32 bg-[#03A791]/5 rounded-full blur-3xl"></div>
                </div>
                <h2 class="text-3xl font-bold mb-2 relative">
                    <span class="text-[#0d3b6f]">Informasi </span>
                    <span class="text-[#03A791]">Terkini</span>
                </h2>
                <p class="text-gray-600 relative">Telusuri Berbagai Informasi Terbaru Tim JDIH Kemenkes </p>
            </div>
    
            <!-- Slider Container -->
            <div class="relative">
                <!-- Cards Container -->
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-700 ease-out" 
                         x-ref="slider"
                         :style="`transform: translateX(-${currentSlide * (100/3)}%)`">
                        
                        <!-- Card Items -->   
                        @foreach($news as $item)
                            <div class="w-full md:w-1/3 flex-shrink-0 px-4" 
                                 x-show="true"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-90"
                                 x-transition:enter-end="opacity-100 transform scale-100">
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl h-full flex flex-col">
                                    <!-- Card Image -->
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ $item['image'] }}" 
                                             alt="{{ $item['title'] }}"
                                             class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-110">
                                        <!-- Category Badge -->
                                        <span class="absolute top-4 left-4 px-3 py-1 bg-[#03A791] text-white text-sm font-medium rounded-full">
                                            {{ $item['category'] }}
                                        </span>
                                    </div>
                                    
                                    <!-- Card Content -->
                                    <div class="p-6 flex-grow flex flex-col">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-[#03A791] transition-colors duration-300">
                                            {{ $item['title'] }}
                                        </h3>
                                        <p class="text-gray-600 mb-4 text-sm line-clamp-3 flex-grow">
                                            {{ $item['excerpt'] }}
                                        </p>
                                        
                                        <!-- Card Footer -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>{{ $item['date'] }}</span>
                                            </div>
                                            <a href="{{ route('news.show', $item['slug']) }}" class="text-[#03A791] hover:text-[#028a77] font-medium text-sm transition-colors duration-300 group">
                                                Baca Selengkapnya
                                                <svg class="w-4 h-4 inline-block ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
    
                <!-- Navigation Buttons -->
                <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between pointer-events-none">
                    <button @click="prev()" 
                            class="pointer-events-auto transform -translate-x-4 md:translate-x-4 bg-white text-gray-800 hover:text-[#03A791] p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed group"
                            :class="{ 'opacity-50 cursor-not-allowed': currentSlide === 0 }"
                            :disabled="currentSlide === 0">
                        <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
    
                    <button @click="next()" 
                            class="pointer-events-auto transform translate-x-4 md:-translate-x-4 bg-white text-gray-800 hover:text-[#03A791] p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed group"
                            :class="{ 'opacity-50 cursor-not-allowed': currentSlide >= maxSlide }"
                            :disabled="currentSlide >= maxSlide">
                        <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('newsSlider', () => ({
            currentSlide: 0,
            totalVisible: 3,
            items: @json($news),
            autoplayInterval: null,
            isTransitioning: false,
    
            init() {
                // Responsive handling
                this.handleResize();
                window.addEventListener('resize', () => this.handleResize());
                
                // Start autoplay
                this.startAutoplay();
                
                // Pause autoplay on hover
                this.$el.addEventListener('mouseenter', () => this.stopAutoplay());
                this.$el.addEventListener('mouseleave', () => this.startAutoplay());
            },
    
            handleResize() {
                if (window.innerWidth < 768) {
                    this.totalVisible = 1;
                } else {
                    this.totalVisible = 3;
                }
                // Ensure current slide is valid after resize
                this.currentSlide = Math.min(this.currentSlide, this.maxSlide);
            },
    
            get maxSlide() {
                return this.items.length - this.totalVisible;
            },
    
            next() {
                if (this.isTransitioning) return;
                this.isTransitioning = true;
    
                if (this.currentSlide < this.maxSlide) {
                    this.currentSlide++;
                } else {
                    // Smooth transition to first slide
                    this.currentSlide = 0;
                }
    
                // Reset transition flag after animation
                setTimeout(() => {
                    this.isTransitioning = false;
                }, 700); // Match this with the CSS transition duration
            },
    
            prev() {
                if (this.isTransitioning) return;
                this.isTransitioning = true;
    
                if (this.currentSlide > 0) {
                    this.currentSlide--;
                } else {
                    // Smooth transition to last slide
                    this.currentSlide = this.maxSlide;
                }
    
                // Reset transition flag after animation
                setTimeout(() => {
                    this.isTransitioning = false;
                }, 700); // Match this with the CSS transition duration
            },
    
            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    this.next();
                }, 3000); // Change slide every 3 seconds
            },
    
            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = null;
                }
            }
        }));
    });
    </script>
    
    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style> 
    </div>