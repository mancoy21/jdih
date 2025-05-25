<section class="py-12 md:py-16 relative overflow-hidden bg-[#f0f7ff]">
    <!-- Dot pattern background -->
    <div class="absolute inset-0 dot-pattern opacity-50"></div>
    
    <div class="container mx-auto px-4 md:px-6 relative z-10">
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold mb-2">
          <span class="text-[#0d3b6f]">Tematik </span>
          <span class="text-[#03A791]">Regulasi</span>
        </h2>
        <p class="text-gray-600">Kompilasi regulasi berdasarkan topik populer</p>
      </div>
     
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        <!-- AEOI -->
        @foreach ($tema as $item)
        <a href="#" class="bg-[#FFF5E6] rounded-lg p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
          <i class="ri-arrow-left-right-line text-2xl text-[#1a5ba8]"></i>
          <span class="font-medium text-black">{{ $item->theme_name }}</span>
        </a>
        @endforeach
        <!-- BMN -->
       
      </div>
 
      
    </div>
  </section>
