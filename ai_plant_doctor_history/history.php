<?php

session_start();
require_once '../Databaseconfig/db.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM diagnoses WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$diagnoses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis History | PlantDoctor AI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: "#2D5A27",
                            light: "#E9F5E6",
                            soft: "#F3FAF2",
                            accent: "#4A7C44",
                        },
                        status: {
                            healthy: "#3e6a25",
                            warning: "#a73b21",
                            danger: "#791903",
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', "sans-serif"],
                    },
                    borderRadius: { 'eight': '8px' }
                }
            }
        };
    </script>
</head>
<body class="bg-[#F8FAF7] dark:bg-[#0F170D] text-gray-800 dark:text-gray-100 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <header class="sticky top-0 z-50 bg-white/80 dark:bg-[#0F170D]/80 backdrop-blur-md border-b border-primary-light dark:border-gray-800">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-3xl">🌿</span>
                <h1 class="text-2xl font-bold text-primary dark:text-white">PlantDoctor</h1>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a class="nav-link" href="../index.php">Home</a>
                <a class="text-primary dark:text-white font-bold border-b-2 border-primary pb-1" href="history.php">History</a>
                <a class="nav-link" href="../AI_Plant_Doctor_Settings/Settings.php">Settings</a>
                <a class="nav-link" href="../login/login.php">Login</a>
            </div>

            <div class="flex items-center gap-4">
                <button id="theme-toggle" class="p-2 rounded-full hover:bg-primary-soft dark:hover:bg-gray-800 text-primary dark:text-yellow-400 transition-all">
                    <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>
                <button class="p-2 hover:bg-primary-soft dark:hover:bg-gray-800 rounded-full text-primary dark:text-white transition-colors">
                    <span class="material-symbols-outlined">account_circle</span>
                </button>
            </div>
        </nav>
    </header>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        <section class="mb-10">
            <h2 class="text-4xl font-extrabold text-primary dark:text-white tracking-tight mb-3">Diagnosis History</h2>
            <p class="text-gray-500 dark:text-gray-400 text-lg">Track your plants' growth and health journey through our AI archives.</p>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-10">
            <div class="md:col-span-6 lg:col-span-7 bg-white dark:bg-gray-800 rounded-eight border border-primary-light dark:border-gray-700 p-2 flex items-center gap-3 transition-colors">
                <span class="material-symbols-outlined text-gray-400 pl-2">search</span>
                <input type="text" placeholder="Search for a plant or disease..." class="bg-transparent border-none focus:ring-0 w-full text-sm dark:text-white dark:placeholder-gray-500">
            </div>
            <div class="md:col-span-3 lg:col-span-2 bg-white dark:bg-gray-800 rounded-eight border border-primary-light dark:border-gray-700 p-2 flex items-center transition-colors">
                <span class="material-symbols-outlined text-gray-400 px-2">calendar_month</span>
                <select class="bg-transparent border-none focus:ring-0 w-full text-sm cursor-pointer dark:text-white">
                    <option class="dark:bg-gray-800">All Time</option>
                    <option class="dark:bg-gray-800">Last Week</option>
                    <option class="dark:bg-gray-800">Last Month</option>
                </select>
            </div>
            <div class="md:col-span-3 lg:col-span-3 bg-white dark:bg-gray-800 rounded-eight border border-primary-light dark:border-gray-700 p-2 flex items-center transition-colors">
                <span class="material-symbols-outlined text-gray-400 px-2">filter_list</span>
                <select class="bg-transparent border-none focus:ring-0 w-full text-sm cursor-pointer dark:text-white">
                    <option class="dark:bg-gray-800">Status: All</option>
                    <option class="dark:bg-gray-800">Healthy</option>
                    <option class="dark:bg-gray-800">Needs Attention</option>
                    <option class="dark:bg-gray-800">At Risk</option>
                </select>
            </div>
        </section>

  <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php if (count($diagnoses) > 0): ?>
        <?php foreach ($diagnoses as $row): ?>
            <article class="card overflow-hidden group dark:bg-gray-800 dark:border-gray-700">
                <div class="relative h-52 overflow-hidden">
                    <img src="../uploads/<?php echo htmlspecialchars($row['plant_image']); ?>" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                         onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
                    
                    <div class="absolute top-4 left-4">
                        <?php 
                        $isHealthy = (strtolower($row['disease_name']) == 'healthy');
                        $statusClass = $isHealthy ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                        ?>
                        <span class="<?php echo $statusClass; ?> px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]"><?php echo $isHealthy ? 'check_circle' : 'error'; ?></span> 
                            <?php echo htmlspecialchars($row['disease_name']); ?>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-primary dark:text-white"><?php echo htmlspecialchars($row['plant_name']); ?></h3>
                        <span class="text-xs text-gray-400"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></span>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">
                        Confidence: <span class="font-bold text-primary"><?php echo htmlspecialchars($row['confidence']); ?></span>
                    </p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-6 line-clamp-2 italic">
                        "<?php echo htmlspecialchars($row['treatment']); ?>"
                    </p>
                    <button class="w-full bg-primary-soft text-primary font-bold py-3 rounded-eight hover:bg-primary hover:text-white transition-all">
                        View Full Report
                    </button>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="col-span-full text-center py-10 text-gray-500">No records found.</p>
    <?php endif; ?>
</section>

        <div class="mt-16 flex justify-center">
            <button class="bg-primary dark:bg-green-700 text-white font-bold py-4 px-10 rounded-eight shadow-lg hover:scale-105 transition-transform active:scale-95">
                Load More Results
            </button>
        </div>
    </main>

    <footer class="bg-white dark:bg-[#0F170D] border-t border-primary-light dark:border-gray-800 pt-12 pb-8 mt-12 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col items-center md:items-start gap-1 text-center md:text-left">
                <span class="text-lg font-bold text-primary dark:text-white">PlantDoctor AI</span>
                <span class="text-xs text-gray-400">© 2026 The Botanical Atelier. Precise Diagnostics.</span>
            </div>
            <div class="flex gap-6 text-xs text-gray-500 dark:text-gray-400">
                <a class="hover:text-primary dark:hover:text-white transition-colors" href="#">Privacy</a>
                <a class="hover:text-primary dark:hover:text-white transition-colors" href="#">Terms</a>
                <a class="hover:text-primary dark:hover:text-white transition-colors" href="#">Support</a>
                <a class="hover:text-primary dark:hover:text-white transition-colors" href="#">Contact</a>
            </div>
        </div>
    </footer>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

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
