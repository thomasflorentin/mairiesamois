


function init() {
    console.log('init');



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


        closeAll: function( el ) {

            const $all = document.querySelectorAll('*');

            for( let e of $all) {
                if( el !== e ) {
                    e.classList.remove('open');
                }
            }
            
        },

        toggleElement: function(e, el) {

            e.preventDefault();
            console.log('toggleElement');

            app.closeAll( el );

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
                //console.log('documentIsScrolling BACKTOTHETOP');

                app.page.classList.remove('scrolling')
                app.masthead.classList.remove('fixed');
                app.masthead.classList.remove('in');

            }
            else if (st > app.lastScrollTop ){
                //console.log('documentIsScrolling DOWN');

                app.page.classList.add('scrolling')
                app.masthead.classList.add('fixed');
                app.masthead.classList.remove('in');

            } 
            else {
                //console.log('documentIsScrolling UP');

                app.page.classList.add('scrolling')
                app.masthead.classList.add('in');

            }

            app.lastScrollTop = st;
        },


        // ACCORDEONS
        closeDropdownsContent: function( $els ) {
            console.log('closeDropdownsContent');

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
            console.log('handleDropdownsOpening');

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


    // handle sliders
    const cover_slides = document.querySelectorAll('.cover_slide');
    for (const slide of cover_slides) {
        var slider = tns({
            container: slide,
            items: 1,
            controlsText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
        });
    }



    // todo: A faire fonctionner : fermer le menu quand on clique sur la page
    
    console.log(app.main);

    app.main.addEventListener('click', function( e ) {

        if( !e.target.matches('.js-toggleDropdown') ) {
            
            if( !e.target.matches('#nav_thematiques')  ) {

                if( app.dropdownMenu.classList.contains('open') ) {
                    app.dropdownMenu.classList.remove('open');
                }

            }

        }



    })

}




document.addEventListener('DOMContentLoaded', () => init() )