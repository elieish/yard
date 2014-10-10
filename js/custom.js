jQuery(document).ready(function($){




	/************** Scroll Navigation *********************/
	$('.navigation').singlePageNav({
        currentClass : 'active'
    });


    /************** Responsive Navigation *********************/

	$('.menu-toggle-btn').click(function(){
        $('.responsive-menu').stop(true,true).slideToggle();
    });


});
