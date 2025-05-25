<div>
    <div class="min-h-screen bg-gradient-to-b from-[#f0f7ff] to-white py-8">
        <div class="container max-w-7xl mx-auto relative z-10 px-4 py-4 md:py-8">
            <!-- Header Section -->
            <div class="mb-12 text-center relative pt-16">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-24 h-24 bg-[#03A791]/5 rounded-full blur-3xl"></div>
                </div>
                <h1 class="text-4xl font-bold text-[#0d3b6f] mb-4 relative">Berita Kesehatan</h1>
                <p class="text-lg text-[#03A791] max-w-2xl mx-auto relative">Informasi terkini seputar kesehatan dan kebijakan Kemenkes untuk masyarakat Indonesia</p>
            </div>

            <!-- Search and Filter Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search Box -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" 
                                   wire:model.live="search"
                                   placeholder="Cari berita kesehatan..." 
                                   class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:border-[#03A791] focus:ring-2 focus:ring-[#E6F7F5] transition-all duration-300 bg-gray-50">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="relative group">
                        <!-- Toggle Button -->
                        <button class="flex items-center justify-between w-full md:w-64 px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 hover:bg-gray-100 transition-colors duration-300">
                            <span class="text-gray-600">{{ $category ? ucfirst($category) : 'Semua Kategori' }}</span>
                            <svg class="w-5 h-5 text-gray-400 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    
                        <!-- Dropdown -->
                        <div class="absolute z-10 w-full md:w-64 mt-2 bg-white rounded-xl shadow-lg border border-gray-200 opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-all duration-300">
                            <div class="p-2">
                                <a href="#" wire:click.prevent="$set('category', '')"
                                   class="flex items-center px-4 py-2 text-gray-700 hover:bg-[#E6F7F5] hover:text-[#03A791] rounded-lg transition-colors duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Semua Kategori
                                </a>
                                @foreach($categories as $cat)
                                    <a href="#"
                                       wire:click.prevent="$set('category', '{{ $cat->slug }}')"
                                       class="flex items-center px-4 py-2 text-gray-700 hover:bg-[#E6F7F5] hover:text-[#03A791] rounded-lg transition-colors duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    

                    <!-- View Toggle -->
                    <div class="flex space-x-2 bg-gray-50 p-1 rounded-xl">
                        <button wire:click="$set('viewMode', 'grid')" class="p-2 rounded-lg hover:bg-white hover:shadow-sm transition-all duration-300 {{ $viewMode === 'grid' ? 'bg-white shadow-sm' : '' }}">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        </button>
                        <button wire:click="$set('viewMode', 'list')" class="p-2 rounded-lg hover:bg-white hover:shadow-sm transition-all duration-300 {{ $viewMode === 'list' ? 'bg-white shadow-sm' : '' }}">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
  
            <!-- News Grid/List -->
            <div class="grid {{ $viewMode === 'grid' ? 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3' : 'grid-cols-1' }} gap-6">
                @forelse($news as $item)
                <div class="news-item bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 {{ $viewMode === 'list' ? 'flex items-center' : '' }}">
                    <div class="relative {{ $viewMode === 'list' ? 'w-1/3' : '' }}">
                        <img src="{{ Storage::url($item->thumbnail_path)  ?? 'https://via.placeholder.com/400x250?text=News+Thumbnail' }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                            <div class="flex items-center text-sm text-white mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $item->published_at->format('d M Y') }}
                            </div>
                            <h3 class="text-lg font-semibold text-white line-clamp-2">{{ $item->title }}</h3>
                        </div>
                    </div>
                    <div class="p-6 {{ $viewMode === 'list' ? 'flex-1' : '' }}">
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($item->categories as $cat)
                            <span class="px-3 py-1 text-sm bg-[#E6F7F5] text-[#03A791] rounded-full">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                        <a href="{{ route('news.show', $item->slug) }}" class="inline-flex items-center text-[#03A791] hover:text-[#0d3b6f] transition-colors duration-300 group">
                            Baca selengkapnya
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada berita ditemukan</h3>
                    <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter kategori</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>