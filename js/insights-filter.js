document.addEventListener( 'DOMContentLoaded', function() {

    const tabs     = document.querySelectorAll( '.insight-tab' );
    const cards    = document.querySelectorAll( '.insight-card' );
    const featured = document.querySelector( '.featured-post' );

    if ( ! tabs.length ) return;

    tabs.forEach( function( tab ) {
        tab.addEventListener( 'click', function() {

            const filter = this.getAttribute( 'data-cat' );

            tabs.forEach( function( t ) {
                t.classList.remove( 'border-[#1abc9c]', 'font-bold', 'text-white' );
                t.classList.add( 'border-transparent', 'text-slate-400' );
            });
            this.classList.remove( 'border-transparent', 'text-slate-400' );
            this.classList.add( 'border-[#1abc9c]', 'font-bold', 'text-white' );

            if ( featured ) {
                const featuredCat = featured.getAttribute( 'data-cat' );
                featured.style.display =
                    ( filter === 'all' || featuredCat === filter ) ? 'grid' : 'none';
            }

            cards.forEach( function( card ) {
                const cardCat = card.getAttribute( 'data-cat' );
                card.style.display =
                    ( filter === 'all' || cardCat === filter ) ? 'flex' : 'none';
            });

        });
    });

});