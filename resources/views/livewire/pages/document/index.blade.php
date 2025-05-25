<div class="min-h-screen bg-gray-50">
    <!-- Hero Section - Lebih Sederhana dan Sejuk -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100 pt-16">
        <div class="container mx-auto px-4 py-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl font-semibold text-gray-800 mb-3">Pencarian Dokumen Hukum</h1>
                <p class="text-lg text-gray-600">Temukan berbagai dokumen hukum yang tersedia dalam sistem JDIH</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8 border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                <!-- Search Input -->
                <div class="md:col-span-5">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Dokumen</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input 
                            wire:model.live.debounce.300ms="search" 
                            type="text" 
                            id="search" 
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Masukkan kata kunci..."
                            value="{{ $search }}"
                        >
                    </div>
                </div>

                <!-- Document Type Filter -->
                <div class="md:col-span-3">
                    <label for="document_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Dokumen</label>
                    <select 
                        wire:model.live="type_id" 
                        id="document_type" 
                        class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2"
                    >
                        <option value="">Semua Jenis</option>
                        @foreach($documentTypes as $type)
                            <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Theme Filter -->
                <div class="md:col-span-3">
                    <label for="theme" class="block text-sm font-medium text-gray-700 mb-1">Tema</label>
                    <select 
                        wire:model.live="theme_id" 
                        id="theme" 
                        class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2"
                    >
                        <option value="">Semua Tema</option>
                        @foreach($themes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->theme_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Year Filter -->
                <div class="md:col-span-2">
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                    <select 
                        wire:model.live="document_year" 
                        id="year" 
                        class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2"
                    >
                        <option value="">Semua Tahun</option>
                        @foreach(range(date('Y'), date('Y')-5) as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Options -->
                <div class="md:col-span-2">
                    <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Urutkan</label>
                    <select 
                        wire:model.live="sort" 
                        id="sort" 
                        class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2"
                    >
                        <option value="desc">Terbaru</option>
                        <option value="asc">Terlama</option>
                    </select>
                </div>
            </div>

            <!-- Filter Tags -->
            @if($search || $type_id || $theme_id || $document_year)
                <div class="mt-4 flex flex-wrap gap-2">
                    @if($search)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            Pencarian: {{ $search }}
                            <button 
                                wire:click="$set('search', '')" 
                                type="button" 
                                class="ml-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full text-blue-400 hover:bg-blue-100 hover:text-blue-500 focus:outline-none"
                            >
                                <span class="sr-only">Hapus filter</span>
                                <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    @endif

                    @if($type_id)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $documentTypes->firstWhere('type_id', $type_id)?->type_name }}
                            <button 
                                wire:click="$set('type_id', '')" 
                                type="button" 
                                class="ml-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full text-blue-400 hover:bg-blue-100 hover:text-blue-500 focus:outline-none"
                            >
                                <span class="sr-only">Hapus filter</span>
                                <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    @endif

                    @if ($theme_id)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        {{ $themes->firstWhere('theme_id', $theme_id)?->theme_name }}
                
                        <button 
                            wire:click="$set('theme_id', null)" 
                            type="button" 
                            class="ml-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full text-blue-400 hover:bg-blue-100 hover:text-blue-500 focus:outline-none"
                        >
                            <span class="sr-only">Hapus filter</span>
                            <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                @endif

                    @if($document_year)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            Tahun: {{ $document_year }}
                            <button 
                                wire:click="$set('document_year', '')" 
                                type="button" 
                                class="ml-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full text-blue-400 hover:bg-blue-100 hover:text-blue-500 focus:outline-none"
                            >
                                <span class="sr-only">Hapus filter</span>
                                <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    @endif
                </div>
            @endif
        </div>

        <!-- Results Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <!-- Results Header -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-lg font-medium text-gray-800">
                        @if($search)
                            Hasil Pencarian untuk "{{ $search }}"
                        @else
                            Semua Dokumen
                        @endif
                    </h2>
                    <p class="text-sm text-gray-600 mt-1 sm:mt-0">
                        Menampilkan <span class="font-medium">{{ $documents->firstItem() }}</span> sampai <span class="font-medium">{{ $documents->lastItem() }}</span> dari <span class="font-medium">{{ $documents->total() }}</span> hasil
                    </p>
                </div>
            </div>

            <!-- Document List -->
            <div class="divide-y divide-gray-100">
                @forelse($documents as $document)
                    <div class="p-6 hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100 mr-2">
                                        {{ $document->documentType->type_name }}
                                    </span>
                                    <span class="text-sm text-gray-500">{{ $document->announcement_date?->format('d M Y') ?? '-' }}</span>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-1">
                                    <a href="{{ route('documents.show', $document) }}" class="hover:text-blue-600 transition duration-150 ease-in-out">
                                        {{ $document->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-3">{{ Str::limit($document->description, 150) }}</p>
                                <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Nomor: {{ $document->document_number }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 mr-1 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Tanggal: {{ $document->issuance_date?->format('d M Y') ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6 flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('documents.show', $document) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                    </svg>
                                    Lihat Dokumen
                                </a>
                                @if($document->preview_url)
                                    <a href="{{ $document->preview_url }}" target="_blank" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        Unduh PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        @if($search)
                            Tidak ada dokumen yang ditemukan untuk pencarian "{{ $search }}"
                        @else
                            Tidak ada dokumen yang tersedia
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        {{ $documents->links() }}
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-4">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Menampilkan
                                    <span class="font-medium">{{ $documents->firstItem() }}</span>
                                    sampai
                                    <span class="font-medium">{{ $documents->lastItem() }}</span>
                                    dari
                                    <span class="font-medium">{{ $totalDocuments }}</span>
                                    hasil
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <label for="perPage" class="text-sm text-gray-600">Per page</label>
                                <select 
                                    wire:model.live="perPage" 
                                    id="perPage" 
                                    class="rounded-md border-gray-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1 bg-white rounded-lg border border-gray-200 px-2 py-1">
                            {{-- Previous --}}
                            <button wire:click="previousPage('page')" @if($documents->onFirstPage()) disabled @endif class="px-2 py-1 rounded-md text-gray-500 hover:bg-gray-100 transition cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            {{-- Page Numbers with chunked/ellipsis --}}
                            @php
                                $current = $documents->currentPage();
                                $last = $documents->lastPage();
                                $start = max(1, $current - 2);
                                $end = min($last, $current + 2);
                                if ($current <= 3) {
                                    $start = 1;
                                    $end = min(5, $last);
                                }
                                if ($current >= $last - 2) {
                                    $start = max(1, $last - 4);
                                    $end = $last;
                                }
                            @endphp
                            @if($start > 1)
                                <button wire:click="gotoPage(1, 'page')" class="px-2 py-1 rounded-md border border-transparent text-gray-700 hover:bg-gray-100 transition cursor-pointer">1</button>
                                @if($start > 2)
                                    <span class="px-2 py-1 text-gray-400">...</span>
                                @endif
                            @endif
                            @for($i = $start; $i <= $end; $i++)
                                @if($i == $current)
                                    <span class="px-2 py-1 rounded-md bg-blue-600 text-white border border-blue-600 cursor-pointer">{{ $i }}</span>
                                @else
                                    <button wire:click="gotoPage({{ $i }}, 'page')" class="px-2 py-1 rounded-md border border-transparent text-gray-700 hover:bg-gray-100 transition cursor-pointer">{{ $i }}</button>
                                @endif
                            @endfor
                            @if($end < $last)
                                @if($end < $last - 1)
                                    <span class="px-2 py-1 text-gray-400">...</span>
                                @endif
                                <button wire:click="gotoPage({{ $last }}, 'page')" class="px-2 py-1 rounded-md border border-transparent text-gray-700 hover:bg-gray-100 transition cursor-pointer">{{ $last }}</button>
                            @endif
                            {{-- Next --}}
                            <button wire:click="nextPage('page')" @if(!$documents->hasMorePages()) disabled @endif class="px-2 py-1 rounded-md text-gray-500 hover:bg-gray-100 transition cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>