<?php 


kiwi_google_reviews_generate_shortcode($_POST['place_id']);
print('<pre>'.var_dump($data).'</pre>');
die();