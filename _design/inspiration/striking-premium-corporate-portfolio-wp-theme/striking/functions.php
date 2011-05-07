<?php /* Load the Theme class. */
require_once (TEMPLATEPATH . '/framework/theme.php');

$theme = new Theme();
$theme->init(array(
    'theme_name' => 'Striking', 
    'theme_slug' => 'striking'
));

