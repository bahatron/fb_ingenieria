<?php
global $FBIngenieria;
$images = $FBIngenieria->getUploadedMedia();
echo $images;
?>
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
<link href="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.css' ?>" rel="stylesheet" type="text/css">
<script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vue.min.js' ?>"></script>
<script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.js' ?>"></script>

<div class="wrap" data-app id="fbi_manage_images">
  <v-tabs id="mobile-tabs-1" grow scroll-bars light>
    <v-tabs-bar slot="activators">
      <v-tabs-item href="#add" ripple >
        Agregar
      </v-tabs-item>
      <v-tabs-item href="#delete" ripple >
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
  var app = new Vue({
    el: '#fbi_manage_images',
    data: {
      addedMedia: JSON.parse('<?php echo $images ?>')
    }
  })
</script>