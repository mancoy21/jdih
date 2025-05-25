<div 
  x-data="{
    isMobileMenuOpen: false,
    activeDropdown: null,
    isScrolled: false,
    navShouldStick: false,
    toggleDropdown(dropdown) {
      this.activeDropdown = this.activeDropdown === dropdown ? null : dropdown;
    },
    init() {
      window.addEventListener('scroll', () => {
        this.isScrolled = window.scrollY > 20;
      });
      window.addEventListener('nav-scroll-change', () => {
        this.navShouldStick = window.navShouldStick;
      });
    }
  }"
  x-init="init"
>
  <!-- Main Navigation -->
  <nav class="fixed w-full z-40 transition-all duration-300"
       :class="[
         navShouldStick ? 'top-0' : 'top-[3.5rem]',
         isScrolled ? 'bg-[#03A791]/90 backdrop-blur-sm shadow-lg' : 'bg-[#03A791]'
       ]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Left side - Menu & Logo -->
        <div class="flex items-center">
          <!-- Mobile menu button -->
          <button @click="isMobileMenuOpen = !isMobileMenuOpen"
                  class="inline-flex md:hidden items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-[#0a2e59] focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>

          <!-- Desktop Menu -->
          <div class="hidden md:block">
            <div class="ml-8 flex items-center space-x-6">
              <template x-for="(item, index) in [
                { name: 'Beranda', link: '/' },
                { name: 'Peraturan', submenu: [
                  { name: 'Peraturan Menteri', link: '{{ route('documents.index') }}' },
                  { name: 'Artikel', link: '{{ route('documents.index') }}' },
                  { name: 'Monografi', link: '{{ route('documents.index') }}' }
                ]},
                { name: 'Berita', submenu: [
                  { name: 'Berita Hukum', link: '{{ route('news.index') }}' },
                  { name: 'Opini Hukum', link: '{{ route('news.index') }}' },
                  { name: 'Artikel Hukum', link: '{{ route('news.index') }}' }
                ]},
                { name: 'Tentang Kami', submenu: [
                  { name: 'Visi Misi', link: '/tentang-kami' },
                  { name: 'Struktur Organisasi', link: '/tentang-kami' },
                  { name: 'Kontak', link: '/tentang-kami' }
                ]},
                 { name: 'Statistik', link: '/' },
                 { name: 'Layanan', link: '/' }
              ]" :key="index">
                <div class="relative group" @mouseleave="activeDropdown = null">
                  <template x-if="!item.submenu">
                    <a :href="item.link" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#0a2e59] flex items-center space-x-1">
                      <span x-text="item.name"></span>
                    </a>
                  </template>
                  <template x-if="item.submenu">
                    <button @mouseenter="activeDropdown = item.name.toLowerCase()" class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-[#0a2e59] flex items-center space-x-1">
                      <span x-text="item.name"></span>
                      <svg class="w-4 h-4 transition-transform duration-200"
                           :class="{'rotate-180': activeDropdown === item.name.toLowerCase()}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </button>
                  </template>
                  <div x-show="activeDropdown === item.name.toLowerCase()"
                       @mouseenter="activeDropdown = item.name.toLowerCase()"
                       x-transition:enter="transition ease-out duration-200"
                       x-transition:enter-start="opacity-0 translate-y-1"
                       x-transition:enter-end="opacity-100 translate-y-0"
                       x-transition:leave="transition ease-in duration-150"
                       x-transition:leave-start="opacity-100 translate-y-0"
                       x-transition:leave-end="opacity-0 translate-y-1"
                       class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white/95 backdrop-blur-sm ring-1 ring-black ring-opacity-5">
                    <div class="py-1">
                      <template x-for="(sub, idx) in item.submenu" :key="idx">
                        <a :href="sub.link" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#03A791]" x-text="sub.name"></a>
                      </template>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>
        </div>

        <!-- Right side - Search -->
        <div class="flex-1 flex justify-end max-w-lg">
          <div class="w-full max-w-lg lg:max-w-xs ml-4 md:ml-6">
            <livewire:components.navbar-search />
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Mobile menu -->
  <div class="md:hidden bg-[#0d3b6f]/95 backdrop-blur-sm overflow-hidden transition-all duration-300 ease-in-out"
       :class="isMobileMenuOpen ? 'max-h-[800px]' : 'max-h-0'">
    <div class="px-4 pt-4 pb-3 space-y-2">
      <template x-for="(item, index) in [
        { name: 'Beranda', link: '/' },
        { name: 'Peraturan', submenu: [
          { name: 'Peraturan Daerah', link: '{{ route('documents.index') }}' },
          { name: 'Peraturan Gubernur', link: '/peraturan/pergub' },
          { name: 'Peraturan Walikota', link: '/peraturan/perwali' }
        ]},
        { name: 'Putusan', submenu: [
          { name: 'Putusan MA', link: '/putusan/ma' },
          { name: 'Putusan PTUN', link: '/putusan/ptun' },
          { name: 'Putusan PN', link: '/putusan/pn' }
        ]},
        { name: 'Monografi', submenu: [
          { name: 'Monografi Hukum', link: '/monografi' },
          { name: 'Jurnal Hukum', link: '/jurnal' }
        ]},
        { name: 'Artikel', submenu: [
          { name: 'Artikel Hukum', link: '/artikel' },
          { name: 'Opini Hukum', link: '/opini' },
          { name: 'Berita Hukum', link: '/berita' }
        ]}
      ]" :key="index">
        <div x-data="{ open: false }">
          <button @click="open = !open"
                  class="w-full flex justify-between items-center px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#0a2e59]">
            <span x-text="item.name"></span>
            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div x-show="open"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 -translate-y-2"
               x-transition:enter-end="opacity-100 translate-y-0"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="opacity-100 translate-y-0"
               x-transition:leave-end="opacity-0 -translate-y-2"
               class="pl-4 space-y-1 mt-2">
            <template x-for="(sub, idx) in item.submenu" :key="idx">
              <a :href="sub.link" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-[#0a2e59]" x-text="sub.name"></a>
            </template>
          </div>
        </div>
      </template>
    </div>
  </div>
</div>
