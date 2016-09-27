$(document).ready(function(){

    // Urls para conectar con la API //
    // Las url tienen la siguiente estructura:
    //        "http://direccion-server/api/index.php/...."
    // Siendo /logos/guardar/ el endpoint para guardar los logos creados en la base de datos,
    //        /logos para traer aquellos logos almacenados en la base de datos,
    //        /logos/eliminar/ para eliminar los logos de la base de datos.
    //        /logos/buscar para traer solo aquellos logos que coincidan con la palabra a buscar, o contengan
    // parte de ella, de la base de datos.

    // COOKIES //
    // Las cookies seran eliminadas al transcurrir un dia desde su creación 

    var ip = "belarisdev.com/puertas-adentro/api"
    
    $.urlLogin = "http://" + ip + "/index.php/login";
    $.urlTraerLogos = "http://" + ip + "/index.php/logos";
    $.urlGuardarLogos = "http://" + ip + "/index.php/logos/guardar/";
    $.urlBorrarLogos = "http://" + ip + "/index.php/logos/eliminar/";
    $.urlGuardarBanner = "http://" + ip + "/index.php/banners/cargar/";
    $.urlCargarBanner = "http://" + ip + "/index.php/banners";

});