function history() { 
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
            url: "../register/historyUser",
            data: data,
            success: function (data) {
                if (data.response == "ok") {                 
                $("#panelPassword").attr("style", "display:hidden");
                 var registers = ("registers",JSON.stringify(data.info['history'])); 
                 var  arrayregister = $.parseJSON(registers);
                
         var tableregisters = "<thead>" +
                '<tr role="row">' +
                "<th>Start connection</th>" +
                "<th>End Connection</th>" +
                "</tr>" +
                "</thead><tbody>";
        if (arrayregister) {
            $.each(arrayregister, function (i, v)
            {
                var status = v.type == 1 ? "<font color='14BF50'><b>Active</b></font>" : v.end_connection ; 
                tableregisters = tableregisters + "<tr role='row' class='odd'>" +
                        "<td>" + v.start_connection + "</td>" +
                        "<td >" +status+ "</td>" +
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