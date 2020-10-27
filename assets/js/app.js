!(function(e) {
    'use strict'

    function a() {
        e('.slimscroll').slimscroll({
            height: 'auto',
            position: 'right',
            size: '7px',
            color: '#e0e5f1',
            opacity: 1,
            wheelStep: 5,
            touchScrollStep: 50
        })
    }
    a(),
        e('.metismenu').metisMenu(),
        e('.button-menu-mobile').on('click', function(t) {
            t.preventDefault(), e('body').toggleClass('enlarge-menu'), a()
        }),
        e(window).width() < 1025 ?
        e('body').addClass('enlarge-menu') :
        e('body').data('keep-enlarged') != 1 &&
        e('body').removeClass('enlarge-menu'),
        e.fn.tooltip && e('[data-toggle="tooltip"]').tooltip(),
        e('.left-sidenav a').each(function() {
            var t = window.location.href.split(/[?#]/)[0]
            this.href == t &&
                (e(this).addClass('active1'),
                    e(this)
                    .parent()
                    .addClass('active1'),
                    e(this)
                    .parent()
                    .parent()
                    .addClass('in'),
                    e(this)
                    .parent()
                    .parent()
                    .addClass('mm-show1'),
                    e(this)
                    .parent()
                    .parent()
                    .parent()
                    .addClass('mm-active1'),
                    e(this)
                    .parent()
                    .parent()
                    .prev()
                    .addClass('active1'),
                    e(this)
                    .parent()
                    .parent()
                    .parent()
                    .addClass('active1'),
                    e(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass('mm-show1'),
                    e(this)
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .parent()
                    .addClass('mm-active1'))
        }),
        Waves.init()
})(jQuery)