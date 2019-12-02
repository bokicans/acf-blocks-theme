<?php
/*
 * Simple Content part
 */

// filter attributes, if any
$attr = filter_attr($data);

// required
$tag      = @$data['tag'] ? $data['tag'] : 'div';
$content  = @$data['content'];
?>
<<?php echo $tag.$attr ?>>
    <?php echo $content ?>
</<?php echo $tag ?>>
