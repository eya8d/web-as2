<?php
session_start();
require_once 'Databaseconfig/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Plant Doctor | Smart Diagnosis</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="/css/styles.css">
    <script>
        tailwind.config = {
            darkMode: 'class', // تفعيل خاصية الدارك مود
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: "#2D5A27",
                            light: "#E9F5E6",
                            soft: "#F3FAF2",
                            accent: "#4A7C44",
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', "sans-serif"],
                    },
                    borderRadius: {
                        'eight': '8px',
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-[#F8FAF7] dark:bg-[#0F170D] text-gray-800 dark:text-gray-100 antialiased transition-colors duration-300">

    <header class="sticky top-0 z-50 bg-white/80 dark:bg-[#0F170D]/80 backdrop-blur-md border-b border-primary-light dark:border-gray-800">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-3xl">🌿</span>
                <h1 class="text-2xl font-bold text-primary dark:text-white">PlantDoctor</h1>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a class="text-primary dark:text-white font-bold border-b-2 border-primary pb-1" href="index.php">Home</a>
                <a class="nav-link" href="ai_plant_doctor_history/history.php">History</a>
                <a class="nav-link" href="AI_Plant_Doctor_Settings/Settings.php">Settings</a>
                <a class="nav-link" href="login/login.php">Login</a>
            </div>

            <div class="flex items-center gap-4">
                <button id="theme-toggle" class="p-2 rounded-full hover:bg-primary-soft dark:hover:bg-gray-800 text-primary dark:text-yellow-400 transition-all">
                    <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>

                <button class="md:hidden text-primary">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                </button>
                <a href="<?php echo isset($_SESSION['user_id']) ?  'diagnosis.php': 'login/login.php'; ?>"
                        class="hidden md:block bg-primary text-white px-6 py-2 rounded-eight font-medium hover:shadow-lg transition-all text-center">
                        <?php echo isset($_SESSION['user_id']) ?  'Start Now': 'Login First'; ?>
                 </a>
                                        
            </div>
        </nav>
    </header>

    <main>
        <section class="relative py-16 md:py-24 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 text-primary dark:text-white">
                                Identify Plant Diseases <br> <span class="text-primary-accent dark:text-green-400">Instantly with AI</span>
                            </h2>
                            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed max-w-xl">
                                Use our advanced AI technology to diagnose plant health in seconds.
                                Simply upload a photo to get an accurate treatment plan.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="btn-primary flex-1">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                Take a Photo
                            </button>
                            <button class="btn-outline flex-1 dark:bg-transparent dark:text-white dark:border-white">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                Open Gallery
                            </button>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-primary-light dark:bg-primary/20 rounded-full blur-3xl opacity-50"></div>
                        <div class="card p-6 border-4 border-primary-light dark:border-gray-700 dark:bg-gray-800">
                            <div class="bg-primary-soft dark:bg-gray-900 rounded-eight overflow-hidden aspect-square flex items-center justify-center">
                                <img src="https://images.unsplash.com/photo-1545239351-ef35f43d514b?q=80&w=1000&auto=format&fit=crop" alt="Healthy Plant" class="w-full h-full object-cover">
                            </div>
                            <div class="mt-4 flex items-center justify-between text-primary dark:text-green-400 font-semibold">
                                <span>Health Analysis</span>
                                <span class="flex items-center gap-1">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    Active AI
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-primary-soft dark:bg-[#0D120B]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h3 class="text-2xl font-bold flex items-center gap-3 dark:text-white">
                        <span class="w-8 h-1 bg-primary dark:bg-green-500 inline-block rounded-full"></span>
                        Quick Tips
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="card p-6 flex items-start gap-4 hover:shadow-xl dark:bg-gray-800 dark:border-gray-700">
                        <div class="bg-primary-light dark:bg-primary/30 p-3 rounded-full text-primary dark:text-green-400 shrink-0">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1 dark:text-white">Watering</h4>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Avoid over-watering to protect roots from fungal diseases.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
                        <li><a class="hover:text-primary dark:hover:text-white" href="#">Home</a></li>
                        <li><a class="hover:text-primary dark:hover:text-white" href="#">Analysis</a></li>
                        <li><a class="hover:text-primary dark:hover:text-white" href="#">Community</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-bold text-primary dark:text-white mb-6">Support</h6>
                    <ul class="space-y-4 text-sm text-gray-600 dark:text-gray-400">
                        <li><a class="hover:text-primary dark:hover:text-white" href="#">FAQs</a></li>
                        <li><a class="hover:text-primary dark:hover:text-white" href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-bold text-primary dark:text-white mb-6">Newsletter</h6>
                    <div class="flex gap-2">
                        <input class="bg-primary-soft dark:bg-gray-800 border-none rounded-eight text-sm focus:ring-1 focus:ring-primary flex-1 dark:text-white" placeholder="Email Address" type="email">
                        <button class="bg-primary dark:bg-green-700 text-white px-4 py-2 rounded-eight text-sm">Join</button>
                    </div>
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

        // تغيير الأيقونة بناءً على الوضع الحالي
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            themeToggleDarkIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            themeToggleLightIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>
