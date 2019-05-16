<?php

global $FBIngenieria;

switch($_POST['submit']){
  case 'Enviar':
  $FBIngenieria->setRecieverMailer($_POST['mail']);
  break;
  
  default:
  break;
}

$mailer = $FBIngenieria->getRecieverMailer();
?>

  <div class="wrap">
    <form action="" method="POST" name="generalSettings">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Correo de contacto: </label></th>
            <td>
              <input name="mail" id="mail" value="<?php echo $mailer ?>" class="regular-text" type="email" required>
              <p class="description" id="website-description">Establece a que correo llegaran los mensajes de contacto</p>
            </td>
          </tr>
        </tbody>
      </table>
      <hr>
      <p class="submit">
        <input name="submit" id="submit" class="button button-primary" value="Enviar" type="submit">
      </p>
    </form>
  </div>