<?php

$current_page = basename($_SERVER['PHP_SELF']);

$button_link = "../login/login.php";
$button_text = "Login";

if ($current_page == 'Registration.php' || $current_page == 'forgot_password.php') {
    $button_link = "../login/login.php";
    $button_text = "Login";
} elseif ($current_page == 'diagnosis.php') {
    $button_link = "/AIPlantDoctor_NCT/login/logout.php"; // تأكدي من مسار ملف الـ logout
    $button_text = "Logout";
}
?>

<header class="sticky top-0 z-50 bg-white/80 dark:bg-[#0F170D]/80 backdrop-blur-md border-b border-primary-light dark:border-gray-800">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-3xl">🌿</span>
            <h1 class="text-2xl font-bold text-primary dark:text-white">PlantDoctor</h1>
        </div>

        <div class="hidden md:flex items-center gap-8">
            <a class="nav-link text-primary dark:text-white font-bold border-b-2 border-primary pb-1" href="/AIPlantDoctor_NCT/index.php">Home</a>
            <a class="nav-link" href="../ai_plant_doctor_history/history.php">History</a>
            <a class="nav-link" href="/AIPlantDoctor_NCT/AI_Plant_Doctor_Settings/Settings.php">Settings</a>
            <a class="nav-link" href="/AIPlantDoctor_NCT/login/login.php">Login</a>
        </div>

        <div class="flex items-center gap-4">
            <button id="theme-toggle" class="p-2 rounded-full hover:bg-primary-soft dark:hover:bg-gray-800 text-primary dark:text-yellow-400 transition-all">
                <svg id="theme-toggle-dark-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            </button>

                <div class="flex items-center gap-4">
                    <a href="<?php echo $button_link; ?>" 
                         class="bg-primary text-white px-6 py-2 rounded-eight font-bold hover:shadow-lg transition-all text-sm">
                        <?php echo $button_text; ?>
                    </a>
                </div>
        </div>
    </nav>
</header>
