<?php
session_start();
require_once '../Databaseconfig/db.php'; 


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

$stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    try {
        if (!empty($new_password)) {
           
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $pdo->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
            $update_stmt->execute([$new_email, $hashed_password, $user_id]);
        } else {
           
            $update_stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
            $update_stmt->execute([$new_email, $user_id]);
        }
        $message = "Profile updated successfully!";
        $user['email'] = $new_email; 
    } catch (PDOException $e) {
        $message = "Error updating profile: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | PlantDoctor AI</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="settings.css">
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
                <a class="nav-link" href="../ai_plant_doctor_history/history.php">History</a>
                <a class="text-primary dark:text-white font-bold border-b-2 border-primary pb-1" href="Settings.php">Settings</a>
                <a class="nav-link" href="../login/login.php">Login</a>
            </div>

            <div class="flex items-center gap-4">
                <button class="p-2 hover:bg-primary-soft dark:hover:bg-gray-800 rounded-full text-primary dark:text-white transition-colors">
                    <span class="material-symbols-outlined">account_circle</span>
                </button>
            </div>
        </nav>
    </header>

    <main class="flex-grow max-w-4xl mx-auto px-6 py-12 w-full">
        <div class="mb-12">
            <h2 class="text-4xl font-extrabold text-primary dark:text-white mb-3">Settings</h2>
            <p class="text-gray-500 dark:text-gray-400 text-lg">Personalize your gardening experience and system preferences.</p>
        </div>

        <div class="space-y-8">
           <section class="card p-8 dark:bg-gray-800 dark:border-gray-700">
    <form action="Settings.php" method="POST">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-8">
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-primary dark:text-green-400">Account Profile</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Update your personal info and avatar</p>
            </div>
            <div class="relative group">
                <div class="w-20 h-20 rounded-full bg-primary-light dark:bg-gray-900 flex items-center justify-center border-2 border-primary-soft dark:border-gray-700">
                    <span class="material-symbols-outlined text-primary dark:text-green-500 text-3xl">person</span>
                </div>
                <button type="button" class="absolute bottom-0 right-0 p-1.5 bg-primary dark:bg-green-600 text-white rounded-full shadow-lg hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-[16px]">edit</span>
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-sm font-bold text-gray-700 dark:text-gray-300">Email Address</label>
                <input type="email" name="email" class="input-field dark:bg-gray-900 dark:border-gray-700 dark:text-white" 
                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-gray-700 dark:text-gray-300">New Password</label>
                <input type="password" name="password" class="input-field dark:bg-gray-900 dark:border-gray-700 dark:text-white" 
                       placeholder="Enter new password to change">
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end">
            <button type="submit" name="update_profile" class="bg-primary text-white px-8 py-3 rounded-eight font-bold hover:shadow-lg transition-all">
                Save Changes
            </button>
        </div>
    </form>
</section>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <section class="card p-6 dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-primary dark:text-green-400 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">settings_suggest</span> Preferences
                    </h3>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm dark:text-white">Dark Mode</p>
                                <p class="text-xs text-gray-400">Toggle interface theme</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="dark-mode-toggle" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 dark:bg-gray-700 rounded-full peer peer-checked:bg-primary after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm dark:text-white">Notifications</p>
                                <p class="text-xs text-gray-400">Care reminders & alerts</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 dark:bg-gray-700 rounded-full peer peer-checked:bg-primary after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                    </div>
                </section>

                <section class="card p-6 dark:bg-gray-800 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-primary dark:text-green-400 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">psychology</span> AI Engine
                    </h3>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm dark:text-white">Offline Model</p>
                                <p class="text-xs text-gray-400">Process data on device</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 dark:bg-gray-700 rounded-full peer peer-checked:bg-primary after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold text-sm dark:text-white">Diagnostic Precision</p>
                            </div>
                            <span class="bg-primary-soft dark:bg-primary/20 text-primary dark:text-green-400 text-[10px] font-bold px-2.5 py-1 rounded-full border border-primary-light dark:border-gray-700">HIGH</span>
                        </div>
                    </div>
                </section>
            </div>

            <section class="card p-8 bg-gradient-to-br from-white to-primary-soft dark:from-gray-800 dark:to-gray-900 border-primary-light dark:border-gray-700">
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-primary dark:text-green-400 mb-3">Storage & Data</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-6 leading-relaxed">
                            Offline AI models currently use <span class="font-bold text-primary dark:text-green-500">240 MB</span>.
                            Update regularly for better diagnostic accuracy.
                        </p>
                        <div class="flex gap-4">
                            <button class="bg-primary dark:bg-green-700 text-white px-6 py-2.5 rounded-eight text-sm font-bold hover:shadow-lg transition-all">Update Models</button>
                            <button class="text-red-600 dark:text-red-400 bg-white dark:bg-transparent border border-red-100 dark:border-red-900/30 px-6 py-2.5 rounded-eight text-sm font-bold hover:bg-red-50 dark:hover:bg-red-900/10 transition-all">Clear Data</button>
                        </div>
                    </div>
                    <div class="hidden md:block w-32 h-32 opacity-20">
                        <span class="material-symbols-outlined text-[128px] text-primary dark:text-green-500">database</span>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="bg-white dark:bg-[#0F170D] border-t border-primary-light dark:border-gray-800 py-8 text-center text-xs text-gray-400 mt-auto">
        <p>© 2026 The Botanical Atelier. AI Diagnostic Precision.</p>
    </footer>

    <script>
        const darkModeToggle = document.getElementById('dark-mode-toggle');

        // 1. الوظيفة الأساسية عند تحميل الصفحة
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            darkModeToggle.checked = true; // اجعل الـ switch مفعل
        } else {
            document.documentElement.classList.remove('dark');
            darkModeToggle.checked = false;
        }

        // 2. عند تغيير حالة الـ Toggle
        darkModeToggle.addEventListener('change', function() {
            if (this.checked) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        });
    </script>
</body>
</html>
