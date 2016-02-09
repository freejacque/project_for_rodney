/* keyboard-image-navigation.js
 *
 * Taken from: https://github.com/Automattic/_s/blob/430d379f4bc97e6f20d366ec4a06588c5c614abc/js/keyboard-image-navigation.js
 *
 * scroll through images with arrow keys
 */

jQuery( document ).ready( function( $ ) {
  $( document ).keydown( function( e ) {
    var url = false;
    if ( e.which === 37 ) {  // Left arrow key code
      url = $( '.nav-previous a' ).attr( 'href' );
    }
    else if ( e.which === 39 ) {  // Right arrow key code
      url = $( '.entry-attachment a' ).attr( 'href' );
    }
    if ( url && ( ! $( 'textarea, input' ).is( ':focus' ) ) ) {
      window.location = url;
    }
  } );
} );
