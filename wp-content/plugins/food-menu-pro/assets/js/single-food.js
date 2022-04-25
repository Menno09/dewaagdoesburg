( function( $ ) {

    // Tabs
    $( 'body' )
        // Star ratings for comments
        .on( 'init', '#rating', function() {
            $( '#rating' ).hide().before( '<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>' );
        })
        .on( 'click', '#respond p.stars a', function() {
            var $star   	= $( this ),
                $rating 	= $( this ).closest( '#respond' ).find( '#rating' ),
                $container 	= $( this ).closest( '.stars' );

            $rating.val( $star.text() );
            $star.siblings( 'a' ).removeClass( 'active' );
            $star.addClass( 'active' );
            $container.addClass( 'selected' );

            return false;
        })
        .on( 'click', '#respond #submit', function() {
            var $rating = $( this ).closest( '#respond' ).find( '#rating' ),
                rating  = $rating.val();

            if ( $rating.length > 0 && ! rating ) {
                window.alert( 'Please select a rating' );
                return false;
            }
        });

    //Init Tabs and Star Ratings
    $( '#rating' ).trigger( 'init' );
})(jQuery);
