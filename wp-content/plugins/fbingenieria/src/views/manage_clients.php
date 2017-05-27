<?php

if ($_POST) {
    $GLOBALS['FBIngenieria']->clients($_POST);
}

?>
  <div class="wrap">
    <form action="" method="POST">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="blogname">Site Title</label></th>
            <td><input name="blogname" id="blogname" value="FB Ingenieria" class="regular-text" type="text"></td>
          </tr>
          <tr>
            <th scope="row"><label for="blogdescription">Tagline</label></th>
            <td><input name="blogdescription" id="blogdescription" aria-describedby="tagline-description" value="Just another WordPress site"
                class="regular-text" type="text">
              <p class="description" id="tagline-description">In a few words, explain what this site is about.</p>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>