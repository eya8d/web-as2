<<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out | PlantDoctor AI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.symbols.outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="style.css"> <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: "#2D5A27",
                            light: "#E9F5E6",
                            soft: "#F3FAF2"
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', "sans-serif"],
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-[#F8FAF7] dark:bg-[#0F170D] text-gray-800 dark:text-gray-100 antialiased min-h-screen flex flex-col transition-colors duration-300">

    <main class="flex-grow flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-2xl p-10 shadow-xl border border-primary-light dark:border-gray-700 text-center">
            
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary-soft dark:bg-primary/20 text-primary dark:text-green-400 mb-6">
                <span class="material-symbols-outlined !text-4xl">logout</span>
            </div>

            <h1 class="text-2xl font-extrabold text-primary dark:text-white mb-4">Logged Out Successfully</h1>
            <p class="text-gray-500 dark:text-gray-400 mb-8">
                Thank you for using <span class="font-bold text-primary dark:text-green-400">AI Plant Doctor</span>. We hope your plants stay healthy!
            </p>

            <div class="flex items-center justify-center gap-2 text-sm text-gray-400">
                <div class="w-2 h-2 bg-primary rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-primary rounded-full animate-bounce [animation-delay:-.3s]"></div>
                <div class="w-2 h-2 bg-primary rounded-full animate-bounce [animation-delay:-.5s]"></div>
                <span>Redirecting you home...</span>
            </div>

            <a href="../index.php" class="inline-block mt-8 text-sm font-bold text-primary dark:text-green-400 hover:underline">
                Click here if you are not redirected
            </a>
        </div>
    </main>

</body>
</html>
