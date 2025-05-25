
<div>
    <div class="min-h-screen bg-gradient-to-b from-[#f0f7ff] to-white py-8">
        <div class="container max-w-7xl mx-auto relative z-10 px-4 py-4 md:py-8">
            <!-- Breadcrumb -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('news.index') }}" class="text-gray-600 hover:text-[#03A791] transition-colors duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Berita
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-1 text-gray-500 md:ml-2">{{ $news->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Article Content -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Featured Image -->
                <div class="relative w-full h-[400px]">
                    <img src="{{ Storage::url($news->thumbnail_path) ?? 'https://via.placeholder.com/1200x400?text=News+Thumbnail' }}" 
                         alt="{{ $news->title }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <div class="flex items-center text-white mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $news->published_at->format('d M Y') }}
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $news->title }}</h1>
                        <div class="flex flex-wrap gap-2">
                            @foreach($news->categories as $category)
                            <span class="px-3 py-1 text-sm bg-white/20 text-white rounded-full backdrop-blur-sm">
                                {{ $category->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Article Body -->
                <div class="p-8">
                    <div class="prose prose-lg max-w-none">
                        {!! $news->content !!}
                    </div>

                    <!-- Tags -->
                    @if($news->tags->isNotEmpty())
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($news->tags as $tag)
                            <span class="px-3 py-1 text-sm bg-[#E6F7F5] text-[#03A791] rounded-full">
                                {{ $tag->name }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Author Info -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-[#03A791] flex items-center justify-center text-white font-semibold">
                                    {{ substr($news->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-semibold text-gray-900">{{ $news->user->name }}</h4>
                                <p class="text-gray-600">Penulis</p>
                            </div>
                        </div>
                    </div>

                    <!-- Media Gallery -->
                    @if($news->mediaGalleries->isNotEmpty())
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-2xl font-bold text-[#0d3b6f] mb-6">Galeri Kegiatan</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($news->mediaGalleries as $media)
                            <div class="relative group cursor-pointer" wire:click="showImage('{{ $media->file_path }}')">
                                <img src="{{ Storage::url($media->file_path) }}" 
                                     alt="{{ $media->caption }}" 
                                     class="w-full h-40 object-cover rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m4-3H6"/>
                                    </svg>
                                </div>
                                @if($media->caption)
                                <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/70 to-transparent rounded-b-lg">
                                    <p class="text-white text-sm truncate">{{ $media->caption }}</p>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Related News -->
            @if($news->categories->isNotEmpty())
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-[#0d3b6f] mb-6">Berita Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($news->categories->first()->news()->where('id', '!=', $news->id)->take(3)->get() as $relatedNews)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative h-48">
                            <img src="{{ Storage::url($relatedNews->thumbnail_path) ?? 'https://via.placeholder.com/400x250?text=News+Thumbnail' }}" 
                                 alt="{{ $relatedNews->title }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex items-center text-sm text-white mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $relatedNews->published_at->format('d M Y') }}
                                </div>
                                <h3 class="text-lg font-semibold text-white line-clamp-2">{{ $relatedNews->title }}</h3>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($relatedNews->categories as $cat)
                                <span class="px-3 py-1 text-sm bg-[#E6F7F5] text-[#03A791] rounded-full">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit(strip_tags($relatedNews->content), 100) }}</p>
                            <a href="{{ route('news.show', $relatedNews->slug) }}" class="inline-flex items-center text-[#03A791] hover:text-[#0d3b6f] transition-colors duration-300 group">
                                Baca selengkapnya
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Image Modal -->
            @if($selectedImage)
            <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                        <div class="relative">
                            <button wire:click="closeImage" class="absolute top-4 right-4 text-white bg-black/50 rounded-full p-2 hover:bg-black/70 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            <img src="{{ Storage::url($selectedImage) }}" 
                                 alt="Gallery Image" 
                                 class="w-full h-auto max-h-[80vh] object-contain">
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div> 
