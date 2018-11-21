/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//function to toggle empty and fill login placeholder
$(function(){
  $("[placeholder]").focus(function (){
      $(this).attr("data-text",$(this).attr("placeholder"));
      $(this).attr("placeholder","");
  }).blur(function (){
      $(this).attr("placeholder",$(this).attr("data-text"));
  });  
  
  $("input").each(function(){
    if($(this).attr("required")==="required"){
        $(this).after("<span class='ast'>*</span>");
    }
    
  });
  var inputf=$('input[type=password]');
  $(".password").hover(function(){
      inputf.attr("type","text");
      $(this).attr("class","fa fa-eye-slash fa-2x password")
  },
          function(){
      inputf.attr("type","password");
      $(this).attr("class","fa fa-eye fa-2x password")
  }
          );
  $(".confirm").click(function(){
      return confirm("Are you sure delete this member");
  });
});


$(".toggle-latest").click(function(){
    $(this).toggleClass("selected").parent().next(".panel-body").slideToggle(200);
    if($(this).hasClass("selected")){
        $(this).html(" <i class=\"fa fa-plus\"></i>");
    }else{
                $(this).html(" <i class=\"fa fa-minus\"></i>");

    }
});