<nav class="main-header navbar navbar-expand navbar-white navbar-light">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li >
    </li>
    <li> 
    </li>
  </ul>  
  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-dashboard/index.php" class="nav-link">Inicio</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-invoice/index.php" class="nav-link">Facturación</a>
    </li>
  </ul>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-cat-ate/index.php" class="nav-link">Atencion de Emergencia</a>
    </li>
  </ul>
  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-medicinas/index.php" class="nav-link">Medicamentos </a>
    </li>
  </ul>
  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-materiales/index.php" class="nav-link">Materiales Quirurgicos</a>
    </li>
  </ul>
  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-hospitalizacion/index.php" class="nav-link">Hospitalización</a>
    </li>
  </ul>

  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-sala_cuna/index.php" class="nav-link">Sala Cuna</a>
    </li>
  </ul>
  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-clientes/index.php" class="nav-link">Pacientes</a>
    </li>
  </ul>

  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-doctores/index.php" class="nav-link">Doctores</a>
    </li>
  </ul>

  <li class="nav-item d-none d-sm-inline-block">
      <a href="../m-usuarios/index.php" class="nav-link">Usuarios</a>
    </li>
  </ul>



  <ul class="navbar-nav ml-auto">




    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo (!empty($user['photo'])) ? '../recursos/img/' . $user['photo'] : '../recursos/img/user-default.png'; ?>" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?php echo $userLogName; ?></span>
      </a>

      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <li class="user-header bg-primary">
          <img src="<?php echo (!empty($user['photo'])) ? '../recursos/img/' . $user['photo'] : '../recursos/img/user-default.png'; ?>" class="img-circle elevation-2" alt="User Image">

          <p>
            <?php echo $userLogName; ?> - <?php echo $userLogRol; ?>
            <small><?php echo $user['created']; ?></small>
          </p>
        </li>



        <li class="user-footer">

          <a href="../logout.php" class="btn btn-danger float-right">Cerrar sesion</a>
        </li>

      </ul>
    </li>



  </ul>
</nav>