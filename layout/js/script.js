$(document).ready(function(){
    $(".gear-check").click(function(){
        $(".color-option").fadeToggle();
    });
    var colorLi = $(".color-option ul li");
   colorLi
        .eq(0).css("background-color","#FFF").end()
        .eq(1).css("background-color","rgba(212, 38, 0 ,1)").end()
        .eq(2).css("background-color","rgba(49, 38, 34 ,1)").end()
        .eq(3).css("background-color","rgba(255, 144, 105 ,1)").end()
   colorLi.click(function(){
        $("link[href*='theme']").attr("href",$(this).attr("data-value"));
   });
/* Animated menu */
$(function() {
 
	$('#navigation a').stop().animate({'marginLeft':'-90px'},1000);
	 
	$('#navigation> li').hover(
	function () {
	$('a',$(this)).stop().animate({'marginLeft':'-2px'},200);
	},
	function () {
	$('a',$(this)).stop().animate({'marginLeft':'-85px'},200);
	}
	);
});
/*animated menu */

/* start Popup */
	
		 	$("#edit").click(function(){
		 		$("#pop_background").fadeIn();
		 		$("#pop_box").fadeIn();
		 		return false;
		 	});
		 	$("#close").click(function(){
		 		$("#pop_background").fadeOut();
		 		$("#pop_box").fadeOut();
		 		return false;
		 	});
		 	$("#pop_background").click(function(){
		 		$("#pop_background").fadeOut();
		 		$("#pop_box").fadeOut();
		 		return false;
		 	});
		});
		

/* End Popup */
 