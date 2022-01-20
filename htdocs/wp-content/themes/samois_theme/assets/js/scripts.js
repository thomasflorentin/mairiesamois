


function init() {
    console.log('dom ready');



    const app = {

        /*
         * PARAMETRES
         */

        body: document.querySelector('body'),
        main: document.querySelector('#page'),
        masthead: document.querySelector('#masthead'),
        page: document.querySelector('#page'),

        dropdownBtn: document.querySelector('#js-toggleDropdown'),
        dropdownMenu: document.querySelector('#nav_thematiques'),

        searchbarBtn: document.querySelector('#js-toggleSearchbar'),
        searchbarElement: document.querySelector('#searchbar_wrapper'),

        shortcutsBtn: document.querySelector('#js-shortcutsBtn'),
        shortcuts: document.querySelector('#shortcuts'),

        didScroll: false,
        lastScrollTop: 0,
        delta: 20,





        /*
         * METHODES
         */

        toggleElement: function(e, el) {

            e.preventDefault();
            console.log('toggleElement');
    
            el.classList.toggle('open');
            app.body.classList.toggle('el_toggled');
    
        },


        documentIsScrolling: function () {
            app.didScroll = true;
    
            // Handle menu
            setInterval(function() {
                if (app.didScroll) {
                    app.handleScrollForMenu();
                    app.didScroll = false;
                }
            }, 250);
        },


        handleScrollForMenu: function () {
            console.log('handleScrollForMenu');

            let st = window.scrollY;

            // Make sure they scroll more than delta
            if(Math.abs(app.lastScrollTop - st) <= app.delta)
                return;
            
            if( st < 50 ) {
                console.log('documentIsScrolling BACKTOTHETOP');

                app.page.classList.remove('scrolling')
                app.masthead.classList.remove('fixed');
                app.masthead.classList.remove('in');

            }
            else if (st > app.lastScrollTop ){
                console.log('documentIsScrolling DOWN');

                app.page.classList.add('scrolling')
                app.masthead.classList.add('fixed');
                app.masthead.classList.remove('in');

            } 
            else {
                console.log('documentIsScrolling UP');

                app.page.classList.add('scrolling')
                app.masthead.classList.add('in');

            }

            app.lastScrollTop = st;
        },

    }





    /*
     * LISTENERS
     */

    app.dropdownBtn.addEventListener('click', (e) => app.toggleElement(e, app.dropdownMenu) );
    app.searchbarBtn.addEventListener('click', (e) => app.toggleElement(e, app.searchbarElement) );
    app.shortcutsBtn.addEventListener('click', (e) => app.toggleElement(e, app.shortcuts) );


    document.addEventListener("scroll", app.documentIsScrolling, false);


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