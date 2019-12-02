<?php
/*
 * Simple anchor/link
 */

// filter attributes, if any
$attr = filter_attr($data);

// required
$name  = $data['name'] ? $data['name'] : 'Anchor name missing';
$href  = $data['link'] ? ' href="' . $data['link'] . '"' : '';

?>
<a<?php echo $href.$attr ?>><?php echo $name ?></a>

