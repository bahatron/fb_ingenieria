<?php

global $FBIngenieria;
var_dump($_POST);
$projectList = $FBIngenieria->getProjectList();
$clientList = $FBIngenieria->getClientList();
var_dump($projectList);
var_dump($clientList);
switch ($_POST['submit']) {
  case 'Actualizar':
    $selectedProject = $FBIngenieria->getProjectById($_POST['id']);
    break;
  
  case 'Modificar':
    $FBIngenieria->updateProject($_POST);
    break;

  case 'Crear':
    $FBIngenieria->createProject($_POST);
    break;

  default:
    break;
}
?>
  <div class="wrap">
    <form action="" method="POST" onsubmit="return getDataId(this.elements['findByName'])" name="getProject">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Proyecto ya registrado </label></th>
            <td>
              <input name="name" id="findByName" list="clients" value="<?php echo $selectedProject->name ?>" class="regular-text" type="text"
                style="width: 100%" onchange="getDataId(this)">
              <datalist id="clients">
                <?php
                foreach ($projectList as $project) {
                    ?>
                  <option data-id="<?php echo $project->id ?>" value="<?php echo $project->name ?>">
                    <?php 
                } ?>
              </datalist>
              <input type="hidden" name="id" id="clientID" value="">
              <p class="description" id="website-description">Actualiza la informacion de un proyecto</p>
            </td>
          </tr>
        </tbody>
      </table>
      <?php submit_button('Actualizar'); ?>
    </form>
    <hr>
    <form action="" method="POST" name="manageProject">
      <input type="hidden" name="id" value="<?php echo $selectedProject->id ?>">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Nombre: </label></th>
            <td>
              <input name="name" id="name" value="<?php echo $selectedProject->name ?>" class="regular-text" type="text" required>
              <p class="description" id="website-description">Nombre del proyecto</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="shortDescription">Ficha tecnica: </label></th>
            <td>
              <input name="shortDescription" id="shortDescription" value="<?php echo $selectedProject->shortDescription ?>" class="regular-text" type="text">
              <p class="description" id="shortDescription">Descripcion breve del proyecto, maximo 160 caracteres</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="longDescription">Descripcion: </label></th>
            <td>
              <textarea name="longDescription" rows="5" cols="50" maxlength="1000"><?php echo $selectedProject->longDescription ?></textarea>
              <p class="description" id="longDescription">Descripcion completa del proyecto, maximo 1000 caracteres</p>
            </td>
          </tr>
          <tr scrope="row" <?php empty($clientList) ? printf('style="display: none;"') : null ?>>
            <th scope="row"><label for="client">Cliente: </label></th>
            <td>
              <fieldset>
                <select>
                  <option value=""></option>
                  <?php
                    foreach ($clientList as $client) {
                        ?>
                      <option value="<?php echo $client->id ?>" <?php $selectedProject->client_id === $client->id ? printf('selected') : null  ?>><?php echo $client->name ?></option>
                      <?php

                    }
                  ?>
                </select>
                <p class="description" id="tagline-description">Escoga un cliente registrdo</p>
              </fieldset>
            </td>
          </tr>
        </tbody>
      </table>
      <?php 
      if (true) {
          ?>
      <p class="submit">
        <input name="submit" id="submit" class="button button-primary" value="Modificar" type="submit">
        <input name="submit" id="submit" class="button" style="background: #D54E21; border-color: #006799; color: #fff; box-shadow: 0 1px 0 #D54E21;"
          value="Eliminar" type="submit">
      </p>
      <?php

      } else {
          ?>
        <p class="submit">
          <input name="submit" id="submit" class="button button-primary" value="Crear" type="submit">
        </p>
        <?php

      }
      ?>
    </form>
  </div>

  <script>
    function getDataId() {
      input = document.getElementById('findByName');
      for (var i in input.list.options) {
        if (typeof input.list.options[i] == 'object') {
          if (input.value === input.list.options[i].value) {
            document.getElementById('clientID').value = input.list.options[i].getAttribute('data-id');
            return true;
          }
        }
      }
      alert('Proyecto invalido');
      return false;
    }
  </script>