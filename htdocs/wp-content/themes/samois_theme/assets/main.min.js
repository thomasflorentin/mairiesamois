


function init() {
    console.log('dom ready');



    /*
     * VARIABLES
     */

    const $body = document.querySelector('body');
    const $main = document.querySelector('#page');




    /*
     * FONCTIONS
     */

    function toggleElement(e, el) {
        e.preventDefault();
        console.log('toggleElement');

        el.classList.toggle('open');
        $body.classList.toggle('el_toggled');

    }



    /*
     * LISTENERS
     */

    const $dropdownBtn = document.querySelector('#js-toggleDropdown');
    const $ddMenu = document.querySelector('#nav_thematiques');
    $dropdownBtn.addEventListener('click', (e) => toggleElement(e, $ddMenu) );

    const $searchbarBtn = document.querySelector('#js-toggleSearchbar');
    const $searchbarElement = document.querySelector('#searchbar_wrapper');
    $searchbarBtn.addEventListener('click', (e) => toggleElement(e, $searchbarElement) );


    // todo: A faire fonctionner : fermer le menu quand on clique sur la page
    // $main.addEventListener('click', function( e ) {
    //     if( $body.classList.contains('menu_panel_is_open')) {
    //         if( !e.target.matches('#nav_thematiques')) {
    //             toggleDropdown(e);
    //         }
    //     }
    // })



    

}


document.addEventListener('DOMContentLoaded', () => init() )