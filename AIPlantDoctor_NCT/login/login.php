<?php
session_start();
require_once '../Databaseconfig/db.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
       
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PlantDoctor AI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="style.css">
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
                <a class="nav-link" href="../AI_Plant_Doctor_Settings/Settings.php">Settings</a>
                <a class="text-primary dark:text-white font-bold border-b-2 border-primary pb-1" href="logout.php">logout</a>
            </div>

            <div class="flex items-center gap-4">
                <button id="theme-toggle" class="p-2 rounded-full hover:bg-primary-soft dark:hover:bg-gray-800 text-primary dark:text-yellow-400 transition-all">
                    <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                </button>
                <button class="hidden md:block bg-primary dark:bg-green-700 text-white px-6 py-2 rounded-eight font-medium hover:shadow-lg transition-all">
                    
                    <a href="Registration.php" class="text-white"> Sign Up</a>
                </button>
            </div>
        </nav>
    </header>

    <main class="flex-grow flex items-center justify-center p-4 md:p-12">
        <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-xl border border-primary-light dark:border-gray-700">
            
            <div class="hidden md:block relative overflow-hidden">
                <img class="absolute inset-0 w-full h-full object-cover"
                     src="https://images.unsplash.com/photo-1453904300235-0f2f60b15b5d?q=80&w=1000" alt="Plant Decoration">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 dark:from-black/80 to-transparent flex flex-col justify-end p-12 text-white">
                    <h2 class="text-4xl font-extrabold mb-4 leading-tight">Welcome Back to <br>PlantDoctor</h2>
                    <p class="text-lg opacity-90">Advanced AI specialized in your home garden's care.</p>
                </div>
            </div>

            <div class="p-8 md:p-16 flex flex-col justify-center bg-white dark:bg-gray-800">
                <div class="mb-10 text-center md:text-left">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-soft dark:bg-primary/20 text-primary dark:text-green-400 mb-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1">eco</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-primary dark:text-white mb-2">Sign In</h1>
                    <p class="text-gray-500 dark:text-gray-400">Access your personalized plant health dashboard.</p>
                </div>

                <form action="login.php" method="POST" class="space-y-6">
                                       
                <?php if(!empty($error)): ?>
                            <div class="bg-red-100 text-red-600 p-3 rounded">
                                <?php echo $error; ?>
                            </div>
                <?php endif; ?>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300" for="email">Email Address</label>
                        <input name="email" class="w-full px-4 py-3 rounded-eight bg-primary-soft dark:bg-gray-900 border border-primary-light dark:border-gray-700 focus:border-primary focus:ring-0 text-gray-800 dark:text-white transition-all"
                               id="email" type="email" placeholder="name@example.com">
                               
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300" for="password">Password</label>
                            <a class="text-xs text-primary dark:text-green-400 font-bold hover:underline" href="forgot_password.php">Forgot Password?</a>
                        </div>
                        <input name="password" class="w-full px-4 py-3 rounded-eight bg-primary-soft dark:bg-gray-900 border border-primary-light dark:border-gray-700 focus:border-primary focus:ring-0 text-gray-800 dark:text-white transition-all"
                               id="password" type="password" placeholder="••••••••">
                    </div>

                    <button class="btn-primary w-full py-4 mt-4 dark:bg-green-700" type="submit">
                        <a href="../index.php" class="text-white" >Sign In</a>
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    Don't have an account?
                    <a href="Registration.php" class="text-primary dark:text-green-400 font-bold hover:underline" >Create one now</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="bg-white dark:bg-[#0F170D] border-t border-primary-light dark:border-gray-800 py-8 text-center text-xs text-gray-400">
        <p>© 2026 The Botanical Atelier. AI Diagnostic Precision.</p>
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
