


function init() {
    console.log('dom ready');



    const app = {

        /*
         * PARAMETRES
         */

        body: document.querySelector('body'),
        main: document.querySelector('#page'),

        dropdownBtn: document.querySelector('#js-toggleDropdown'),
        dropdownMenu: document.querySelector('#nav_thematiques'),

        searchbarBtn: document.querySelector('#js-toggleSearchbar'),
        searchbarElement: document.querySelector('#searchbar_wrapper'),




        /*
         * METHODES
         */

        toggleElement: function(e, el) {

            e.preventDefault();
            console.log('toggleElement');
    
            el.classList.toggle('open');
            app.body.classList.toggle('el_toggled');
    
        },

    }





    /*
     * LISTENERS
     */

    app.dropdownBtn.addEventListener('click', (e) => app.toggleElement(e, app.dropdownMenu) );
    app.searchbarBtn.addEventListener('click', (e) => app.toggleElement(e, app.searchbarElement) );


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