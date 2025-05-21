<!-- Contenu principal -->
    <div class="max-w-4xl mx-auto my-8 px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <img src="<?php echo BASE_URL; ?>/asset/article-banner.jpg" class="w-full h-80 object-cover" alt="<?php echo htmlspecialchars($article['titre']); ?>" />
        
        <div class="p-6 md:p-8">
          <div class="flex items-center mb-4">
            <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">
              <?php echo htmlspecialchars($article['categorie_libelle']); ?>
            </span>
            <span class="text-gray-500 text-sm ml-4">
              Publié le <?php echo date('d/m/Y', strtotime($article['dateCreation'])); ?>
            </span>
          </div>
          
          <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            <?php echo htmlspecialchars($article['titre']); ?>
          </h1>
          
          <div class="prose prose-lg max-w-none text-gray-600 mb-6">
            <?php 
            // On divise le contenu en paragraphes pour une meilleure présentation
            $paragraphs = explode("\n", $article['contenu']);
            foreach($paragraphs as $paragraph) {
                if (trim($paragraph)) {
                    echo '<p>' . htmlspecialchars($paragraph) . '</p>';
                }
            }
            ?>
          </div>
          
          <div class="border-t border-gray-200 pt-6 mt-8">
            <a href="<?php echo BASE_URL; ?>/index.php" class="inline-flex items-center text-blue-600 hover:underline">
              <svg class="w-4 h-4 mr-2 rotate-180" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
              Retour aux actualités
            </a>
          </div>
        </div>
      </div>
    </div>