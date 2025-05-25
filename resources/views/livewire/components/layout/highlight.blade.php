<section class="relative pt-8 md:pt-12 overflow-hidden bg-gradient-to-b from-white to-[#f8fdfc]">
  <div class="container max-w-7xl mx-auto relative z-10 px-4 py-4 md:py-8">
      <div class="text-center mb-10">
          <h2 class="text-3xl font-bold text-[#03A791] mb-2">Highlight Peraturan</h2>
          <p class="text-gray-600">Sorotan peraturan terbaru dan terpopuler</p>
      </div>

      <!-- Tabs -->
      <div class="flex justify-center mb-8">
          <div class="border-b border-gray-200 w-full max-w-2xl">
              <nav class="flex space-x-8 justify-center" aria-label="Tabs">
                  <button class="tab-button cursor-pointer border-b-2 py-4 px-1 text-center font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="terkini">
                      Terkini
                  </button>
                  <button class="tab-button cursor-pointer border-b-2 py-4 px-1 text-center font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="terpopuler">
                      Terpopuler
                  </button>
              </nav>
          </div>
      </div>

      <!-- Tab Content: Terkini -->
      <div id="terkini-content" class="tab-content" style="display: none;">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4 py-6">
              @php
                  $bgColors = [
                      'Peraturan Menteri' => 'bg-purple-200',
                      'Keputusan Menteri' => 'bg-orange-100',
                      'Instruksi' => 'bg-teal-100',
                      'Surat Edaran' => 'bg-pink-200',
                      'Tidak tersedia' => 'bg-gray-200',
                      // Tambahkan sesuai kebutuhan
                  ];
              @endphp
              @foreach($terkini as $index => $doc)
                  @php
                      $type = $doc->documentType->type_name ?? 'Tidak tersedia';
                      $bgColor = $bgColors[$type] ?? 'bg-blue-100';
                  @endphp
                  <a href="{{ route('documents.show', $doc) }}" class="block h-full">
                      <div class="
                          relative flex flex-col justify-between h-full
                          rounded-2xl shadow-lg overflow-hidden
                          transition-all duration-300 hover:shadow-xl hover:-translate-y-2
                          {{ $bgColor }}
                      ">
                          <!-- Icon di pojok kiri atas -->
                        
                          <div class="p-6 pt-16">
                              <div class="text-sm font-semibold text-teal-600 mb-2">
                                  {{ $doc->announcement_date->format('d M Y') }}
                              </div>
                              <h3 class="text-xl font-bold text-gray-900 mb-2">
                                  {{ $doc->document_number }}
                              </h3>
                              <p class="text-gray-600 text-base mb-3 line-clamp-2">
                                  {{ $doc->title }}
                              </p>
                              <div class="flex items-center gap-2 mb-4">
                                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                      {{ $type }}
                                  </span>
                              </div>
                          </div>
                         
                      </div>
                  </a>
              @endforeach
          </div>
      </div>

      <!-- Tab Content: Terpopuler -->
      <div id="terpopuler-content" class="tab-content" style="display: none;">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4 py-6">
              @foreach($terpopuler as $index => $doc)
                  @php
                      // Daftar warna background
                      $bgColors = [
                          'Peraturan Menteri' => 'bg-purple-200',
                          'Keputusan Menteri' => 'bg-orange-100',
                          'Instruksi' => 'bg-teal-100',
                          'Surat Edaran' => 'bg-pink-200',
                          'Tidak tersedia' => 'bg-gray-200',
                          // Tambahkan sesuai kebutuhan
                      ];
                      $type = $doc->documentType->type_name ?? 'Tidak tersedia';
                      // Pilih warna, jika tidak ada default ke biru
                      $bgColor = $bgColors[$type] ?? 'bg-blue-100';
                  @endphp
                  <a href="{{ route('documents.show', $doc) }}" class="block h-full">
                      <div class="
                          relative flex flex-col justify-between h-full
                          rounded-2xl shadow-lg overflow-hidden
                          transition-all duration-300 hover:shadow-xl hover:-translate-y-2
                          {{ $bgColor }}
                      ">
                          <!-- Icon di pojok kiri atas -->
                          
                          <div class="p-6 pt-16">
                              <div class="text-sm font-semibold text-teal-600 mb-2">
                                  {{ $doc->announcement_date->format('d M Y') }}
                              </div>
                              <h3 class="text-xl font-bold text-gray-900 mb-2">
                                  {{ $doc->document_number }}
                              </h3>
                              <p class="text-gray-600 text-base mb-3 line-clamp-2">
                                  {{ $doc->title }}
                              </p>
                              <div class="flex items-center gap-2 mb-4">
                                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                      {{ $type }}
                                  </span>
                              </div>
                          </div>
                          
                      </div>
                  </a>
              @endforeach
          </div>
      </div>

      <!-- Explore More Button -->
      <div class="flex justify-center mt-10">
          <a href="{{ route('documents.index') }}" class="inline-flex items-center justify-center rounded-md bg-[#03A791] px-6 py-3 text-base font-medium text-white hover:bg-[#028a77] focus:outline-none focus:ring-2 focus:ring-[#03A791] focus:ring-offset-2 transition-colors duration-200">
              Telusuri Lebih Lanjut
          </a>
      </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Ambil semua elemen tab button dan tab content
      const tabButtons = document.querySelectorAll('.tab-button');
      const tabContents = document.querySelectorAll('.tab-content');

      // Pastikan elemen ada sebelum melanjutkan
      if (!tabButtons.length || !tabContents.length) {
          console.warn('Tab buttons or tab contents not found.');
          return;
      }

      // Fungsi untuk mengatur state tab
      const setActiveTab = (activeButton, activeContent) => {
          // Reset semua button dan content
          tabButtons.forEach(btn => {
              btn.classList.remove('active', 'border-[#0d3b6f]', 'text-[#0d3b6f]');
              btn.classList.add('border-transparent', 'text-gray-500');
          });
          tabContents.forEach(content => {
              content.style.display = 'none';
          });

          // Aktifkan button dan content yang dipilih
          activeButton.classList.add('active', 'border-[#03A791]', 'text-[#0d3b6f]');
          activeButton.classList.remove('border-transparent', 'text-gray-500');
          activeContent.style.display = 'block';
      };

      // Event listener untuk klik pada tab button
      tabButtons.forEach(button => {
          button.addEventListener('click', () => {
              const tabId = button.getAttribute('data-tab');
              const content = document.getElementById(`${tabId}-content`);
              if (content) {
                  setActiveTab(button, content);
              }
          });
      });

      // Set tab pertama sebagai default aktif
      const firstButton = tabButtons[0];
      const firstTabId = firstButton.getAttribute('data-tab');
      const firstContent = document.getElementById(`${firstTabId}-content`);
      if (firstButton && firstContent) {
          setActiveTab(firstButton, firstContent);
      }
  });
</script>