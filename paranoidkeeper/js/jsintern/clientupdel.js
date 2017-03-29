$(".editthis").click(function(){
    var id=$(this).attr("value");
    $("#idedit").val(id);
});
$(".deletethis").click(function(){
    var id=$(this).attr("value");
    $("#iddelete").val(id);
});
$(".showp").click(function(){
    var id=$(this).attr("value");
    $("#idshow").val(id);
});

$("#canceldel").click(function(){
    $("#iddelete").val("");
    $("#deletepass").colorbox.close();
});
$("#canceledit").click(function(){
    $("#idedit").val("");
    $("#oldpass").val("");
    $("#newpass").val("");
    $("#confirmpass").val("");
    $("#updateenckey").val("");
    $("#alertedit").html("");
    $("#alertedit").attr("style","display:none;");       
    $("#editpass").colorbox.close();
});
$("#cancelshow").click(function(){
    $("#idedit").val("");
    $("#showenc").val("");
    $("#psw").text("");
    $("#showpass").colorbox.close();
    
});

$("#showpbutton").click(function(){
    var idregister = $("#idshow").val();
    var encval = $("#showenc").val();
    var token = $("#token").val();
    var data = {
        idregister: idregister,
        encval: encval,
        token: token
        };
    $.ajax({
        async: true,
        type: "POST",
        dataType: "JSON",
        url: "../insertpass/getpass",
        data: data,
        success: function (data) {
            $("#psw").text(data.message);
        },
        timeout: 1000000,
        error: function (data) {
            alert("ocurrio error");
        }

    });
});

$("#delpbutton").click(function(){
    var idregister = $("#iddelete").val();
    var data = {
        idregister: idregister,
        token:$("#token").val()
        };
    $.ajax({
        async: true,
        type: "POST",
        dataType: "JSON",
        url: "../insertpass/delpass",
        data: data,
        success: function (data) {
            if(data.response == "ok"){
             window.location.reload();
 
        }else{
             $("#alert").attr("style","display:none");
             $("#alert").fadeToggle("slow");
             $("#messageAlert").html("<strong>Information!</strong>" +(data.message));
        }
        },
        timeout: 1000000,
        error: function (data) {
            alert("ocurrio error");
        }

    });
});
$("#updatepbutton").click(function(){
    if($("#newpass").val().length>8 &&$("#confirmpass").val().length>8 && tiene_numeros($("#newpass").val())&& tiene_numeros($("#confirmpass").val()) && tiene_minusculas($("#newpass").val())&& tiene_minusculas($("#confirmpass").val()) && tiene_mayusculas($("#newpass").val())&&tiene_mayusculas($("#confirmpass").val())){
        var data = {
            oldpass: $("#oldpass").val(),
            newpass: $("#newpass").val(),
            confirmpass: $("#confirmpass").val(),
            encval: $("#updateenckey").val(),
            idregister:$("#idedit").val(),
            token:$("#token").val()
            };
        $.ajax({
            async: true,
            type: "POST",
            dataType: "JSON",
            url: "../insertpass/updatepass",
            data: data,
            success: function (data) {
                if(data.response == "ok"){
                  $("#idedit").val("");
                  $("#oldpass").val("");
                  $("#newpass").val("");
                  $("#confirmpass").val("");
                  $("#updateenckey").val("");
                  $("#alertedit").html("");     
	          $("#editpass").colorbox.close();   
                }else{
            $("#alertedit").html("<strong>Attention</strong>"+ (data.message));
            $("#alertedit").attr("style","display:block;");  
            $( "#alertedit" ).fadeOut( 5000, "linear");   
                }
                
            },
            timeout: 1000000,
            error: function (data) {
                alert("ocurrio error");
            }

        });
    }else{
        $("#alertedit").html("<strong>Attention</strong> Your password must be more than 8 characters between uppercase and lowercase letters and numbers");
        $("#alertedit").attr("style","display:block;");  
        $( "#alertedit" ).fadeOut( 5000, "linear");
        
    }
    
});
    function tiene_numeros(texto){
        var numeros="0123456789";
       for(i=0; i<texto.length; i++){
          if (numeros.indexOf(texto.charAt(i),0)!=-1){
             return 1;
          }
       }
       return 0;
    }
    function tiene_minusculas(texto){
        var letras="abcdefghyjklmnñopqrstuvwxyz";
       for(i=0; i<texto.length; i++){
          if (letras.indexOf(texto.charAt(i),0)!=-1){
             return 1;
          }
       }
       return 0;
    }
    function tiene_mayusculas(texto){
        var letras_mayusculas="ABCDEFGHYJKLMNÑOPQRSTUVWXYZ";
       for(i=0; i<texto.length; i++){
          if (letras_mayusculas.indexOf(texto.charAt(i),0)!=-1){
             return 1;
          }
       }
       return 0;
    }
