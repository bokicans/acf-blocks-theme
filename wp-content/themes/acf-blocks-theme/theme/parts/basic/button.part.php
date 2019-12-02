<?php
$id     = $data['id'] ? ' id="' . trim($data['id']) . '"' : '';
$class  = $data['class'] ? ' class="' . trim($data['class']) . '"' : '';
$tag    = $data['tag'] ? $data['tag'] : 'h2';
$buttons  = $data['buttons'];
$buttons2  = get_field('buttons');

var_dump($buttons);
var_dump($buttons2);

// check if the repeater field has rows of data
if( have_rows('buttons') ):

    // loop through the rows of data
   while ( have_rows('buttons') ) : the_row();

       // display a sub field value
       var_dump( get_sub_field('button') );

   endwhile;

else :

   // no rows found

endif;

?>
<a href="<?php echo $link ?>" class="btn"><?php echo $title ?></a>

