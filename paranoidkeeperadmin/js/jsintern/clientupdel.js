
$(".deleteUser").click(function(){
    var id=$(this).attr("value");
    $("#iddelete").val(id);      
});

$("#canceldel").click(function(){
    $("#deleleteUser").val("");
    $("#deletepass").colorbox.close();
});

$("#canceldelParanoid").click(function(){
    $("#iddeleteParanoid").val("");
    $("#deleteUser").colorbox.close();
});

$(".deleteUserParanoid").click(function(){
   var id=$(this).attr("value"); 
    $("#iddeleteParanoid").val(id); 
});





$("#delpbuttonParanoid").click(function(){
    var idregister = $("#iddeleteParanoid").val();
    var data = {
        idregister: idregister

        };
    $.ajax({
        async: true,
        type: "POST",
        dataType: "JSON",
        url: "../register/deleteUser",
        data: data,
        success: function (data) {
            if(data.response == "ok"){
                window.location.reload();
                
            }else {
              $("#alert").attr("style", "display:none");
              $("#alert").fadeToggle("slow");
              $("#messageAlert").html("<strong>Attention!</strong>" + (data.message));
              $("#information").attr("style", "display:none");
              $("#alert").fadeOut(6000);
            }
            
            
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
        idregister: idregister

        };
    $.ajax({
        async: true,
        type: "POST",
        dataType: "JSON",
        url: "register/deleteAdmin",
        data: data,
        success: function (data) {
            if(data.response == "ok"){
                window.location.reload();
                
            }else {
              $("#alert").attr("style", "display:none");
              $("#alert").fadeToggle("slow");
              $("#messageAlert").html("<strong>Attention!</strong>" + (data.message));
              $("#information").attr("style", "display:none");
              $("#alert").fadeOut(6000);
            }
            
            
        },
        timeout: 1000000,
        error: function (data) {
            alert("ocurrio error");
        }

    });
});

  

     function registerUserAdmin() {
    var mail = $("#mail").val();
    var type = $("#typeUser").val();
    if (!mail && !type) {
        $("#mail").attr("style", "border-color:red");
        $("#typeUser").attr("style", "border-color:red");
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please write your email and select a user type.");
        $("#information").attr("style", "display:none");
        $("#alert").fadeOut(6000);
    } else if (mail && !type) {
        $("#typeUser").attr("style", "border-color:red");
        $("#mail").attr("style", "border-color:#c8c8c8");
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please select a user type.");
        $("#information").attr("style", "display:none");
        $("#alert").fadeOut(6000);
    } else if (!mail && type) {
        $("#mail").attr("style", "border-color:red");
        $("#typeUser").attr("style", "border-color:#c8c8c8");
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please select a user type.");
        $("#information").attr("style", "display:none");
        $("#alert").fadeOut(6000);
    } else if (mail && type) {

        $("#mail").attr("style", "border-color:#c8c8c8");
        $("#typeUser").attr("style", "border-color:#c8c8c8");
        var data = {
                    mail: mail,
                    type:type
        };
        $.ajax({
            async: true,
            type: "POST",
            dataType: "JSON",
            url: "register/registerAdmin",
            data: data,
            success: function (data) {
                if (data.response == "ok") {
                   
                 window.location.reload();
                } else {
                    $("#alert").attr("style", "display:none");
                    $("#alert").fadeToggle("slow");
                    $("#messageAlert").html("<strong>Attention!</strong>" + (data.message));
                    $("#information").attr("style", "display:none");
                    $("#alert").fadeOut(6000);
                 
                }

            },
            timeout: 1000000,
            error: function (data) {
                alert("ocurrio error");
            }

        });
    }
}
   
                    
function registerUser() {
    var mail = $("#mail").val();
    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var str = mail;
    var patt = new RegExp(expr);
    var res = patt.test(str);

    if (!res && res == "") {
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please write a correct or existing email ");
        $("#mail").attr("style", "border-color:red");
        $("#alert").fadeOut(6000);
        $("#information").attr("style", "display:none");

    } else {
        var data = {
            mail: mail
        };
        $.ajax({async: true,
            type: "POST",
            dataType: "JSON",
            url: "../register/registerUser",
            data: data,
            success: function (data) {
                if (data.response == "ok") {
                   window.location.reload();
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
}

   function seePassword() { 
        var user = $("#userParanoid").val();
    if (!user) {
        $("#alert").attr("style", "display:none");
        $("#alert").fadeToggle("slow");
        $("#messageAlert").html("<strong>Attention!</strong>Please select a user ");
        $("#userParanoid").attr("style", "border-color:red");
        $("#alert").fadeOut(6000);
        $("#information").attr("style", "display:none");
    } else {
        var data = {
            user: user
        };
        $.ajax({async: true,
            type: "POST",
            dataType: "JSON",
            url: "../register/passwordParanoid",
            data: data,
            success: function (data) {
                if (data.response == "ok") {
                 $("#panelPassword").attr("style", "display:hidden");
                 var registers = ("registers", JSON.stringify(data.info['pass']));
                 var  arrayregister = $.parseJSON(registers);

         var tableregisters = "<thead>" +
                '<tr role="row">' +
                "<th>Name Password</th>" +
                "<th>Description</th>" +
                "<th>Url</th>" +
                "<th>Status</th>" +
                "<th>Option</th>" +
                "</tr>" +
                "</thead><tbody>";
        if (arrayregister) {
            $.each(arrayregister, function (i, v)
            {
               var status = v.active == 1 ? "<font color='14BF50'><b>Active</b></font>" : "<font color='red'><b>Disabled</b></font>"; 
               var button = v.active == 1 ?"<button type='button' href ='#disablesPassword' class='btn btn-danger btn-xs inline ' name='passwordDisable' onclick='disablePassword("+v.id+")' value ='"+v.id+"' id='passwordDisable'>Disabled Password</button>":
                 "<button type='button' href='#activatesPassword' class='btn btn-info btn-xs inline activetepass' name='activateUpdate' onclick='updateActivate("+v.id+")' value ='"+v.id+"' id='activateUpdate'>Active Password</button>";
                tableregisters = tableregisters + "<tr role='row' class='odd'>" +
                        "<td>" + v.name + "</td>" +
                        "<td >" + v.descripcion + "</td>" +
                        "<td >" + v.url + "</td>" +
                        "<td >"  +status+ "</td>" +
                        "<td >"  +button+ "</td>" +
                        "</tr>";
            });
            tableregisters = tableregisters + "</tbody>";
            $("#datatable-responsive").html(tableregisters);
           
        }
                  
                } else {
                    $("#alert").attr("style", "display:none");
                    $("#alert").fadeToggle("slow");
                    $("#messageAlert").html("<strong>Attention!</strong>" + (data.message));
                    $("#userParanoid").attr("style", "border-color:red");
                    $("#alert").fadeOut(6000);
                    $("#information").attr("style", "display:none");
                }
            },
            timeout: 1000000,
            error: function (data) {
                alert("ocurrio error");
            }

        });    
    }
}






//Function for disable password 
function disablePassword(id) {
 $("#disablepass").val(id);
 $.colorbox({inline: true, width: "50%", height: "35%", open: true, href: "#disablesPassword"});
}

$("#canceldisable").click(function () {
    $("#disablepass").val("");
    $("#disablesPassword").colorbox.close();
});

$("#passddisable").click(function () {
  var id = $("#disablepass").val();
  
 var data = {
        id: id
    };
    
    $.ajax({async: true,
        type: "POST",
        dataType: "JSON",
        url: "../register/disablePassword",
        data: data,
        success: function (data) {
            if (data.response == "ok") {
                 window.location.reload();
                 $("#disablepass").val("");
                 $("#disablesPassword").colorbox.close();
                 $()
                 
             
            } else {
                $("#alert").attr("style", "display:none");
                $("#alert").fadeToggle("slow");
                $("#messageAlert").html("<strong>Attention!</strong>" + (data.message));
                $("#userParanoid").attr("style", "border-color:red");
                $("#alert").fadeOut(6000);
                $("#information").attr("style", "display:none");
            }
        },
        timeout: 1000000,
        error: function (data) {
            alert("ocurrio error");
        }

    });
});
   
   //Function for Activate password 

function updateActivate(id){
    $("#activatepassword").val(id); 
    $.colorbox({inline: true, width: "50%", height: "35%", open: true, href: "#activatesPassword"});
      
}
$("#cancelActivate").click(function(){
    $("#activatepassword").val("");
    $("activatesPassword").colorbox.close();
      
});

$("#passActivate").click(function () {
    
    var id = $("#activatepassword").val();
     var data = {
        id: id
    };
    $.ajax({async: true,
        type: "POST",
        dataType: "JSON",
        url: "../register/activatePassword",
        data: data,
        success: function (data) {
            if (data.response == "ok") {
                window.location.reload();
               $("#activatepassword").val("");
               $("#activatesPassword").colorbox.close();
            } else {
                $("#activatepassword").val("");
                $("#activatesPassword").colorbox.close();
                $("#alert").attr("style", "display:none");
                $("#alert").fadeToggle("slow");
                $("#messageAlert").html("<strong>Attention!</strong>" + (data.message));
                $("#userParanoid").attr("style", "border-color:red");
                $("#alert").fadeOut(6000);
                $("#information").attr("style", "display:none");
            }
        },
        timeout: 1000000,
        error: function (data) {
            alert("ocurrio error");
        }

    });
});

