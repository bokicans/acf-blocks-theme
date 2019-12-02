<?php
/*
 * Simple Title block part
 */

// filter attributes, if any
$attr = filter_attr($data);

// required
$tag    = $data['tag'] ? $data['tag'] : 'h2';
$title  = $data['title'] ? $data['title'] : 'Title missing';

?>
<<?php echo $tag.$attr ?>><?php echo $title ?></<?php echo $tag ?>>
