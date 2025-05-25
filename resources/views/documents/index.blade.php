<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold text-[#03A791] mb-8">Daftar Peraturan</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($documents as $document)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                                <div class="p-6">
                                    <div class="text-sm font-medium text-[#03A791] mb-3">
                                        {{ $document->announcement_date->format('d M Y') }}
                                    </div>
                                    <h3 class="text-lg font-bold text-[#0d3b6f] mb-3">
                                        {{ $document->document_number }}
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-4">
                                        {{ $document->title }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500">
                                            {{ $document->documentType->type_name }}
                                        </span>
                                        <a href="{{ route('documents.show', $document) }}" 
                                           class="text-[#03A791] hover:text-[#028a77] text-sm font-medium">
                                            Baca Selengkapnya →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 