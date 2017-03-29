$(document).ready(function(){
                    
$("#send").click(function(){
    var mail = $("#mail").val();
    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var str = mail;
    var patt = new RegExp(expr);
    var res = patt.test(str);
   
    if (!res && res == "") {

        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please write an mail correct or existing ");
        $("#mail").attr("style", "border-color:red");
        $("#alert").fadeOut(6000); 

    } else {
        var data = {
            mail: mail,
        };
        $.ajax({async: true,
            type: "POST",
            dataType: "JSON",
            url: "login/dataregister",
            data: data,
            success: function (data) {
                if (data.response == "OK") {
                    $("#loginMail").attr("style", "display:none");
                    $("#mail").attr("style", "border-color:#c8c8c8");
                    $("#password").attr("style", "display:none");
                    $("#information").attr("style", "display:none");
                    $("#information").fadeToggle("slow");
                    $("#informationBlue").html("<strong>Information!</strong>" + (data.message));
                    $("#loginMail").fadeToggle("slow");
                    $("#password").fadeToggle("slow");
                    $("#alertRegistry").attr("style", "display:none");
                    $("#registry").attr("style", "display:hidden");
                    $("#registry").fadeOut("fast");
                    $("#alert").attr("style", "display:none");
                    $("#sendUser").attr("style", "display:none");
                    $(".inline").colorbox({inline:true, width:"50%" ,height:"23%",open:true});
                    $("#cboxClose").attr("style","display:none;");
                    $("#information").fadeOut(10000); 
                    
                } else {
                    $("#alert").attr("style", "display:none");
                    $("#alert").fadeToggle("slow");
                    $("#messageAlert").html("<strong>Attention!</strong>" + (data.message));
                    $("#mail").attr("style", "border-color:red");
                    $("#alert").fadeOut(6000); 
                }





            },
            timeout: 1000000,
            error: function (data) {
                alert("ocurrio error");
            }

        });
    }


$("#delpbutton").click(function(){    
    $("#sendpass").colorbox.close();
});

});

$("#register").click(function(){
    var mail = $("#mail").val();
    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var str = mail;
    var patt = new RegExp(expr);
    var res = patt.test(str);
   
    if (!res  && res == "") {
       $("#alert").attr("style", "display:none");
       $("#alert").fadeToggle("slow");
       $("#messageAlert").html("<strong>Attention!</strong>Please write an mail Correct or a new for registration" );
       $("#mail").attr("style", "border-color:red");
       $("#information").attr("style","display:none");
       $("#alert").fadeOut(6000); 
    } else {
      
        var data = {
            mail: mail

        };
        $.ajax({async: true,
            type: "POST",
            dataType: "JSON",
            url: "login/registerUser",
            data: data,
            success: function (data) {
                if (data.response == "OK") {
                    $("#alert").attr("style", "display:none");
                    $("#alert").fadeToggle("slow");
                    $("#messageAlert").html("<strong>Attention!</strong>"+(data.message));
                    $("#mail").attr("style","border-color:red");
                    $("#information").attr("style","display:none"); 
                    $("#alert").fadeOut(10000); 
                } else {
                      $("#alert").attr("style", "display:none");
                      $("#registryEmail").attr("style","display:none");
                      $("#loginMail").attr("style", "display:none");
                      $("#loginMail").fadeToggle("slow");
                      $("#mail").attr("style", "border-color:#c8c8c8");
                      $("#information").attr("style","display:none");
                      $("#information").fadeToggle("slow");
                      $("#informationBlue").html("<strong>Information!</strong>" +(data.message));
                      $("#password").attr("style", "display:none");
                      $("#password").fadeToggle("slow"); 
                      $(".inline").colorbox({inline:true, width:"50%",open:true});
                      $("#cboxClose").attr("style","display:none;");
                      $("#information").fadeOut(10000); 
                }
            },
            timeout: 1000000,
            error: function (data) {
                alert("ocurrio error");
            }
          
          
          
          
          
        });
    } 
    
    $("#delpbutton").click(function(){    
    $("#sendpass").colorbox.close();
});
}); 

});
function registerMail() {
    $("#alert").attr("style", "display:none");
    $("#mail").attr("style", "border-color:#c8c8c8");
    $("#registryEmail").attr("style", "display:none");
	//$("#back").attr("style", "display:hidden");
    $("#registryEmail").fadeToggle("slow");
    $("#information").attr("style", "display:none");
    $("#information").fadeToggle("slow");
    $("#informationBlue").html("<strong>Information!</strong>Please write an mail.");
    $("#registry").attr("style", "display:hidden");
    $("#registry").fadeOut("fast");
    $("#sendUser").attr("style", "display:none");
    $("#information").fadeOut(6000); 
		
}






function loginUser() {
    var mail = $("#mail").val();
    var pass = $("#pass").val();

    if (!mail && !pass) {
        $("#mail").attr("style", "border-color:red");
        $("#pass").attr("style", "border-color:red");
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please write your email and password.");
        $("#information").attr("style", "display:none");
        $("#alert").fadeOut(6000); 
    } else if (!mail && pass) {
        $("#mail").attr("style", "border-color:red");
        $("#pass").attr("style", "border-color:#c8c8c8");
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please write your email.");
        $("#information").attr("style", "display:none");
        $("#alert").fadeOut(6000); 
    } else if (mail && !pass) {
        $("#mail").attr("style", "border-color:#c8c8c8");
        $("#pass").attr("style", "border-color:red");
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please write your password.");
        $("#information").attr("style", "display:none");

    } else if (mail && pass) {
        $("#form").submit();


    }

}
 
