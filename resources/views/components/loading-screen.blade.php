<div id="loading-screen" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-opacity duration-500">
    <div class="text-center">
        <!-- Law Logo -->
        <div class="relative w-32 h-32 mx-auto mb-6">
            <div class="absolute inset-0 flex items-center justify-center">
                <!-- Scale of Justice -->
                <!-- <svg class="w-24 h-24 text-[#03A791] animate-pulse" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zm1-11h-2v6h2V8zm0 8h-2v2h2v-2z"/>
                </svg> -->
                <!-- Book -->
                <svg class="absolute w-16 h-16 text-[#0d3b6f] animate-bounce" style="top: 20%; left: 50%; transform: translateX(-50%);" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18 2H6C4.9 2 4 2.9 4 4v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H6V4h2v8l2.5-1.5L13 12V4h5v16z"/>
                </svg>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-64 h-2 bg-[#E6F7F5] rounded-full overflow-hidden mx-auto mb-4">
            <div id="progress-bar" class="h-full bg-[#03A791] rounded-full transition-all duration-300" style="width: 0%"></div>
        </div>

        <p class="text-[#0d3b6f] font-medium">Memuat JDIH Kemenkes...</p>
    </div>
</div>

<style>
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }
    @keyframes bounce {
        0%, 100% {
            transform: translateX(-50%) translateY(0);
        }
        50% {
            transform: translateX(-50%) translateY(-10px);
        }
    }
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    .animate-bounce {
        animation: bounce 2s infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadingScreen = document.getElementById('loading-screen');
        const progressBar = document.getElementById('progress-bar');
        
        // Show loading screen immediately
        loadingScreen.style.display = 'flex';
        
        // Animate progress bar
        let progress = 0;
        const interval = setInterval(() => {
            progress += 1;
            progressBar.style.width = `${progress}%`;
            
            if (progress >= 100) {
                clearInterval(interval);
                loadingScreen.style.opacity = '0';
                setTimeout(() => {
                    loadingScreen.style.display = 'none';
                }, 500);
            }
        }, 10); // 10ms interval for smooth animation
    });
</script> 