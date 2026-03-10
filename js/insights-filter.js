document.addEventListener( 'DOMContentLoaded', function() {

    const tabs     = document.querySelectorAll( '.insight-tab' );
    const cards    = document.querySelectorAll( '.insight-card' );
    const featured = document.querySelector( '.featured-post' );

    if ( ! tabs.length ) return;

    tabs.forEach( function( tab ) {
        tab.addEventListener( 'click', function() {

            const filter = this.getAttribute( 'data-cat' );

            // Mettre à jour le style des onglets
            tabs.forEach( function( t ) {
                t.classList.remove( 'border-primary', 'font-bold', 'text-slate-900' );
                t.classList.add( 'border-transparent', 'text-slate-500' );
            });
            this.classList.remove( 'border-transparent', 'text-slate-500' );
            this.classList.add( 'border-primary', 'font-bold', 'text-slate-900' );

            // Filtrer le featured post
            if ( featured ) {
                const featuredCat = featured.getAttribute( 'data-cat' );
                featured.style.display =
                    ( filter === 'all' || featuredCat === filter ) ? 'grid' : 'none';
            }

            // Filtrer les cartes
            cards.forEach( function( card ) {
                const cardCat = card.getAttribute( 'data-cat' );
                card.style.display =
                    ( filter === 'all' || cardCat === filter ) ? 'flex' : 'none';
            });

        });
    });

});