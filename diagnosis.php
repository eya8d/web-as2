<?php
session_start();
require_once 'Databaseconfig/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['plant_image'])) {
    
    $user_id = $_SESSION['user_id'];
    $plant_name = "Tomato";
    $disease = "Early Blight";
    $conf = "95%";
    $treat = "Use copper-based fungicides.";

    $target_dir = "uploads/";
    $file_extension = pathinfo($_FILES["plant_image"]["name"], PATHINFO_EXTENSION);
    $new_file_name = time() . "_" . uniqid() . "." . $file_extension;
    $target_file = $target_dir . $new_file_name;

    if (move_uploaded_file($_FILES["plant_image"]["tmp_name"], $target_file)) {
        try {
                     
            $stmt = $pdo->prepare("INSERT INTO diagnoses (user_id, plant_image, plant_name, disease_name, confidence, treatment) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $new_file_name, $plant_name, $disease, $conf, $treat]);
            
            header("Location: plant_doctor_history/history.php");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Diagnosis | PlantDoctor</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="css/diagnosis.css"> <script>
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

    <?php include_once 'includes/navbar.php'; ?>

    <main class="flex-grow flex items-center justify-center p-4 md:p-12">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-primary-light dark:border-gray-700">
            
            <div class="hidden md:block relative overflow-hidden">
                <img class="absolute inset-0 w-full h-full object-cover"
                     src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?q=80&w=1000" alt="Plant Care">
                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 dark:from-black/90 to-transparent flex flex-col justify-end p-12 text-white">
                    <h2 class="text-3xl font-extrabold mb-4 leading-tight">How to get the <br>best results?</h2>
                    <ul class="space-y-3 opacity-90 text-sm">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-green-400">check_circle</span> Use clear, bright lighting.</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-green-400">check_circle</span> Focus on the affected leaves.</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-green-400">check_circle</span> Keep the camera steady.</li>
                    </ul>
                </div>
            </div>

            <div class="p-8 md:p-16 flex flex-col justify-center bg-white dark:bg-gray-800">
                <div class="mb-10 text-center md:text-left">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-primary-soft dark:bg-primary/20 text-primary dark:text-green-400 mb-6">
                        <span class="material-symbols-outlined !text-3xl" style="font-variation-settings: 'FILL' 1">psychiatry</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-primary dark:text-white mb-2">Plant Diagnosis</h1>
                    <p class="text-gray-500 dark:text-gray-400">Upload a clear photo of your plant to start the AI analysis.</p>
                </div>

                <form action="process_diagnosis.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                    
                    <div class="group relative border-2 border-dashed border-primary-light dark:border-gray-600 rounded-2xl p-10 text-center hover:border-primary transition-all bg-primary-soft/30 dark:bg-gray-900/50 cursor-pointer">
                        <input type="file" name="plant_image" id="plant_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required onchange="previewImage(event)">
                        
                        <div id="upload-placeholder">
                            <span class="material-symbols-outlined text-5xl text-primary/40 dark:text-gray-500 mb-4 group-hover:scale-110 transition-transform">cloud_upload</span>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG or JPEG (Max. 10MB)</p>
                        </div>

                        <img alt="Preview" id="image-preview" class="hidden mx-auto h-48 rounded-eight shadow-md object-cover">
                    </div>

                    <button class="btn-primary w-full py-4 mt-4 shadow-lg hover:shadow-primary/20 flex items-center justify-center gap-3" type="submit">
                        <span class="material-symbols-outlined">analytics</span>
                        Start Analysis
                    </button>
                </form>

                <p class="mt-8 text-center text-sm">
                    <a href="index.php" class="text-gray-500 hover:text-primary dark:hover:text-white flex items-center justify-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                        Back to Home
                    </a>
                </p>
            </div>
        </div>
    </main>

    <?php include_once 'includes/footer.php'; ?>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('image-preview');
                const placeholder = document.getElementById('upload-placeholder');
                output.src = reader.result;
                output.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
