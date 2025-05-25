<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <!-- Document Header -->
            <div class="mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $document->title }}</h1>
                        <p class="mt-1 text-sm text-gray-500">Nomor: {{ $document->document_number }}</p>
                    </div>
                    <a href="{{ route('documents.index') }}" 
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Document Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Jenis Dokumen</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $document->documentType->type_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $document->documentStatus->status_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Instansi</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $document->mainEntryHeading->heading_name ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tahun</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $document->document_year }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Ditetapkan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $document->issuance_date ? $document->issuance_date->format('d/m/Y') : '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Diundangkan</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $document->announcement_date ? $document->announcement_date->format('d/m/Y') : '-' }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Deskripsi</h3>
                        <p class="text-sm text-gray-900">{{ $document->description }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Tema</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($document->themes as $theme)
                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $theme->theme_name }}
                                </span>
                            @empty
                                <span class="text-sm text-gray-500">Tidak ada tema</span>
                            @endforelse
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Label</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($document->labels as $label)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    {{ $label->label_name }}
                                </span>
                            @empty
                                <span class="text-sm text-gray-500">Tidak ada label</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Versions -->
            @if($document->versions->isNotEmpty())
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Versi Dokumen</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="space-y-4">
                            @foreach($document->versions as $version)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Versi {{ $version->version_number }}</p>
                                        <p class="text-sm text-gray-500">{{ $version->created_at->format('d/m/Y H:i') }}</p>
                                        @if($version->change_notes)
                                            <p class="text-sm text-gray-600 mt-1">{{ $version->change_notes }}</p>
                                        @endif
                                    </div>
                                    @if($document->versions->isNotEmpty() && $document->versions->first()->preview_url)
                                    <a 
                                        href="{{ $document->versions->first()->preview_url }}" 
                                        target="_blank"
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                                    >
                                        Lihat PDF
                                    </a>
                                @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- PDF Viewer -->
            @if($document->preview_url)
                <div class="border rounded-lg overflow-hidden">
                    <iframe src="{{ $document->preview_url }}" 
                        class="w-full h-[600px]" 
                        frameborder="0">
                    </iframe>
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-lg">
                    <p class="text-gray-500">File PDF tidak tersedia</p>
                </div>
            @endif
        </div>
    </div>
</div>
