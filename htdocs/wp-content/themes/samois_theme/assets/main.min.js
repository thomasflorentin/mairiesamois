


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

        closeDropdownsContent: function( $els ) {

            let i = 0;
    
            for (let el of $els) {
    
                var this_height = el.offsetHeight + 50;            
                
                el.style.maxHeight = this_height + 'px';
        
                // Don't close for first item
                if( i > 0 ) {
                    el.closest('.js_dropdown').classList.add('closed');
                }
        
                i++;
            }
    
        },
    
    
        handleDropdownsOpening: function( $els ) {
            
            for (let el of $els) {
    
                const js_dropdown = el.closest('.js_dropdown');
    
                el.addEventListener('click', function(e) {
                    e.preventDefault();
        
                    for( let e of $els) {
                        e.closest('.js_dropdown').classList.add('closed');
                    }
        
                    js_dropdown.classList.toggle('closed')
        
                }); 
    
            }
        },

    }





    /*
     * LISTENERS
     */

    // handle show/hide popins
    app.dropdownBtn.addEventListener('click', (e) => app.toggleElement(e, app.dropdownMenu) );
    app.searchbarBtn.addEventListener('click', (e) => app.toggleElement(e, app.searchbarElement) );
    app.shortcutsBtn.addEventListener('click', (e) => app.toggleElement(e, app.shortcuts) );


    // handle scroll
    document.addEventListener("scroll", app.documentIsScrolling, false);


    // handle accordéons
    const $js_dropdown = document.querySelectorAll('.js_dropd_link');
    const $js_dropd_content = document.querySelectorAll('.js_dropd_content');
    
    app.closeDropdownsContent( $js_dropd_content );
    app.handleDropdownsOpening( $js_dropdown );



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