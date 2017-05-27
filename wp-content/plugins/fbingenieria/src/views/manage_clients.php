<?php

global $FBIngenieria;

var_dump($FBIngenieria->getClientList());

?>
  <div class="wrap">
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