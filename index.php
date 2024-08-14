  <?php
  session_start();
  if (isset($_SESSION['admin'])) {
    header('location: m-dashboard/index.php');
  }
  ?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto Base</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">


    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
      function Notify(title, text, icon, confirmButtonText, iconColor, animation, toast) {
        Swal.fire({
          title: title,
          text: text,
          icon: icon,
          iconColor: iconColor,          
          toast: toast
        });
      }
    </script>


  </head>



  <body class="hold-transition login-page" style="background-color: #33414e;">
    <div class="login-box">
      <div class="card card-outline" style="background-color: #33414e;">




        <div class="card-header text-center" style="background: rgba(72, 84, 96); border-radius: 5px 5px 0px 0px; border:none">
          <a href="#" class="h1" style="color: white;"><small>Catuses | Base</small></a>
        </div>
        <div class="card-body login-card-body" style="background: rgba(72, 84, 96); border-radius: 0px 0px 5px 5px; border:none">
          <p class="login-box-msg" style="color:white">Ingresar Credenciales</p>
          <form action="validarCredenciales.php" method="post">
            <div class="input-group mb-3">
              <input type="text" name="username" class="form-control" placeholder="Usuario" style="background: #3A434D; color: white; border-color: #3A434D ">
              <div class="input-group-append">
                <div class="input-group-text" style="background: #3A434D; color: white; border-color: #3A434D ">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Contraseña" style="background: #3A434D; color: white; border-color: #3A434D ">
              <div class="input-group-append">
                <div class="input-group-text" style="background: #3A434D; color: white; border-color: #3A434D ">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" name="login" class="btn btn-sm btn-block" style="color: white; background: #3FBAE4; border-color: #3FBAE4; ">Entrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php
        if (isset($_SESSION['error'])) {

          echo "
          <script>
            Notify('Error', '".$_SESSION['error']."', 'error', 'fa fa-error', 'fade', 'normal');
          </script> 
          ";

          unset($_SESSION['error']);

        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>


    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="dist/js/adminlte.min.js"></script>



  </body>

  </html>