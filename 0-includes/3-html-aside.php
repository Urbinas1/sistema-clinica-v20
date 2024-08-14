<aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidebar">

  <a href="../m-dashboard/index.php" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo $appName; ?></span>
  </a>


  <div class="sidebar">

    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>


    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-header">MODULOS</li>

        <li class="nav-item">
          <a href="../m-dashboard/index.php" class="nav-link <?php echo $moduleSelectName === 'dashboard'  ? 'active' : '';  ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../m-invoice/index.php" class="nav-link <?php echo $moduleSelectName === 'invoice'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-invoice-40.png" >
            <p>
              Facturacion
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../m-cat-ate/index.php" class="nav-link <?php echo $moduleSelectName === 'cateate'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-hospital-40.png" >
            <p>
              Atencion De Emergencia
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../m-medicinas/index.php" class="nav-link <?php echo $moduleSelectName === 'medicinas'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-pills-40.png" >
            <p>
              Medicamentos             
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../m-materiales/index.php" class="nav-link <?php echo $moduleSelectName === 'materiales'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-operating-room-40.png" >
            <p>
            Materiales Quirurgicos           
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../m-hospitalizacion/index.php" class="nav-link <?php echo $moduleSelectName === 'hospitalizacion`'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-hospital-40 (1).png" >
            <p>
           hospitalizacion          
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../m-sala_cuna/index.php" class="nav-link <?php echo $moduleSelectName === 'sala_cuna`'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-cuarto-de-hospital-40.png" >
            <p>
           Sala Cuna          
            </p>
          </a>
        </li>



        <li class="nav-item">
          <a href="../m-clientes/index.php" class="nav-link <?php echo $moduleSelectName === 'clientes'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-sick-40.png" >
            <p>
              Pacientes             
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="../m-doctores/index.php" class="nav-link <?php echo $moduleSelectName === 'doctores'  ? 'active' : '';  ?>">
          <img src="../dist/img/icons8-conversation-40.png" >
            <p>
              Doctores             
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="../m-usuarios/index.php" class="nav-link <?php echo $moduleSelectName === 'usuarios'  ? 'active' : '';  ?>">
            <i class="nav-icon fa fa-users"></i>
            <p>
              USUARIOS             
            </p>
          </a>
        </li>


        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              modulo4
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../m-modulo1/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inbox</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../m-modulo1/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Compose</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../m-modulo1/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Read</p>
              </a>
            </li>
          </ul>
        </li> -->
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              modulo5
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../m-modulo1/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../m-modulo1/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="../m-modulo1/index.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>E-commerce</p>
              </a>
            </li>

          </ul>
        </li> -->

      </ul>
    </nav>
  </div>
</aside>