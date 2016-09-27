<script type="text/javascript" src="./assets/js/administrador.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        //       Funcion para el crop de la imagen
        var options =
            {
                imageBox: '.imageBox',
                thumbBox: '.thumbBox',
                spinner: '.spinner',
                imgSrc: ''
            }
        var cropper = new cropbox(options);
        document.querySelector('#file').onchange = function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = new cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
        }

        document.querySelector('#btnCrop').addEventListener('click', function(){
            $.imgLogo = cropper.getDataURL();
            $(".img-cropeada").css({
                "background-image":"url("+ $.imgLogo +")",
                "background-position": "center",
                "background-repeat": "no-repeat",
                "background-size":"cover"
            })
        })

        document.querySelector('#btnZoomIn').addEventListener('click', function(){
            cropper.zoomIn();
        })

        document.querySelector('#btnZoomOut').addEventListener('click', function(){
            cropper.zoomOut();
        })
    });

    // Drag and Drop //

    $( function() {
        $( "#ctnr-logos-destacados, #ctnr-logos-ocultos-destacados,#ctnr-logos-ocultos-secundarios" ).sortable({
        }).disableSelection();
    } );

</script>

<section class="container-fluid main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <h3>Empresas Destacadas</h3>
                <ul id="ctnr-logos-destacados" class="ctnr-logos-destacados connectedSortable">

                </ul>
            </div>
            <div class="col-sm-4 col-md-4">
                <h3>Empresas Ocultas</h3>
                <ul id="ctnr-logos-ocultos-destacados" class="ctnr-logos-ocultos-destacados connectedSortable">

                </ul>
            </div>
            <div class="col-sm-4 col-md-4">
                <h3>Empresas Ocultas Secundarias</h3>
                <ul id="ctnr-logos-ocultos-secundarios" class="ctnr-logos-ocultos-secundarios connectedSortable">

                </ul>
            </div>
        </div>
        <button class="btn btn-primary btn-footer-administrador" id="btn-agregar-logo"><span class="glyphicon glyphicon-plus"></span> Agregar Nuevo Logo</button>
    </div>
    <div class="row admin-banner">
        <h2>Administrador Banner</h2>
        <div class="col-sm-6 col-md-6">
            <label for="url-banner">URL BANNER</label>
            <input id="url-banner" class="form-control">
<!--            <button id="btn-seleccionar-url" class="btn btn-primary">Cambiar Imagen</button>-->
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="col-sm-6 col-md-6">
                <input id="alto" class="form-control alto" type="number" placeholder="Alto en px">
                <input id="btn-seleccionar-banner" type="file" class="btn btn-primary">
            </div>
            <div class="col-sm-6 col-md-6">
                <input id="ancho" class="form-control ancho" type="number" placeholder="Ancho en px">
            </div>
        </div>
        <div class="row">
            <img id="preview-imagen-banner" class="preview-imagen-banner">
        </div>
    </div>
</section>


<!-- Modal Agregar Logo -->
<div id="myModalAgregarLogo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="titulo-modal"></h4>
            </div>
            <div class="modal-body">
                <p>Selecciona un logo y una dirección web</p>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="txt-nombre-empresa">Empresa:</label>
                            <input type="text" class="form-control" placeholder="Por ejemplo: avon" id="txt-nombre-empresa" required>
                        </div>
                        <div class="form-group">
                            <label for="txt-pagina-web">Página Web:</label>
                            <input type="url" class="form-control" placeholder="http://www.ejemplo.com.ar" id="txt-pagina-web" required>
                        </div>
                        <div class="form-group">
                            <label for="txt-prioridad-logo">Columna:</label>
                            <select class="form-control" id="txt-prioridad-logo">
                                <option>Empresa Destacada</option>
                                <option>Empresa Oculta Destacada</option>
                                <option>Empresa Oculta Secundaria</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-xs-12">
                        <div class="img-cropeada" id="img-cropeada"></div>
                        <button class="btn btn-default btn-elegir-logo" data-toggle="modal" data-target="#myModalCrop">Elegír logo</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btn-cancelar-logo" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-default" id="btn-aceptar-logo" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para hacer crop -->

<div id="myModalCrop" class="modal fade" role="dialog">
    <div class="modal-dialog" id="modal-crop">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Imagen de fondo</h4>
            </div>
            <div class="modal-body" id="modal-cuerpo-crop">
                <div class="imageBox">
                    <div class="thumbBox"></div>
                    <div class="spinner" style="display: none">Cargar Imagen</div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="action">
                    <input type="file" id="file" style="float:left; width: 250px">
                    <input type="button" id="btnCrop" data-dismiss="modal" value="Crop" style="float: right">
                    <input type="button" id="btnZoomIn" value="+" style="float: right">
                    <input type="button" id="btnZoomOut" value="-" style="float: right">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Logo Destacado-->
<div id="myModalEliminarLogoDestacado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Eliminar Logo</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el logo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-eliminar-logo-destacado">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Logo Oculto Destacado -->
<div id="myModalEliminarLogoOcultoDestacado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Eliminar Logo</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el logo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-eliminar-logo-oculto-destacado">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Logo Oculto Secundario-->
<div id="myModalEliminarLogoOcultoSecundario" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Eliminar Logo</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el logo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-eliminar-logo-oculto-secundario">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error (no se completaron todos los campos)-->
<div id="myModalError" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p>Debes completar todos los campos</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#myModalAgregarLogo">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error en la Api-->
<div id="myModalErrorApi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p>Ha ocurrido un error, por favor presiona en ACEPTAR para refrescar la pagina.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-refrescar-web">Aceptar</button>
            </div>
        </div>
    </div>
</div>