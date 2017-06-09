<?php
global $FBIngenieria;
$images = $FBIngenieria->getUploadedMedia();
$projectList = $FBIngenieria->getProjectList();

var_dump(get_site_url());
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
          <a href="<?php echo get_site_url().'/wp-admin/post.php?post='.$row['id'].'&amp;action=edit' ?>" aria-label="Edit">
            <span class="media-icon image-icon">
              <img src="<?php echo $row['url'] ?>" class="attachment-60x60 size-60x60" alt="" srcset="<?php echo $row['url'] ?> 100w" sizes="100vw" height="60" width="60">
            </span>
            <?php echo 'File ID: '.$row['id'] ?>
          </a>
        </strong>
      <p class="filename">
        <span class="screen-reader-text"><?php echo 'File ID: '.$row['id'] ?></span>
      </p>
      <div class="row-actions">
        <span class="edit">
            <a href="<?php echo get_site_url().'/wp-admin/post.php?post='.$row['id'].'&amp;action=edit' ?>" aria-label="Edit">
            Edit
            </a>
        </span>
      </div>
      <button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
    </td>
  </tr>
  <?php

}

?>
  <link href="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.css' ?>" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.js' ?>"></script>

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
        <table class="wp-list-table widefat fixed striped media">
          <thead>
            <tr>
              <td id="cb" class="manage-column column-cb check-column">
                <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                <input id="cb-select-all-1" type="checkbox">
              </td>
              <th scope="col" id="title" class="manage-column column-title column-primary sortable desc">
                <span>Seleccionar todos</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($images as $img){
              paintRow($img);
            } ?>
          </tbody>
        </table>
        <!--END ADD TAB-->
      </v-tabs-content>
      <v-tabs-content id="delete">
        eliminar eliminar
      </v-tabs-content>
    </v-tabs>
  </div>

  <script>
    new Vue({
      el: '#fbi_manage_images',
      data: {
        addedMedia: JSON.parse('<?php echo json_encode($images) ?>'),
        projectList: JSON.parse('<?php echo json_encode($projectList) ?>'),
        tableData: null
      },
      mounted: function () {
        this.tableData = this.getTableData();
        console.log(this.tableData);
      },
      methods: {
        getTableData: function () {
          var array = [];
          this.addedMedia.forEach(function (item, index) {
            console.log('item', item);
            array.push({
              selected: false,
              id: item.id,
              url: item.url
            });
          });
          return array;
        }
      }
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