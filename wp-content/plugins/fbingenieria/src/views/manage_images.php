<?php
global $FBIngenieria;
$images = $FBIngenieria->getUploadedMedia();
$projectList = $FBIngenieria->getProjectList();
var_dump($_POST);
function paintRow($row)
{
    ?>
  <tr class="author-self status-inherit">
    <th scope="row" class="check-column">
      <label class="screen-reader-text" for="<?php echo 'cb-select-'.$row['id'] ?>">Select</label>
      <input name="media[]" id="<?php echo 'cb-select-'.$row['id'] ?>" value="<?php echo $row['id'] ?>" type="checkbox">
    </th>
    <td class="title column-title has-row-actions column-primary" data-colname="File">
      <strong class="has-media-icon">
        <span class="media-icon image-icon">
          <?php echo wp_get_attachment_image($row['id']) ?>
        </span>
          <?php echo basename(get_attached_file($row['id'])) ?>
      </strong>
      <div class="row-actions">
        <span class="edit">
          <a href="<?php echo get_site_url().'/wp-admin/post.php?post='.$row['id'].'&amp;action=edit' ?>" aria-label="Edit">
          Edit
          </a>
        </span>
      </div>
    </td>
  </tr>
  <?php

}

function tableHead()
{
    ?>
  <thead>
    <tr>
      <td id="cb" class="manage-column column-cb check-column">
        <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
        <input id="cb-select-all-1" type="checkbox">
      </td>
      <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
        <strong>
          <span>Todos</span>
        </strong>
      </th>
    </tr>
  </thead>
  <?php

}
?>
  <link href="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.css' ?>" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.js' ?>"></script>
  <style lang="scss">
    .tabs__bar>ul {
      overflow:hidden;
    }
  </style>

  <div class="wrap" id="fbi_manage_images">
    <form action="" method="POST" onsubmit="return getDataId()" name="getProject">
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="name">Proyecto ya registrado </label></th>
            <td>
              <input name="name" id="findByName" list="clients" value="<?php echo $selectedProject->name ?>" class="regular-text" type="text"
                style="width: 100%">
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
      <p class="submit">
        <input name="submit" id="submit" class="button button-primary" value="Actualizar" type="submit">
      </p>
    </form>
    <hr>
    <v-tabs id="mobile-tabs-1" grow scroll-bars light>
      <v-tabs-bar slot="activators">
        <v-tabs-item href="#add" ripple>
          Agregar
        </v-tabs-item>
        <v-tabs-item href="#delete" ripple>
          Eliminar
        </v-tabs-item>
        <v-tabs-slider></v-tabs-slider>
      </v-tabs-bar>
      <v-tabs-content id="add">
        <!--ADD TAB-->
        <form action="" method="POST" style="background-color: white">
          <table class="wp-list-table widefat fixed striped media">
          <?php tableHead('') ?>
          <tbody>
            <?php foreach ($images as $img) {
                    paintRow($img);
                } ?>
          </tbody>
        </table>
        <div style="display: flex; flex-direction: row-reverse;">
          <input name="submit" id="submit" value="Agregar" class="button button-primary" type="submit">
        </div>
        </form>
        <!--END ADD TAB-->
      </v-tabs-content>
      <v-tabs-content id="delete">
        <!--DELETE ITEMS TAB-->
        <form action="" method="POST" style="background-color: white">
          <table class="wp-list-table widefat fixed striped media">
          <?php tableHead() ?>
          <tbody>
            <?php foreach ($images as $img) {
                    paintRow($img);
                } ?>
          </tbody>
        </table>
        <div style="display: flex; flex-direction: row-reverse;">
          <input name="submit" id="submit" value="Eliminar" onclick="return confirm('Esta seguro que quiere continuar con esta accion?')" class="button" type="submit">
        </div>
        </form>
        <!--END DELETE ITEMS TAB-->
      </v-tabs-content>
    </v-tabs>
  </div>

  <script>
    new Vue({
      el: '#fbi_manage_images',
    })

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