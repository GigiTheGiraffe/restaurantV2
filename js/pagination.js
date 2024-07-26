    const paginationLinks = document.querySelectorAll('.page-link');
    const galleryPage = document.querySelectorAll('.gallery-page');
    // Fonction pour afficher la page correspondante et masquer les autres
    function showPage(pageId) {
      // Cache toutes les pages
      galleryPage.forEach((page) => {
        page.classList.add('d-none');
      });
      // Affiche la page sélectionnée
      document.querySelector(pageId).classList.remove('d-none');
    }
  
    // Ajoute un écouteur d'événement pour chaque lien de pagination
    paginationLinks.forEach(function(link) {
      link.addEventListener('click', (event) => {
        // Pas recharger la page
        event.preventDefault();
        // Récupère l'ID de la page cible
        const targetPageId = link.getAttribute('href');
        // Affiche la page cible
        showPage(targetPageId);
      });
    });
  
    // Affiche la première page par défaut
    showPage('#page-1');