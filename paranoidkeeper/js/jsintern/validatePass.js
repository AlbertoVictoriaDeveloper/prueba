$("#registerbutton").click(function () {
    if ($("#name").val() && $("#description").val() && $("#url").val() && $("#pass").val() && $("#enckey").val()) {
        if (tiene_numeros($("#pass").val()) && tiene_minusculas($("#pass").val()) && tiene_mayusculas($("#pass").val())) {
            var namePassword = $("#name").val();
            var descriptionPassword = $("#description").val();
            var url = $("#url").val();
            var password = $("#pass").val();
            var key = $("#enckey").val();
            var data = {
                name: namePassword,
                description: descriptionPassword,
                url: url,
                pass: password,
                enckey: key,
            };
  
            $.ajax({
                async: true,
                type: "POST",
                dataType: "JSON",
                url: "insertpass/registerPass",
                data: data,
                success: function (data) {
                    if (data.response == "OK") {
                      $(".inlineSucces").colorbox({inline:true, width:"50%" ,height:"30%",open:true});
                    } else {
                        //alert(data.message);
                        $("#alertedit").html("<strong>Attention</strong>"+ (data.message));
                        $("#alertedit").attr("style", "display:block;");
                        $("#alertedit").fadeOut(5000, "linear");
                    }
                },
                timeout: 1000000,
                error: function (data) {
                    alert("ocurrio error");
                }


            });




        } else {
            $("#alertedit").html("<strong>Attention</strong> Your password must be more than 8 characters between uppercase and lowercase letters and numbers");
            $("#alertedit").attr("style", "display:block;");
            $("#alertedit").fadeOut(5000, "linear");
        }
    } else {
        $("#alertedit").html("<strong>Attention</strong> Complete all fields");
        $("#alertedit").attr("style", "display:block;");
        $("#alertedit").fadeOut(5000, "linear");
    }
});



$("#deletebutton").click(function(){
    $("#insertpass").colorbox.close();
    $("#name").val("");
    $("#description").val("");
    $("#url").val("");
    $("#pass").val("");
    $("#enckey").val("");
    window.location.assign("insertpass/seepass");
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