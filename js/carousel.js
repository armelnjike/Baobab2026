document.addEventListener( 'DOMContentLoaded', function() {

    const track = document.getElementById( 'carousel-track' );
    const dots  = document.querySelectorAll( '.carousel-dot' );
    const prev  = document.getElementById( 'carousel-prev' );
    const next  = document.getElementById( 'carousel-next' );

    // Si pas de carousel sur cette page on arrête
    if ( ! track ) return;

    let current = 0;
    const total = track.children.length;

    function goTo( index ) {
        current = index;
        track.style.transform = 'translateX(-' + ( current * 100 ) + '%)';
        dots.forEach( function( dot, i ) {
            dot.classList.toggle( 'bg-white', i === current );
            dot.classList.toggle( 'bg-white/40', i !== current );
        });
    }

    if ( next ) {
        next.addEventListener( 'click', function() {
            goTo( ( current + 1 ) % total );
        });
    }

    if ( prev ) {
        prev.addEventListener( 'click', function() {
            goTo( ( current - 1 + total ) % total );
        });
    }

    dots.forEach( function( dot ) {
        dot.addEventListener( 'click', function() {
            goTo( parseInt( this.getAttribute( 'data-index' ) ) );
        });
    });

});