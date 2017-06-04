<?php
global $FBIngenieria;
$images = $FBIngenieria->getUploadedMedia();
echo $images;
// var_dump(json_decode($images));
//var_dump(json_encode($images));
/*
var_dump(wp_get_attachment_image(39));
echo wp_get_attachment_image('39');
echo '<br>';
echo wp_get_attachment_url('39');
echo '<br>';
var_dump(wp_get_attachment_image_src(39));
*/

?>
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
<link href="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.css' ?>" rel="stylesheet" type="text/css">
<script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vue.min.js' ?>"></script>
<script src="<?php echo FBINGENIERIA_URL.'/src/assets/dependencies/vuetify.min.js' ?>"></script>

<div class="wrap" data-app id="fbi_manage_images">
  <h6 v-for="item in images">
    {{ item }}
  </h6>
  <v-carousel>
    <v-carousel-item v-for="(item,i) in images" :src="item" :key="i"></v-carousel-item>
  </v-carousel>
</div>

<script>
  var app = new Vue({
    el: '#fbi_manage_images',
    data: {
      images: JSON.parse('<?php echo json_encode($images) ?>')
    }
  })
</script>