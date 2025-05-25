<section class="relative pt-16 overflow-hidden">
  <!-- Background putih (z-0) -->
  <div class="absolute inset-0 bg-white z-0"></div>
  
  <!-- Konten slider (z-20) dengan background transparan -->
  <div class="container mx-auto relative z-20 py-6 md:py-10 md:px-6 flex items-center min-h-[400px] bg-transparent">
    <!-- Carousel Container -->
    <div class="relative group w-full" x-data="carousel()">
      <!-- Carousel Slides -->
      <div class="overflow-hidden items-center py-0">
        <div class="flex transition-transform duration-500 ease-in-out">
          <div class="flex w-full transition-all duration-500 ease-in-out" x-ref="slideContainer">
            <template x-for="(slide, index) in activeSliders" :key="index">
              <div class="w-full flex-shrink-0">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 items-center">
                  <div class="space-y-6 pl-8 md:pl-8">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl md:text-5xl transition-all duration-700 transform" 
                        :class="{'translate-y-0 opacity-100': activeSlide === index, 'translate-y-4 opacity-0': activeSlide !== index}">
                      <span class="text-gray-900 transition-all duration-700" 
                            :class="{'translate-x-0 opacity-100': activeSlide === index, 'translate-x-4 opacity-0': activeSlide !== index}">
                        <span x-text="slide.title_part_1"></span>
                      </span>
                      <span class="text-[#03A791] transition-all duration-700 delay-100" 
                            :class="{'translate-x-0 opacity-100': activeSlide === index, 'translate-x-4 opacity-0': activeSlide !== index}">
                        <span x-text="slide.title_part_2"></span>
                      </span>
                    </h1>
                    <p class="max-w-[600px] text-gray-700 transition-all duration-700 delay-200" 
                       :class="{'translate-y-0 opacity-100': activeSlide === index, 'translate-y-4 opacity-0': activeSlide !== index}">
                      <span x-text="slide.description"></span>
                    </p>
                    <div class="flex flex-wrap gap-4 transition-all duration-700 delay-300" 
                         :class="{'translate-y-0 opacity-100': activeSlide === index, 'translate-y-4 opacity-0': activeSlide !== index}">
                      <a :href="slide.button_url_1" class="inline-flex items-center justify-center rounded-md bg-[#03A791] px-4 py-2 text-sm font-medium text-white hover:bg-[#028a77] focus:outline-none focus:ring-2 focus:ring-[#03A791] focus:ring-offset-2 transition-all duration-300">
                        <span x-text="slide.button_label_1"></span>
                      </a>
                      <a :href="slide.button_url_2" class="inline-flex items-center justify-center rounded-md border border-[#03A791] bg-transparent px-4 py-2 text-sm font-medium text-[#03A791] hover:bg-[#03A791]/10 focus:outline-none focus:ring-2 focus:ring-[#03A791] focus:ring-offset-2 transition-all duration-300">
                        <span x-text="slide.button_label_2"></span>
                      </a>
                    </div>
                  </div>
                  <div class="flex justify-center items-center h-full">
                    <div class="relative w-full h-[400px] md:h-[500px] rounded-lg overflow-hidden transition-all duration-700 delay-200" 
                         :class="{'scale-100 opacity-100': activeSlide === index, 'scale-95 opacity-0': activeSlide !== index}">
                      <img :src="slide.image_url" :alt="'Slide ' + (index + 1)" class="w-full h-full object-cover object-center">
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>
      </div>
      
      <!-- Navigation Buttons -->
      <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between pointer-events-none">
        <button class="pointer-events-auto -ml-4 md:-ml-8 bg-[#03A791]/20 hover:bg-[#03A791]/40 text-[#03A791] p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 shadow-lg" 
                @click="prevSlide()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button class="pointer-events-auto -mr-4 md:-mr-8 bg-[#03A791]/20 hover:bg-[#03A791]/40 text-[#03A791] p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 shadow-lg" 
                @click="nextSlide()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>
      
      <!-- Indicators -->
      <div class="absolute top-4 left-4 flex space-x-3 z-20">
        <template x-for="(slide, index) in activeSliders" :key="index">
          <button
            class="w-3 h-3 rounded-full transition-all duration-300"
            :class="activeSlide === index
              ? 'bg-[#03A791] scale-125 border border-[#03A791]'
              : 'bg-[#03A791]/20 opacity-50 border border-[#03A791]'"
            @click="goToSlide(index)">
          </button>
        </template>
      </div>
    </div>
  </div>
  
  <!-- SVG Wave Background (z-10, benar-benar full width) -->
  <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none" style="width: 100vw; margin-left: calc(-50vw + 50%);">
    <svg viewBox="0 0 1440 200" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-32 md:h-40">
      <path fill="url(#waveGradient)" fill-opacity="1" d="M0,160L60,149.3C120,139,240,117,360,117.3C480,117,600,139,720,154.7C840,171,960,181,1080,176C1200,171,1320,149,1380,138.7L1440,128L1440,200L1380,200C1320,200,1200,200,1080,200C960,200,840,200,720,200C600,200,480,200,360,200C240,200,120,200,60,200L0,200Z" />
      <defs>
        <linearGradient id="waveGradient" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="#03A791" />
          <stop offset="100%" stop-color="#03A791" />
        </linearGradient>
      </defs>
    </svg>
  </div>
</section>

<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('carousel', () => ({
    activeSlide: 0,
    activeSliders: @json($activeSliders),
    autoplayInterval: null,
    isTransitioning: false,
    
    init() {
      this.startAutoplay();
      this.$watch('activeSlide', value => {
        this.isTransitioning = true;
        this.$refs.slideContainer.style.transform = `translateX(-${value * 100}%)`;
        this.$refs.slideContainer.style.opacity = '1';
        
        // Reset transition state after animation completes
        setTimeout(() => {
          this.isTransitioning = false;
        }, 700);
      });
    },
    
    startAutoplay() {
      this.autoplayInterval = setInterval(() => {
        if (!this.isTransitioning) {
          this.nextSlide();
        }
      }, 5000);
    },
    
    stopAutoplay() {
      clearInterval(this.autoplayInterval);
    },
    
    nextSlide() {
      if (!this.isTransitioning) {
        this.activeSlide = (this.activeSlide + 1) % this.activeSliders.length;
      }
    },
    
    prevSlide() {
      if (!this.isTransitioning) {
        this.activeSlide = (this.activeSlide - 1 + this.activeSliders.length) % this.activeSliders.length;
      }
    },
    
    goToSlide(index) {
      if (!this.isTransitioning) {
        this.activeSlide = index;
      }
    }
  }));
});
</script>
