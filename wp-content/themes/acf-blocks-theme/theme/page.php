<?php
/**
 * Main Page Template
 */

get_header();
the_post();
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1><?php the_title() ?></h1>
            <?php the_content() ?>
        </div>
    </div>
</div>

<?php
get_footer();
