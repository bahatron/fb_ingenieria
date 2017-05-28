<?php

global $FBIngenieria;
var_dump($_POST);
$clientList = $FBIngenieria->getClientList();
var_dump($clientList);
?>
  <div class="wrap">
    <form action="" method="POST" onsubmit="return getDataId(document.getElementById('name'))">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Cliente ya registrado </label></th>
            <td>
              <input name="name" id="name" list="clients" value="" class="regular-text" type="text" style="width: 100%" onchange="getDataId(this)">
              <datalist id="clients">
                <?php
                foreach ($clientList as $client) {
                    ?>
                  <option data-id="<?php echo $client->id ?>" value="<?php echo $client->name ?>">
                  <?php 
                } ?>
              </datalist>
              <input type="hidden" name="id" id="clientID" value="">
              <p class="description" id="website-description">Modifica un cliente registrado anteriormente</p>
            </td>
          </tr>
        </tbody>
      </table>
      <input type="submit" name="Go" value="Submit">
    </form>
    <hr>
    <form action="" method="POST">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Nombre: </label></th>
            <td>
              <input name="name" id="name" value="" class="regular-text" type="text" required>
              <p class="description" id="website-description">Nombre del cliente</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="image">Logo o imagen: </label></th>
            <td>
              <input name="image" id="image" value="" class="regular-text" type="text">
              <p class="description" id="image-description">Ejemplo: https://www.w3schools.com/html/pic_mountain.jpg</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="website">Pagina web: </label></th>
            <td>
              <input name="website" id="website" value="" class="regular-text" type="text">
              <p class="description" id="website-description">Ejemplo: http://www.cisco.com/</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="description">Descripcion: </label></th>
            <td>
              <textarea name="description" rows="5" cols="50" maxlength="500"></textarea>
              <p class="description" id="description-description">Una descripcion del cliente, maximo 500 caracteres</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><label for="active">Importante: </label></th>
            <td>
              <fieldset>
                <label for="active">
                  <input name="active" id="active" name="active" type="checkbox">
                  Visible
                </label>
              </fieldset>
              <p class="description" id="tagline-description">Si es importante, se vera en la seccion de clientes</p>
            </td>
          </tr>
        </tbody>
      </table>
      <?php submit_button('Enviar'); ?>
    </form>
  </div>

  <script>
    function getDataId(input){
      for(var i in input.list.options){
        if(typeof input.list.options[i] == 'object'){
          if(input.value === input.list.options[i].value ) {
            document.getElementById('clientID').value = input.list.options[i].getAttribute('data-id');
          }
        }
      }
    }
  </script>