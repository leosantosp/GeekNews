

$(document).ready(function(){
     $('.carousel').carousel({
          interval: 3000
        });
     
    $("#galeriamenu").mouseover(function(){
        $(".galmenu").css("display", "block");
    });

    $("#galeriamenu").mouseout(function(){
        $(".galmenu").css("display", "none");
    });

    $(".galmenu ").mouseover(function(){
        $(".galmenu").css("display", "block");
    });
    $(".galmenu").mouseout(function(){
        $(".galmenu").css("display", "none");
    });
    var status=0;
    $("#galeriamenu").click(function(){

        if(wid=$(document).width()<750){
            
        if (status==0) {
            $("#div1").html($(document).width());
            
            $(".galmenu-mb").slideDown("slow");
            status=1;
        }else{
            $(".galmenu-mb").slideUp("slow");
            status=0;
        }
        }else{
            $(".galmenu-mb").css("display", "none");
            status=0;

        }
    });

 });

Shadowbox.init({
language: 'pt',
player: ['img', 'html', 'swf']
})