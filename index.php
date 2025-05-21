<?php
// index.php - Point d'entrée principal de l'application
require_once 'models/Article.php';
require_once 'models/Category.php';

// Initialisation des modèles
$articleModel = new Article();
$categoryModel = new Category();

// Récupération de la catégorie sélectionnée (si présente)
$selectedCategoryId = isset($_GET['category']) ? (int)$_GET['category'] : null;

// Récupération des articles selon la catégorie sélectionnée
if ($selectedCategoryId) {
    $articles = $articleModel->getArticlesByCategory($selectedCategoryId);
} else {
    $articles = $articleModel->getAllArticles();
}

// Récupération de toutes les catégories
$categories = $categoryModel->getAllCategories();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <title>ActuEsp - Actualités</title>
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
              <a href="index.php" class="font-bold mr-3 text-2xl text-blue-600 italic">ActuEsp<span class="text-red-500">.</span></a>
              <img class="h-8 w-auto" src="asset/espIcone.png" alt="ActuEsp" />          
              </div>
          </div>
          
          <!-- Navigation buttons - Moved to right side -->
          <div class="hidden sm:block">
            <div class="flex space-x-4">
              <a
                href="index.php"
                class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition-colors"
              >
                Accueil
              </a>
              <a
                href=""
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
            href="index.php"
            class="block rounded-md bg-blue-600 px-3 py-2 text-base font-medium text-white"
            aria-current="page"
          >
            Accueil
          </a>
          <a
            href="admin/"
            class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
          >
            Administration
          </a>
        </div>
      </div>
    </nav>

    <!-- Hero Image -->
    <div class="w-full">
    <img class=" w-auto" src="asset/image.png" alt="ActuEsp" />    </div>

    <!-- Catégories et Filtres -->
    <div class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col sm:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Actualités récentes</h2>
        <div class="flex flex-wrap gap-2">
          <a href="index.php" class="category-btn <?php echo !$selectedCategoryId ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300'; ?> px-4 py-2 rounded-md text-sm font-medium">
            Tous
          </a>
          <?php foreach ($categories as $category): ?>
          <a 
            href="index.php?category=<?php echo $category['id']; ?>" 
            class="category-btn <?php echo $selectedCategoryId == $category['id'] ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300'; ?> px-4 py-2 rounded-md text-sm font-medium">
            <?php echo htmlspecialchars($category['libelle']); ?>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Cartes d'actualités -->
<div class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8 mb-12">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    
    <?php if (empty($articles)): ?>
    <div class="col-span-3 text-center py-8">
      <p class="text-xl text-gray-600">Aucun article trouvé dans cette catégorie.</p>
    </div>
    <?php else: ?>
    
    <?php 
    // Liste des images disponibles
    $availableImages = [
       'Sn.png',
       'ChatGPT Image 9 avr. 2025, 19_38_25.png',
       'can-2025-maroc.jpg',
       'ChatGPT Image 9 avr. 2025, 19_38_23.png',
       'ChatGPT Image 9 avr. 2025, 19_38_20.png',
    ];
    
    foreach ($articles as $index => $article): 
        // Sélection de l'image en fonction de l'index de l'article
        $imageIndex = $index % count($availableImages);
        $articleImage = 'asset/' . $availableImages[$imageIndex];
    ?>
    <!-- Article Card -->
    <div class="news-card bg-white rounded-lg overflow-hidden shadow-lg">
      <img src="<?php echo $articleImage; ?>" alt="<?php echo htmlspecialchars($article['titre']); ?>" class="w-full h-48 object-cover" />
      <div class="p-6">
        <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full mb-2">
          <?php echo htmlspecialchars($article['categorie_libelle']); ?>
        </span>
        <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($article['titre']); ?></h3>
        <p class="text-gray-600 mb-4">
          <?php echo substr(htmlspecialchars($article['contenu']), 0, 150) . '...'; ?>
        </p>
        <a href="article.php?id=<?php echo $article['id']; ?>" class="text-blue-600 font-medium hover:underline inline-flex items-center">
          Lire la suite
          <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    </div>
    <?php endforeach; ?>
    
    <?php endif; ?>
  </div>
</div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
          <div class="mb-4 md:mb-0">
            <h2 class="text-xl font-bold">ActuEsp<span class="text-red-500">.</span></h2>
            <p class="text-gray-400">Votre source d'actualités en temps réel</p>
          </div>
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-white">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
              <i class="fab fa-instagram"></i>
            </a>
          </div>
        </div>
        <div class="mt-8 border-t border-gray-700 pt-4 text-sm text-gray-400 text-center">
          &copy; <?php echo date('Y'); ?> ActuEsp. Tous droits réservés.
        </div>
      </div>
    </footer>
  </body>
</html>