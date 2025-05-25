<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-8">
                        <a href="{{ route('documents.index') }}" class="text-[#03A791] hover:text-[#028a77] flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Kembali ke Daftar Peraturan
                        </a>
                    </div>

                    <div class="mb-8">
                        <div class="text-sm font-medium text-[#03A791] mb-2">
                            {{ $document->announcement_date->format('d M Y') }}
                        </div>
                        <h1 class="text-3xl font-bold text-[#0d3b6f] mb-4">
                            {{ $document->document_number }}
                        </h1>
                        <p class="text-gray-600 text-lg mb-6">
                            {{ $document->title }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-[#0d3b6f] mb-4">Informasi Dokumen</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Jenis Dokumen</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->documentType->type_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->documentStatus->status_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Lembaga</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->mainEntryHeading->heading_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tanggal Terbit</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->issuance_date->format('d M Y') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-[#0d3b6f] mb-4">Klasifikasi</h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-2">Tema</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($document->themes as $theme)
                                            <span class="px-3 py-1 bg-[#03A791] text-white text-sm rounded-full">
                                                {{ $theme->theme_name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-2">Label</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($document->labels as $label)
                                            <span class="px-3 py-1 bg-[#0d3b6f] text-white text-sm rounded-full">
                                                {{ $label->label_name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h2 class="text-2xl font-bold text-[#0d3b6f] mb-4">Deskripsi</h2>
                        <p class="text-gray-600">
                            {{ $document->description }}
                        </p>
                    </div>

                    @if($document->preview_url && $embedUrl)
                    <!-- Preview PDF dengan <embed> -->
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Preview Dokumen</h3>
                        <embed 
                            src="{{ $embedUrl }}" 
                            type="application/pdf" 
                            class="w-full h-96 border border-gray-300 rounded-md"
                        >
                    </div>
            
                    <!-- Link Download -->
                    <a 
                        href="{{ $document->preview_url }}" 
                        target="_blank"
                        class="inline-flex items-center justify-center rounded-md bg-[#03A791] px-6 py-3 text-base font-medium text-white hover:bg-[#028a77] focus:outline-none focus:ring-2 focus:ring-[#03A791] focus:ring-offset-2 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download Dokumen
                    </a>
                @else
                    <p class="text-gray-500">Dokumen tidak tersedia untuk ditampilkan.</p>
                @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout> 