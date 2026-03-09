document.addEventListener( 'DOMContentLoaded', function() {

    // On récupère tous les boutons filtres et toutes les cartes
    const filterBtns = document.querySelectorAll( '.filter-btn' );
    const caseItems  = document.querySelectorAll( '.case-item' );

    // Pour chaque bouton filtre, on écoute le clic
    filterBtns.forEach( function( btn ) {
        btn.addEventListener( 'click', function() {

            // 1. Mettre à jour le style des boutons
            //    → bouton cliqué = actif (vert), les autres = gris
            filterBtns.forEach( function( b ) {
                b.classList.remove( 'bg-primary', 'text-white' );
                b.classList.add( 'bg-slate-100', 'text-slate-600' );
            });
            this.classList.remove( 'bg-slate-100', 'text-slate-600' );
            this.classList.add( 'bg-primary', 'text-white' );

            // 2. Récupérer la valeur du filtre choisi
            //    Ex: "all", "web", "ai", "cybersecurity"
            const filter = this.getAttribute( 'data-filter' );

            // 3. Afficher ou cacher chaque carte
            caseItems.forEach( function( item ) {

                // data-category contient les slugs du post
                // Ex: "ai fintech" pour un post avec 2 catégories
                const itemCategories = item.getAttribute( 'data-category' );

                // split(' ') transforme "ai fintech" en ["ai", "fintech"]
                // puis includes() vérifie le mot exact, pas une sous-chaîne
                const categoryList = itemCategories ? itemCategories.split( ' ' ) : [];

                if (
                    filter === 'all' ||
                    categoryList.includes( filter )
                ) {
                    // Afficher la carte
                    item.style.display = 'flex';
                } else {
                    // Cacher la carte
                    item.style.display = 'none';
                }
            });

        });
    });

});