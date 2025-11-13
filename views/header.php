<!doctype html>
<html class="no-js" lang="es">

<head class="c callout-2024-06">
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MTC</title>

  <!-- FAVICON -->
  <link rel="shortcut icon" href="<?php echo constant('URL') . 'public/img/favicon.ico'; ?>">

  <!-- FOUNDATION CSS PRINCIPAL -->
  <link rel="stylesheet" href="<?php echo constant('URL') . 'public/foundation/css/foundation.css'; ?>">
  <link rel="stylesheet" href="<?php echo constant('URL') . 'public/foundation/css/foundation-float.css'; ?>">
  <link rel="stylesheet" href="<?php echo constant('URL') . 'public/foundation/css/foundation-prototype.css'; ?>">

  <!-- ICONOS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- VALIDATION CSS -->
  <link rel="stylesheet" href="<?php echo constant('URL') . 'public/css/validation.css'; ?>">

  <!-- JS PRINCIPALES -->
  <script src="<?php echo constant('URL') . 'public/foundation/js/jquery.js'; ?>"></script>
  
  <!-- jQuery UI para autocompletar -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  
  <script src="<?php echo constant('URL') . 'public/foundation/js/foundation.js'; ?>"></script>
  <script src="<?php echo constant('URL') . 'public/js/validation.js'; ?>"></script>
  <script src="<?php echo constant('URL') . 'public/assets/Assets/js/jpaginate.js'; ?>"></script>
</head>

<body>
  <!-- Panel de administración superior -->
  <div class="grid-container-fluid">
    <div class="grid-x">
      <div class="cell">

        <div class="top-bar" id="responsive-menu">
          <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
              <li><a href="<?php echo constant('URL'); ?>registro">Registro Postulante</a></li>
              <li><a href="<?php echo constant('URL'); ?>verificacion1">1 Verificación</a></li>
              <li><a href="<?php echo constant('URL'); ?>verificacion2">2 Verificación</a></li>
              <li><a href="<?php echo constant('URL'); ?>verificacion3">3 Filtro</a></li>
            </ul>
          </div>

          <div class="top-bar-right">
            <ul class="menu">
              <li><a href="<?php echo constant('URL'); ?>login/logout"><i class="fa fa-sign-out-alt"></i> Salir</a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
  <style>
    body {
      background-color: #f4f6f8;
      font-family: "Segoe UI", Roboto, sans-serif;
      margin: 0;
      padding: 0;
    }

    .top-bar {
      background-color: #004d99;
      padding: 0.7rem 1rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .top-bar a {
      color: #141313ff;
      font-weight: 500;
      transition: 0.3s;
    }

    .top-bar a:hover {
      color: #141413ff;
    }

    .top-bar .menu li {
      margin-right: 0.8rem;
    }

    .top-bar-left ul li a {
      font-size: 0.95rem;
      text-transform: uppercase;
    }

    .top-bar-right a i {
      margin-right: 6px;
    }

    /* Contenido general */
    .content-container {
      margin: 2rem auto;
      max-width: 1000px;
      background: #140a0aff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .content-container h1 {
      font-size: 1.6rem;
      color: #004d99;
      border-bottom: 2px solid #110f0fff;
      padding-bottom: 0.5rem;
      margin-bottom: 1.5rem;
    }

    footer {
      text-align: center; 
      padding: 1rem;
      font-size: 0.9rem;
      color: #777;
      margin-top: 2rem;
    }
  </style>
  <script>
    $(document).foundation();
  </script>
</body>

</html>
