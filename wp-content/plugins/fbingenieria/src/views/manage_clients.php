<?php

global $FBIngenieria;
var_dump($_POST);
$FBIngenieria->proccessClientAction($_POST);
$clientList = $FBIngenieria->getClientList();
$selectedClient = $FBIngenieria->getClientById($_POST['id']);
?>
  <div class="wrap">
    <form action="" method="POST" onsubmit="return getDataId(this.elements['findByName'])" name="getUser">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Cliente ya registrado </label></th>
            <td>
              <input name="name" id="findByName" list="clients" value="<?php echo $selectedClient->name ?>" class="regular-text" type="text" style="width: 100%" onchange="getDataId(this)">
              <datalist id="clients">
                <?php
                foreach ($clientList as $client) {
                    ?>
                  <option data-id="<?php echo $client->id ?>" value="<?php echo $client->name ?>">
                  <?php 
                } ?>
              </datalist>
              <input type="hidden" name="id" id="clientID" value="">
              <p class="description" id="website-description">Actualiza la informacion de un cliente ya registrado</p>
            </td>
          </tr>
        </tbody>
      </table>
      <?php submit_button('Actualizar'); ?>
    </form>
    <hr>
    <!--onsubmit="return confirm('Esta seguro?');"-->
    <form action="" method="POST" name="manageUser">
      <input type="hidden" name="id" value="<?php echo $selectedClient->id ?>">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Nombre: </label></th>
            <td>
              <input name="name" id="name" value="<?php echo $selectedClient->name ?>" class="regular-text" type="text" required>
              <p class="description" id="website-description">Nombre del cliente</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="image">Logo o imagen: </label></th>
            <td>
              <input name="image" id="image" value="<?php echo $selectedClient->imageUrl ?>" class="regular-text" type="text">
              <p class="description" id="image-description">Ejemplo: https://www.w3schools.com/html/pic_mountain.jpg</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="website">Pagina web: </label></th>
            <td>
              <input name="website" id="website" value="<?php echo $selectedClient->websiteUrl ?>" class="regular-text" type="text">
              <p class="description" id="website-description">Ejemplo: http://www.cisco.com/</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="description">Descripcion: </label></th>
            <td>
              <textarea name="description" rows="5" cols="50" maxlength="1000"><?php echo $selectedClient->description ?></textarea>
              <p class="description" id="description-description">Una descripcion del cliente, maximo 1000 caracteres</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="visible">Importante: </label></th>
            <td>
              <fieldset>
                <label for="visible">
                  <input name="visible" id="visible" name="visible" type="checkbox" value="1" <?php ($selectedClient->visible) ? printf('checked') : null ; ?>>
                  Visible
                </label>
              </fieldset>
              <p class="description" id="tagline-description">Si es importante, se vera en la seccion de clientes</p>
            </td>
          </tr>
        </tbody>
      </table>
      <?php ($selectedClient) ? submit_button('Modificar') : submit_button('Crear'); ?>
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