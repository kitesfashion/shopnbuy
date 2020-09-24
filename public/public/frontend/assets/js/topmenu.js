$(function () {
   
    $('ul.navbar-nav a').on('click', function (e) {
            if (!$(this).hasClass("active")) {
                // hide any open menus and remove all other classes
                $('ul.navbar-nav a').removeClass("active");
                $("ul", $(this).parents("ul:first")).removeClass("show");
                
                // open our new menu and add the open class
                $(this).next("ul").addClass("show");
                $(this).addClass("active");
                
            }
            else if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).next("ul").removeClass("show");
            }
    })
    
});