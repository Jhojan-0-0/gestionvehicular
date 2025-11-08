<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <!-- Foundation CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css">

  <style>
    body {
      background-color: #f7f7f7;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .login-container {
      background: white;
      padding: 2rem 3rem;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
      margin-bottom: 1rem;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #1779ba;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      padding: 0.8rem;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #145a86;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>

    <form action="login/logIn" method="POST">
      <label for="usuario">Usuario</label>
      <input type="text" name="usuario" id="usuario" placeholder="Ingrese su usuario" required>

      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password" placeholder="Ingrese su contraseña" required>

      <input type="submit" value="Ingresar">
    </form>
  </div>

  <!-- Foundation JS -->
  <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js"></script>
</body>

</html>
