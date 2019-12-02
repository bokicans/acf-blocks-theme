<?php
/*
Name: test
Title: Test block
Description: Just a test block
Icon: admin-comments
Keywords: test
*/

// basic stuff
$id="test";
$className="classssss";

//print_r($block);

// get fields
$title      = get_field('title');
$subtitle   = get_field('subtitle');
$content    = get_field('content');
$buttons    = get_field('buttons');

//var_dump($buttons);

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php the_block_part("basic/title", ['title' => $title, 'tag' => 'h1']); ?>
    <?php the_block_part("basic/title", ['title' => $subtitle, 'tag' => 'h2']); ?>
    <?php the_block_part("basic/content", ['content' => $content, 'class' => 'content']); ?>
    <?php the_block_part("basic/anchor", ['name' => 'Test link', 'link' => 'https://www.google.com', 'attr' => ['class' => ['test-class', 'btn'], 'title' => 'Test link', 'style' => 'color :red    ;;    text-align :  center;']]); ?>
</div>

