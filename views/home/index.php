<!-- Hero Image -->
    <div class="w-full">
      <img class="w-auto" src="<?php echo BASE_URL; ?>/asset/image.png" alt="ActuEsp" />
    </div>

    <!-- Catégories et Filtres -->
    <div class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col sm:flex-row justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 sm:mb-0">Actualités récentes</h2>
        <div class="flex flex-wrap gap-2">
          <!-- Pour le lien "Tous" -->
          <a href="<?php echo BASE_URL; ?>/public/index.php" class="category-btn <?php echo !$selectedCategoryId ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300'; ?> px-4 py-2 rounded-md text-sm font-medium">
            Tous
          </a>
          
          <!-- Pour les liens de catégories -->
          <?php foreach ($categories as $category): ?>
          <a 
            href="<?php echo BASE_URL; ?>/public/index.php?category=<?php echo $category['id']; ?>" 
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
        foreach ($articles as $index => $article): 
            // Sélection de l'image en fonction de l'index de l'article
            $imageIndex = $index % count($availableImages);
            $articleImage = BASE_URL . '/asset/' . $availableImages[$imageIndex];
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
            <a href="<?php echo BASE_URL; ?>/public/index.php?action=article&id=<?php echo $article['id']; ?>" class="text-blue-600 font-medium hover:underline inline-flex items-center">
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