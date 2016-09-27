<!-- All the files that are required -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='./assets/css/login.css' rel='stylesheet' type='text/css'>
<script src="./assets/js/login.js"></script>

<img class="img-login" alt="Zona Jobs" src="./assets/css/img/logos/banner-zona-jobs.png">

<!-- LOGIN FORM -->
<div class="text-center" style="padding:50px 0">
	<div class="logo">Iniciar Sesión</div>
	<div class="login-form-1">
		<form id="login-form" class="text-left">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="username" class="sr-only">Nombre de Usuario</label>
						<input type="text" class="form-control" id="username" name="lg_username" placeholder="Nombre de Usuario">
					</div>
					<div class="form-group">
						<label for="password" class="sr-only">Contraseña</label>
						<input type="password" class="form-control" id="password" name="lg_password" placeholder="Contraseña">
					</div>
				</div>
				<button type="button" class="login-button" id="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
		</form>
	</div>
</div>

<!-- Modal Error en la Login-->
<div id="myModalErrorLogin" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Usuario o Contraseña incorrectos</h4>
            </div>
            <div class="modal-body">
                <p>Se han ingresado mal los datos para el inicio de sesión.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn-refrescar-web">Aceptar</button>
            </div>
        </div>
    </div>
</div>