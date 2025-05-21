<?php
// Titre de la page
$pageTitle = $pageTitle ?? 'ActuEsp - Actualités';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
      <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
          <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            <!-- Mobile menu button-->
            <button
              type="button"
              class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
              aria-controls="mobile-menu"
              aria-expanded="false"
              onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
            >
              <span class="absolute -inset-0.5"></span>
              <span class="sr-only">Open main menu</span>
              <svg
                class="block size-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                />
              </svg>
            </button>
          </div>
          
          <!-- Logo and Brand -->
          <div class="flex items-center">
            <div class="flex shrink-0 items-center">
              <a href="<?php echo BASE_URL; ?>/index.php" class="font-bold mr-3 text-2xl text-blue-600 italic">ActuEsp<span class="text-red-500">.</span></a>
              <img class="h-8 w-auto" src="<?php echo BASE_URL; ?>/asset/espIcone.png" alt="ActuEsp" />
            </div>
          </div>
          
          <!-- Navigation buttons - Moved to right side -->
          <div class="hidden sm:block">
            <div class="flex space-x-4">
              <a
                href="<?php echo BASE_URL; ?>/index.php"
                class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition-colors"
              >
                Accueil
              </a>
              <a
                href="<?php echo BASE_URL; ?>/admin/"
                class="rounded-md bg-gray-700 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800 transition-colors"
              >
                Administration
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile menu, show/hide based on menu state. -->
      <div class="sm:hidden hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3">
          <a
            href="<?php echo BASE_URL; ?>/index.php"
            class="block rounded-md bg-blue-600 px-3 py-2 text-base font-medium text-white"
            aria-current="page"
          >
            Accueil
          </a>
          <a
            href="<?php echo BASE_URL; ?>/admin/"
            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
          >
            Administration
          </a>
        </div>
      </div>
    </nav>