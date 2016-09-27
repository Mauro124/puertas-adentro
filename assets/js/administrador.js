$(document).ready(function(){

    // Token de acceso //

    $.token = Cookies.get("token");
    if($.token == null ){
        location.replace("/login");
    };

    // FUNCIONALIDAD PARA AGREGAR LOGOS //

    $(document).on("click","#btn-agregar-logo",function(){
        $("#myModalAgregarLogo").modal();
        $("#titulo-modal").text("Agregar nuevo logo");
    });

    // FUNCIONALIDAD PARA BORRAR LOGOS //

    $.logosBorrados = [];

    // Borrar logo destacado //

    $(document).on("click","button[id*=btn-borrar-logo-destacado-]",function(){
        $.logoDestacado = $(event.target).attr("id");
        $("#myModalEliminarLogoDestacado").modal();
    });

    // Borrar logo oculto destacado //

    $(document).on("click","button[id*=btn-borrar-logo-oculto-destacado-]",function(){
        $.logoOcultoDestacado = $(event.target).attr("id");
        $("#myModalEliminarLogoOcultoDestacado").modal();
    });

    // Borrar logo oculto secundario //

    $(document).on("click","button[id*=btn-borrar-logo-oculto-secundario-]",function(){
        $.logoOcultoSecundario = $(event.target).attr("id");
        $("#myModalEliminarLogoOcultoSecundario").modal();
    });

    $(document).on("click","button[id*=btn-eliminar-logo-]",function(){
        if($(this).attr("id") == "btn-eliminar-logo-destacado"){
            $(".logo-destacado-"+ $.logoDestacado.substr(26)).remove();
            $.logosBorrados.push($.logoDestacado.substr(26));
        } else if($(this).attr("id") == "btn-eliminar-logo-oculto-destacado"){
            $(".logo-oculto-destacado-"+ $.logoOcultoDestacado.substr(33)).remove();
            $.logosBorrados.push($.logoOcultoDestacado.substr(33));
        } else if($(this).attr("id") == "btn-eliminar-logo-oculto-secundario"){
            $(".logo-oculto-secundario-"+ $.logoOcultoSecundario.substr(34)).remove();
            $.logosBorrados.push($.logoOcultoSecundario.substr(34));
        }
    });


    // Confirmar Logo Creado //     

    $(document).on("click","#btn-aceptar-logo",function(){
        $.href = $("#txt-pagina-web").val();

        // Validación de escritura http //

        if($.href.includes("http") == true){
            $.href = $("#txt-pagina-web").val();
        } else {
            $.href = "http://" + $.href;
        }

        $.nombreEmpresa = $("#txt-nombre-empresa").val().replace(/ /g,'');
        $.prioridad = $("#txt-prioridad-logo").val();

        if($.href.length == 0 || $.nombreEmpresa.length == 0){
            $("#myModalError").modal();
        } else {
            if($("#txt-prioridad-logo").val() == "Empresa Destacada"){
                $("#ctnr-logos-destacados").append("<div class='ui-state-default'><div id='"+ $.nombreEmpresa +"' class='logo-destacado-"+ $.nombreEmpresa +"' name='"+ $.prioridad +"'><a href='"+ $.href +"'><button class='btn btn-primary btn-redireccion'><span class='glyphicon glyphicon-globe'></span></a><button class='btn btn-primary btn-borrar-logo' id='btn-borrar-logo-destacado-"+ $.nombreEmpresa +"'><span id='btn-borrar-logo-destacado-"+ $.nombreEmpresa +"' class='glyphicon glyphicon-trash'></span></button></div></div>");
                $(".logo-destacado-"+ $.nombreEmpresa).css("background-image",'url(' + $.imgLogo + ')');
            } else if($("#txt-prioridad-logo").val() == "Empresa Oculta Destacada"){
                $("#ctnr-logos-ocultos-destacados").append("<div class='ui-state-default'><div id='"+ $.nombreEmpresa +"' class='logo-oculto-destacado-"+ $.nombreEmpresa +"' name='"+ $.prioridad +"'><a href='"+ $.href +"'><button class='btn btn-primary btn-redireccion'><span class='glyphicon glyphicon-globe'></span></a><button class='btn btn-primary btn-borrar-logo' id='btn-borrar-logo-oculto-destacado-"+ $.nombreEmpresa +"'><span id='btn-borrar-logo-oculto-destacado--"+ $.nombreEmpresa +"' class='glyphicon glyphicon-trash'></span></button></div></div>");
                $(".logo-oculto-destacado-"+ $.nombreEmpresa).css("background-image",'url(' + $.imgLogo + ')');
            } else if($("#txt-prioridad-logo").val() == "Empresa Oculta Secundaria"){
                $("#ctnr-logos-ocultos-secundarios").append("<div class='ui-state-default'><div id='"+ $.nombreEmpresa +"' class='logo-oculto-secundario-"+ $.nombreEmpresa +"' name='"+ $.prioridad +"'><a href='"+ $.href +"'><button class='btn btn-primary btn-redireccion'><span class='glyphicon glyphicon-globe'></span></a><button class='btn btn-primary btn-borrar-logo' id='btn-borrar-logo-oculto-secundario-"+ $.nombreEmpresa +"'><span id='btn-borrar-logo-oculto-secundario-"+ $.nombreEmpresa +"' class='glyphicon glyphicon-trash'></span></button></div></div>");
                $(".logo-oculto-secundario-"+ $.nombreEmpresa).css("background-image",'url(' + $.imgLogo + ')');
            }
        }

        // Reset de campos en el modal para crear logos //

        $("#txt-nombre-empresa").val("");
        $("#txt-pagina-web").val("");
        $("#txt-prioridad-logo").val("");
        $("#img-cropeada").css("background-image","url(./assets/css/img/logos/nuevo-logo-destacado.png)");
    });


    // Administrador Banner //

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview-imagen-banner').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#btn-seleccionar-banner").change(function(){
        readURL(this);
    });

    $(document).on("click","#btn-seleccionar-url", function(){
        var url = $("#url-banner").val();
        $('#preview-imagen-banner').attr('src', url);
    });

    $(document).on("change","#alto",function(){
        var alto = $("#alto").val();
        $('#preview-imagen-banner').css('height', alto+"px");
    });

    $(document).on("change","#ancho",function(){
        var ancho = $("#ancho").val()/10;
        $('#preview-imagen-banner').css('width', ancho+"%");
    });


    // CONEXIONES CON LA API //

    // Traer logos de la base //

    $.ajax({
        url: $.urlTraerLogos,
        type: 'GET',
        dataType: 'json',
        success: function(logos_guardados) {
            $.each(logos_guardados, function(i, guardado){
                var objetoLogo= {
                    id : guardado.id,
                    imagen: guardado.imagen,
                    link: guardado.link,
                    destacado: guardado.destacado,
                    nombre: guardado.nombre,
                    oculto: guardado.oculto,
                }

                // Creación de logos a partir de datos obtenidos de la base de datos //

                if(objetoLogo.destacado == "1" && objetoLogo.oculto == "0"){
                    $("#ctnr-logos-destacados").append("<div class='ui-state-default'><div id='"+ objetoLogo.nombre +"' class='logo-destacado-"+ objetoLogo.nombre +"'><a href='"+ objetoLogo.link +"'><button class='btn btn-primary btn-redireccion'><span class='glyphicon glyphicon-globe'></span></a><button class='btn btn-primary btn-borrar-logo' id='btn-borrar-logo-destacado-"+ objetoLogo.nombre +"'><span id='btn-borrar-logo-destacado-"+ objetoLogo.nombre +"' class='glyphicon glyphicon-trash'></span></button></div></div>");
                    $(".logo-destacado-"+ objetoLogo.nombre).css("background-image",'url(' + "data:image/png;base64," + objetoLogo.imagen + ')');
                } else if(objetoLogo.destacado == "1" && objetoLogo.oculto == "1"){
                    $("#ctnr-logos-ocultos-destacados").append("<div class='ui-state-default'><div id='"+ objetoLogo.nombre +"' class='logo-oculto-destacado-"+ objetoLogo.nombre +"'><a href='"+ objetoLogo.link +"'><button class='btn btn-primary btn-redireccion'><span class='glyphicon glyphicon-globe'></span></a><button class='btn btn-primary btn-borrar-logo' id='btn-borrar-logo-oculto-destacado-"+ objetoLogo.nombre +"'><span id='btn-borrar-logo-oculto-destacado-"+ objetoLogo.nombre +"' class='glyphicon glyphicon-trash'></span></button></div></div>");
                    $(".logo-oculto-destacado-"+ objetoLogo.nombre).css("background-image",'url(' + "data:image/png;base64," + objetoLogo.imagen + ')');
                } else {
                    $("#ctnr-logos-ocultos-secundarios").append("<div class='ui-state-default'><div id='"+ objetoLogo.nombre +"' class='logo-oculto-secundario-"+ objetoLogo.nombre +"'><a href='"+ objetoLogo.link +"'><button class='btn btn-primary btn-redireccion'><span class='glyphicon glyphicon-globe'></span></a><button class='btn btn-primary btn-borrar-logo' id='btn-borrar-logo-oculto-secundario-"+ objetoLogo.nombre +"'><span id='btn-borrar-logo-oculto-secundario-"+ objetoLogo.nombre +"' class='glyphicon glyphicon-trash'></span></button></div></div>");
                    $(".logo-oculto-secundario-"+ objetoLogo.nombre).css("background-image",'url(' + "data:image/png;base64," + objetoLogo.imagen + ')');
                }
            })

            // Ocultar Loading //

            setTimeout(function(){ $(".pre-load").css("display","none"); }, 2000);

        },
        error: function() {
            $("#myModalErrorApi").modal();
        },
    });

    //Banner //

    $.ajax({
        url: $.urlCargarBanner,
        type: 'GET',
        success: function(respuesta) {
            $("#preview-imagen-banner").attr("src","data:image/png;base64,"+respuesta.imagen);
            $("#url-banner").val(respuesta.url);
            $("#preview-imagen-banner").css("height",respuesta.alto+"px");
            $("#preview-imagen-banner").css("width",respuesta.ancho+"%");
        },
        error: function() {
        },
    });


    // Guardar Logos //

    $(document).on("click","#btn-guardar",function(){
        $("#btn-guardar").text("");
        $("#btn-guardar > span").remove();
        $("#btn-guardar").append("<img class='btn-loading' src='./assets/css/img/three-dots.svg' alt='loading svg'>");

        $.dataImg = [];
        $("div[class*='logo-").each(function(){
            var bg = $(this).css('background-image');
            bg = bg.replace('url(','').replace(')','');
            var bgInicio = bg.substr(bg.indexOf(",") + 1);
            var bgLargo = bgInicio.length - 1;
            $.dataImg.push(bg.substr(bg.indexOf(",") + 1,bgLargo));
        });

        $.esDestacado = [];
        $.estaOculto = [];
        $("div[class*='logo-']").each(function(){
            var clase = $(this).attr("class");
            if(clase.includes("oculto") && clase.includes("destacado")){
                $.esDestacado.push("true");
                $.estaOculto.push("true");
            } else if (clase.includes("oculto") && clase.includes("secundario")){
                $.esDestacado.push("false");
                $.estaOculto.push("true");
            } else if (clase.includes("destacado")){
                $.esDestacado.push("true");
                $.estaOculto.push("false");
            }
        });

        $.direccionesHref = [];
        $(".btn-redireccion a").each(function(){
            $.direccionesHref.push($(this).attr("href"));
        });

        console.log($.direccionesHref);

        $.nombreLogo = [];
        $("div[class*='logo-']").each(function(){
            $.nombreLogo.push($(this).attr("id"));
        })

        for(i = 0; i < $.logosBorrados.length; i++){
            $.ajax({
                url: $.urlBorrarLogos + $.token,
                type: 'POST',
                data:  '[{\"nombre\" : ' + '"' + $.logosBorrados[i] + '"' + '}]',
                success: function() {
                    setTimeout(function(){ location.reload(); }, 2000);
                },
                error: function() {
                },
            });
        }

        $.altoBanner = $("#preview-imagen-banner").css("height");
        $.anchoBanner = $("#preview-imagen-banner").width() / $("#preview-imagen-banner").parent().width() * 100;
        $.srcBanner = $("#preview-imagen-banner").attr("src");
        $.urlBanner = $("#url-banner").val();

        var bg = $.srcBanner;
        bg = bg.replace('url(','').replace(')','');
        var bgInicio = bg.substr(bg.indexOf(",") + 1);
        var bgLargo = bgInicio.length - 1;
        $.srcBannerFinal = bg.substr(bg.indexOf(",") + 1,bgLargo);

        $.ajax({
            url: $.urlGuardarBanner + $.token,
            type: 'POST',
            data:  '{"imagen" : ' + '"' + $.srcBannerFinal + '"' + ',"ancho" : ' + '"' + $.anchoBanner + '"' + ',"url" : ' + '"' + $.urlBanner + '"' + '"alto" : ' + '"' + $.altoBanner + '"' + ' }',
            success: function() {
                setTimeout(function(){ location.reload(); }, 2000);
            },
            error: function() {
            },
        });

        for(i = 0; i < $.esDestacado.length; i++){
            $.ajax({
                url: $.urlGuardarLogos + $.token,
                type: 'POST',
                data:  '[{"posicion" : ' + '"' + (i+1) + '"' + ',"imagen" : ' + '"' + $.dataImg[i] + '"' + ', "destacado" : ' + $.esDestacado[i] + ', "nombre" : ' + '"' + $.nombreLogo[i] + '"' + ', "oculto" : ' + $.estaOculto[i] + ', "link" : ' + '"' + $.direccionesHref[i] + '"' + '}]',
                success: function() {
                    setTimeout(function(){ location.reload(); }, 2000);
                },
                error: function() {
                    $("#myModalErrorApi").modal();
                },
            });
        }
    });

    // Reset de campos en el modal para crear logos //

    $(document).on("click","#btn-cancelar-logo",function(){
        $("#txt-nombre-empresa").val("");
        $("#txt-pagina-web").val("");
        $("#txt-prioridad-logo").val("");
        $("#img-cropeada").css("background-image","url(./assets/css/img/logos/nuevo-logo-destacado.png)");
    });

    // Refrescar página debido a un error //

    $(document).on("click","#btn-refrescar-web",function(){
        location.reload(); 
    });
});