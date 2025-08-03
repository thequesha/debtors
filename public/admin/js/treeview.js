$.fn.extend({
    treed: function (o) {
        var openedClass = 'opened';
        var closedClass = 'closed';

        if (typeof o != 'undefined') {
            if (typeof o.openedClass != 'undefined') {
                openedClass = o.openedClass;
            }
            if (typeof o.closedClass != 'undefined') {
                closedClass = o.closedClass;
            }
        }

        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            // branch.prepend("<span class='" + closedClass + "'></span>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this === e.target) {
                    var icon = $(this).children('span:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            });

            if ($(this).children('span:first').hasClass(closedClass)) {
                branch.children().children().toggle();
            }

            // branch.children().children().toggle();
        });

        //fire event from the dynamically added icon
        // tree.find('.branch .indicator').each(function () {
        //     $(this).on('click', function () {
        //         $(this).closest('li').click();
        //     });
        // });

        //fire event to open branch if the li contains an anchor instead of text
        // tree.find('.branch>a').each(function () {
        //     $(this).on('click', function (e) {
        //         $(this).closest('li').click();
        //         e.preventDefault();
        //     });
        // });
        //fire event to open branch if the li contains a button instead of text
        // tree.find('.branch>button').each(function () {
        //     $(this).on('click', function (e) {
        //         $(this).closest('li').click();
        //         e.preventDefault();
        //     });
        // });
    }
});
//Initialization of treeviews

$('#tree1').treed();

$('.branch img').css('display', 'block');
$('.branch').click(function () {
    $('.branch img').css('display', 'block');
});
