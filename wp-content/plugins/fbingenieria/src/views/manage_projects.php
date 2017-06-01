<?php
var_dump(wp_get_attachment_image(39));
echo wp_get_attachment_image('39');
echo '<br>';
echo wp_get_attachment_url('39');
echo '<br>';
var_dump(wp_get_attachment_image_src(39));
global $FBIngenieria;
switch ($_POST['submit']) {
  case 'Actualizar':
    break;
  
  case 'Modificar':
    break;

  case 'Crear':
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
              <input name="name" id="findByName" list="clients" value="<?php echo $selectedProject->name ?>" class="regular-text" type="text" style="width: 100%" onchange="getDataId(this)">
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
              <input type="text" name="shortDescription" id="shortDescription" value="<?php echo $selectedProject->shortDescription ?>">
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
          <tr>
            <th scope="row"><label for="images">Imagenes: </label></th>
            <td>
              <fieldset>
                <label for="visible">
                  <input name="images" id="images" type="checkbox" value="1" <?php ($selectedProject->visible) ? printf('checked') : null ; ?>>
                  Visible
                </label>
              </fieldset>
              <p class="description" id="tagline-description">En construccion</p>
            </td>
          </tr>
        </tbody>
      </table>
      <?php 
      if (true) {
          ?>
        <p class="submit">
          <input name="submit" id="submit" class="button button-primary" value="Modificar" type="submit">
          <input name="submit" id="submit" class="button" style="background: #D54E21; border-color: #006799; color: #fff; box-shadow: 0 1px 0 #D54E21;" value="Eliminar" type="submit">
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
    function getDataId(){
      input = document.getElementById('findByName');
      for(var i in input.list.options){
        if(typeof input.list.options[i] == 'object'){
          if(input.value === input.list.options[i].value) {
            document.getElementById('clientID').value = input.list.options[i].getAttribute('data-id');
            return true;
          }
        }
      }
      alert('Cliente invalido');
      return false;
    }
  </script>