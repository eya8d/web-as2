<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | PlantDoctor AI</title>

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

    <?php include_once '../includes/navbar.php'; ?>

    <main class="flex-grow flex items-center justify-center p-4 md:p-12">
        <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-xl border border-primary-light dark:border-gray-700">
            
            <div class="hidden md:block relative overflow-hidden">
                <img class="absolute inset-0 w-full h-full object-cover"
                     src="https://images.unsplash.com/photo-1516253593875-bd7ba052fbc5?q=80&w=1000" alt="Support">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/80 dark:from-black/80 to-transparent flex flex-col justify-end p-12 text-white">
                    <h2 class="text-4xl font-extrabold mb-4 leading-tight">Don't Worry, <br>We've Got You.</h2>
                    <p class="text-lg opacity-90">Recover your account in just a few steps and get back to your garden.</p>
                </div>
            </div>

            <div class="p-8 md:p-16 flex flex-col justify-center bg-white dark:bg-gray-800">
                <div class="mb-10 text-center md:text-left">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-soft dark:bg-primary/20 text-primary dark:text-green-400 mb-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1">lock_reset</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-primary dark:text-white mb-2">Reset Password</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Enter your email and we'll send you a link to reset your password.</p>
                </div>

                <form action="#" class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300" for="email">Email Address</label>
                        <input name="email" required class="w-full px-4 py-3 rounded-eight bg-primary-soft dark:bg-gray-900 border border-primary-light dark:border-gray-700 focus:border-primary focus:ring-0 text-gray-800 dark:text-white transition-all"
                               id="email" type="email" placeholder="your.email@example.com">
                    </div>

                    <button class="btn-primary w-full py-4 mt-4 dark:bg-green-700" type="submit">
                        Send Reset Link
                    </button>
                </form>

                <div class="mt-8 flex flex-col gap-3 text-center text-sm">
                    <p class="text-gray-500 dark:text-gray-400">
                        Remembered your password?
                        <a href="login.php" class="text-primary dark:text-green-400 font-bold hover:underline">Back to Login</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <?php include_once '../includes/footer.php'; ?>

</body>
</html>
