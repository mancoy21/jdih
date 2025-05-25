<div class="relative" x-data x-on:click.away="$wire.showDropdown = false">
    <form wire:submit.prevent="performSearch" class="w-full max-w-lg lg:max-w-xs">
        <div class="relative text-gray-400 focus-within:text-gray-600">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input 
                wire:model.live.debounce.300ms="search"
                type="text"
                class="block w-full bg-white py-2 pl-10 pr-10 border border-transparent rounded-md leading-5 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#03A791] focus:border-[#03A791] sm:text-sm transition duration-150"
                placeholder="Cari dokumen hukum..."
                @click="$wire.showDropdown = true"
            >
            @if ($search)
                <button type="button" wire:click="clearSearch" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif
        </div>

        <!-- Dropdown Preview -->
        @if ($showDropdown && count($results) > 0)
            <div class="absolute z-50 mt-1 w-full bg-white shadow-lg rounded-md border border-gray-200 py-1 max-h-60 overflow-auto">
                @foreach ($results as $result)
                    <a href="#" 
                       wire:click.prevent="selectResult({{ $result['id'] }})"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 cursor-pointer">
                        <div class="font-medium">{{ $result['title'] }}</div>
                        <div class="text-xs text-gray-500">{{ $result['document_number'] }}</div>
                    </a>
                @endforeach
            </div>
        @elseif ($showDropdown && $search && count($results) == 0)
            <div class="absolute z-50 mt-1 w-full bg-white shadow-lg rounded-md border border-gray-200 py-2 px-4 text-sm text-gray-500">
                Tidak ada hasil ditemukan
            </div>
        @endif
    </form>
</div>