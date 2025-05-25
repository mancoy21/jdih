<div class="min-h-screen bg-gray-100">
    <!-- Search Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="relative">
                <div class="flex items-center">
                    <div class="flex-1">
                        <div class="relative">
                            <input
                                type="text"
                                wire:model.live.debounce.300ms="query"
                                wire:keydown.enter="search"
                                class="w-full rounded-lg border-gray-300 pl-10 pr-4 py-2 focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50"
                                placeholder="Cari dokumen hukum..."
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <!-- Search Suggestions -->
                        @if($showSuggestions && !empty($suggestions))
                            <div class="absolute z-10 mt-1 w-full bg-white rounded-md shadow-lg">
                                <ul class="max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                                    @if(!empty($suggestions['popular']))
                                        <li class="px-4 py-2 text-sm text-gray-500">Pencarian Populer</li>
                                        @foreach($suggestions['popular'] as $popular)
                                            <li wire:click="selectSuggestion('{{ $popular->query }}')" class="cursor-pointer px-4 py-2 hover:bg-gray-100">
                                                <div class="flex items-center">
                                                    <svg class="h-5 w-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span>{{ $popular->query }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif

                                    @if(!empty($suggestions['documents']))
                                        <li class="px-4 py-2 text-sm text-gray-500">Dokumen</li>
                                        @foreach($suggestions['documents'] as $doc)
                                            <li wire:click="selectSuggestion('{{ $doc->document_number }}')" class="cursor-pointer px-4 py-2 hover:bg-gray-100">
                                                <div class="flex flex-col">
                                                    <span class="font-medium">{{ $doc->title }}</span>
                                                    <span class="text-sm text-gray-500">{{ $doc->document_number }} ({{ $doc->document_year }})</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>

                    <button
                        wire:click="search"
                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#03A791] hover:bg-[#028a77] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#03A791]"
                    >
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Filters Sidebar -->
                <div class="w-full md:w-64 flex-shrink-0">
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Filter</h3>
                            <button
                                wire:click="clearFilters"
                                class="text-sm text-[#03A791] hover:text-[#028a77]"
                            >
                                Reset
                            </button>
                        </div>

                        <div class="space-y-4">
                            <!-- Document Type Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Dokumen</label>
                                <select wire:model.live="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50">
                                    <option value="">Semua Jenis</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->type_id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select wire:model.live="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50">
                                    <option value="">Semua Status</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->status_id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Issuing Authority Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Instansi Penerbit</label>
                                <select wire:model.live="heading" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50">
                                    <option value="">Semua Instansi</option>
                                    @foreach($headings as $heading)
                                        <option value="{{ $heading->heading_id }}">{{ $heading->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Theme Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tema</label>
                                <select wire:model.live="theme" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50">
                                    <option value="">Semua Tema</option>
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->theme_id }}">{{ $theme->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Year Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                                <select wire:model.live="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50">
                                    <option value="">Semua Tahun</option>
                                    @for($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Date Range Filters -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                <input
                                    type="date"
                                    wire:model.live="dateFrom"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                                <input
                                    type="date"
                                    wire:model.live="dateTo"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50"
                                >
                            </div>

                            <!-- Sort Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Urutan</label>
                                <select wire:model.live="sort" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#03A791] focus:ring focus:ring-[#03A791] focus:ring-opacity-50">
                                    <option value="newest">Terbaru</option>
                                    <option value="oldest">Terlama</option>
                                    <option value="a-z">A-Z</option>
                                    <option value="z-a">Z-A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Results -->
                <div class="flex-1">
                    @if($query)
                        <div class="bg-white rounded-lg shadow">
                            <div class="px-4 py-5 sm:p-6">
                                <h2 class="text-lg font-medium text-gray-900 mb-4">
                                    Hasil Pencarian untuk "{{ $query }}"
                                </h2>

                                @if($documents->isEmpty())
                                    <div class="text-center py-12">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada hasil</h3>
                                        <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci atau filter pencarian Anda.</p>
                                    </div>
                                @else
                                    <div class="space-y-4">
                                        @foreach($documents as $document)
                                            <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                                <div class="flex items-start justify-between">
                                                    <div class="flex-1">
                                                        <h3 class="text-lg font-medium text-[#03A791]">
                                                            <a href="{{ route('documents.show', $document->document_id) }}" class="hover:underline">
                                                                {{ $document->title }}
                                                            </a>
                                                        </h3>
                                                        <div class="mt-1 text-sm text-gray-500">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#03A791]/10 text-[#03A791]">
                                                                {{ $document->documentType->name }}
                                                            </span>
                                                            <span class="ml-2">{{ $document->document_number }}</span>
                                                            <span class="ml-2">({{ $document->document_year }})</span>
                                                        </div>
                                                        <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                                            {{ $document->description }}
                                                        </p>
                                                        <div class="mt-2 flex flex-wrap gap-2">
                                                            @foreach($document->themes as $theme)
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                    {{ $theme->name }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="ml-4 flex-shrink-0">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $document->documentStatus->name === 'Berlaku' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ $document->documentStatus->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-6">
                                        {{ $documents->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Mulai pencarian</h3>
                            <p class="mt-1 text-sm text-gray-500">Masukkan kata kunci untuk mencari dokumen hukum.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> 