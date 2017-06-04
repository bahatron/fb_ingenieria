<?php
global $FBIngenieria;
$images = $FBIngenieria->getUploadedMedia();
$projectList = $FBIngenieria->getProjectList();
?>
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
  <link href="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.css' ?>" rel="stylesheet" type="text/css">
  <script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vue.min.js' ?>"></script>
  <script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.js' ?>"></script>

  <div class="wrap" data-app id="fbi_manage_images">
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
        agregar agregar
      </v-tabs-content>
      <v-tabs-content id="delete">
        eliminar eliminar
      </v-tabs-content>
    </v-tabs>
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
    var app = new Vue({
      el: '#fbi_manage_images',
      data: {
        addedMedia: JSON.parse('<?php echo $images ?>'),
        projectList: JSON.parse('<?php echo json_encode($projectList) ?>')
      }
    })
  </script>