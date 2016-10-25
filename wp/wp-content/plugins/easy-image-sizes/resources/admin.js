$eis = jQuery.noConflict();

$eis(document).ready(function() {
    
     if($eis('#easy_image_sizes_cropped').val() == 'Yes') {
         
         $eis('.easy_image_sizes_advanced').show();
         
     }
     
     
     $eis('#easy_image_sizes_cropped').change(function() {
         
         $eis('.easy_image_sizes_advanced').toggle();
         
     });

});