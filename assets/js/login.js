$(document).ready(function() {  
    
    $(".pre-load").css("display","none");
    
    $(document).on("click","#login-button",function(){
        var txtUsuario = $("#username").val();
        var txtPass = $("#password").val();

        $.ajax({
            url: $.urlLogin,
            type: 'POST',
            dataType: 'json',
            data:  "{\"usuario\" : " + '"' + txtUsuario + '"' + ",\"password\" : " + '"' + txtPass + '"}',
            success: function(respuesta) {
                Cookies.set("token",respuesta, { expires: 1 });
                location.replace("/puertas-adentro/administrador");
            },
            error: function() {
                $("#myModalErrorLogin").modal();
            },
        });
    });
});