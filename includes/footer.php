<footer class="bg-white dark:bg-[#0F170D] border-t border-primary-light dark:border-gray-800 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="md:col-span-1">
                <div class="flex items-center gap-2 mb-6 text-primary dark:text-white">
                    <span class="text-2xl">🌿</span>
                    <span class="text-xl font-bold">PlantDoctor AI</span>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Helping plant lovers care for their gardens using the power of AI.
                </p>
            </div>
            <div>
                <h6 class="font-bold text-primary dark:text-white mb-6">Explore</h6>
                <ul class="space-y-4 text-sm text-gray-600 dark:text-gray-400">
                    <li><a class="hover:text-primary dark:hover:text-white" href="/AIPlantDoctor_NCT/index.php">Home</a></li>
                    <li><a class="hover:text-primary dark:hover:text-white" href="/AIPlantDoctor_NCT/index.php#about-section">About</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-8 border-t border-gray-100 dark:border-gray-800 text-center text-gray-400 text-sm">
            <p>&copy; 2026 PlantDoctor AI. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        if(themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        if(themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');
    if(themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    }
</script>
