$(document).ready(function(){

    // CONEXIONES CON LA API //
    // Traer logos de la base de datos//

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

                if(objetoLogo.destacado == "1" && objetoLogo.oculto == "0"){
                    $("#empresas-destacadas").append("<a href='"+ objetoLogo.link +"'><div class='logo-destacado-"+ objetoLogo.id +"' alt='"+ objetoLogo.nombre +"'><div><p>A <strong id='logo-destacado-'"+objetoLogo.nombre+"likes'>150</strong> personas les gusta esto</p><button class='btn btn-like' id='btn-like'"+objetoLogo.nombre+"><i class='glyphicon glyphicon-thumbs-up'></i> Me gusta</button></div></div></a>");
                    $(".logo-destacado-"+ objetoLogo.id).css("background-image",'url(' + "data:image/png;base64," + objetoLogo.imagen + ')');
                } else if(objetoLogo.destacado == "1" && objetoLogo.oculto == "1"){
                    $("#empresas-colapsadas-destacadas").append("<a href='"+ objetoLogo.link +"'><div class='logo-secundario-"+ objetoLogo.id +"' alt='"+ objetoLogo.nombre +"'></div></a>");
                    $(".logo-secundario-"+ objetoLogo.id).css("background-image",'url(' + "data:image/png;base64," + objetoLogo.imagen + ')');
                } else {
                    $("#empresas-secundarias").append("<a href='"+ objetoLogo.link +"'><div class='logo-secundario-"+ objetoLogo.id +"' alt='"+ objetoLogo.nombre +"'></div></a>");
                    $(".logo-secundario-"+ objetoLogo.id).css("background-image",'url(' + "data:image/png;base64," + objetoLogo.imagen + ')');
                }
            })

            // Ocultar Loading //

            setTimeout(function(){ $(".pre-load").css("display","none"); }, 1200);
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
            $("#banner img").attr("src","data:image/png;base64,"+respuesta.imagen);
            $("#banner > a").attr("href",respuesta.url);
            $("#banner img").css("height",respuesta.alto+"px");
            $("#banner img").css("width",respuesta.ancho+"%");
        },
        error: function() {
        },
    });

    $.auxVideo = 0;
    $(document).on('scroll', function() {
        if( $.auxVideo == 0 && $(this).scrollTop()> 100){
            $(".videos").css("display","block");
            $.auxVideo = 1;    
        }
    });

    $("#btn-ver-mas").on("hide.bs.collapse", function(){
        console.log("abierto");
        $(".btn-ver-mas").html("Ver más<span class='glyphicon glyphicon-menu-down'></span>");
    });
    $("#btn-ver-mas").on("show.bs.collapse", function(){
        console.log("cerrado");
        $(".btn-ver-mas").html("Ver menos<span class='glyphicon glyphicon-menu-up'></span>");
    })
});