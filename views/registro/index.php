<?php require('views/header.php'); ?> 
<br>

<div class="grid-container">
<!-- Formulario de Registro de Usuarios -->
  <div class="grid-x align-center">
    <div class="cell small-12 medium-8 large-6 translucent-form-overlay">
      <form action="<?php echo constant('URL') ?>registro/createPersonal" method="POST" id="ingresoRegistro">
        <h3>Datos del Postulante (MTC)</h3>
        <label>DNI
          <input type="text" id="dni" name="dni" placeholder="Ingrese DNI" required maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        </label>
        <label>Nombre
          <input type="text" id="nombre" name="nombre">
        </label>
        <label>Apellidos
          <input type="text" id="apellido" name="apellido">
        </label>
        <label>Categoría de Licencia
          <input type="text" id="catLicencia" name="catLicencia" placeholder="Ej: A-I, A-IIa, A-IIb, etc." required>
        </label>
        <label>Fecha de Registro del Psicosomático
          <input type="date" id="fechaPsicosomatico" name="fechaPsicosomatico">
        </label>
        <button type="submit" class="primary button expanded search-button">Registrar</button>
      </form>
    </div>
  </div>

  <br>

  <div class="grid-x">
    <div class="cell small-12">
      <h3 class="title2 text-center callout">Lista de Usuarios</h3>
      <div class="grid-x text-center">
        <table class="stack">
          <thead>
            <tr>
              <th class="text-center">N°</th>
              <th class="text-center">DNI</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Apellidos</th>
              <th class="text-center">Categoría Licencia</th>
              <th class="text-center">Fecha Registro Psicosomático</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_assoc($this->data)){
                  echo "<tr>
                          <td>".$row['idpersonal']."</td>
                          <td>".$row['dni']."</td>
                          <td>".$row['nombre']."</td>
                          <td>".$row['apellido']."</td>
                          <td>".$row['catLicencia']."</td>
                          <td>".$row['fechaPsicosomatico']."</td>
                          <td>
                            <button class='secondary button'>Editar</button>
                          </td>
                        </tr>";
              }
              ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style>
.translucent-form-overlay {
  max-width: 500px;
  width: 100%;
  background-color: rgba(54, 54, 54, 0.8);
  padding: 20px;
  color: #fefefe;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
}

.translucent-form-overlay h3,
.translucent-form-overlay label {
  color: #fefefe;
}

.translucent-form-overlay input {
  color: #333;
}

.translucent-form-overlay input::placeholder {
  color: #8a8a8a;
}
</style>
  <script src="<?php echo constant('URL') ?>public/js/registro.js"></script> 
  <br>
<?php require('views/footer.php'); ?>
