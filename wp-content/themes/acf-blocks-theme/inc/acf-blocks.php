<?php

// wp-config.php
define('ENV', 'development');
if (ENV == 'development') {
    define('FILE_MIN', '');
} else {
    define('FILE_MIN', '.min');
}

// functions.php
define('TEMPLATE_PATH', get_template_directory() . '/');
define('TEMPLATE_URI', get_template_directory_uri() . '/');
define('DIST', 'dist/');
define('DIST_STYLES', DIST . 'styles/');
define('DIST_SCRIPTS', DIST . 'scripts/');

// main block & parts paths
define('BLOCKS', 'blocks/');
define('PARTS', 'parts/');

// default block category
define('DEFAULT_BLOCK_CATEGORY_TITLE', __('ACF Blocks'));
define('DEFAULT_BLOCK_CATEGORY_SLUG', 'acf-blocks');


function register_acf_block_types() {

    $directory = new \RecursiveDirectoryIterator(TEMPLATE_PATH.BLOCKS, \FilesystemIterator::FOLLOW_SYMLINKS);
    $filter = new \RecursiveCallbackFilterIterator($directory, function ($current, $key, $iterator) {
        
        // Skip hidden files and directories.
        if ($current->getFilename()[0] === '.') return FALSE;
        
        // is dir
        if ($current->isDir()) {
            return true;
        } else {
            // get only '*.block.php' files
            return strpos($current->getFilename(), 'block.php');
        }
    });

    $files = new \RecursiveIteratorIterator($filter);
    foreach ($files as $file) {
        $block_name          = str_replace('.block.php', '', $file->getfileName());
        $style_filename     = $block_name . FILE_MIN . '.css';
        $script_filename    = $block_name . FILE_MIN . '.js';

        // get styles & scripts if any
        $style_file = file_exists(TEMPLATE_PATH.DIST_STYLES . $style_filename) ? TEMPLATE_URI.DIST_STYLES . $style_filename : "";
        $script_file = file_exists(TEMPLATE_PATH.DIST_SCRIPTS . $script_filename) ? TEMPLATE_URI.DIST_SCRIPTS . $script_filename : "";

        $block = get_file_data(
            $file->getPathname(),
            array(
                'name'              => 'Name',
                'title'             => 'Title',
                'description'       => 'Description',
                'category'          => 'Category',
                'icon'              => 'Icon',
                'keywords'          => 'Keywords',
                'mode'              => 'Mode',
                
                'align'             => 'Align',
                /*
                'post_types'        => 'PostTypes',
                'supports_align'    => 'SupportsAlign',
                'supports_mode'     => 'SupportsMode',
                'supports_multiple' => 'SupportsMultiple',
                'supports_anchor'   => 'SupportsAnchor',
                'enqueue_style'     => 'EnqueueStyle',
                'enqueue_script'    => 'EnqueueScript',
                'enqueue_assets'    => 'EnqueueAssets',*/
                //'render_template'   => str_replace(TEMPLATE_PATH, '', $file->getPathname())
            )
        );
       $block['render_template'] = $file->getPathname();
       $block['mode'] = 'auto';
       $block['align'] = 'full';
       $block['category'] = (trim($block['category']) != "") ? trim($block['category']) : DEFAULT_BLOCK_CATEGORY_SLUG;
       $blocks[] = $block;

       //print_r($blocks);
    }

    // register found blocks
    foreach($blocks as $key => $block) {
        acf_register_block_type($block);
    }
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

function the_block_part($block_part_name, $data) {
    echo get_block_part($block_part_name, $data);
}

function get_block_part($block_part_name, $data) {
    ob_start();
    include( TEMPLATE_PATH.PARTS.$block_part_name.".part.php" );
    $part_content = ob_get_contents();
    ob_end_clean();
    return $part_content;
}



function filter_attr($data) {

    // $attributes must be an array
    if ( ! isset($data['attr']) && ! is_array(@$data['attr']))
        return;

    $return = array();

    foreach ($data['attr'] as $key => $val ) {

        $key = trim($key);

        // TODO
        // html encode $val

        // make class attr ready
        if ($key == 'class') {
            if (is_array($val)) {
                $classes = implode(' ', array_filter($val));
                $return['class'] = 'class="'.$classes.'"';
            }
            if (is_string($val) && trim($val) != '') {
                $return['class'] = 'class="'.trim($val).'"';
            }
        } 
        else

        // make style attribute ready
        if ($key == 'style') {
            if (is_array($val)) {
                $styles = implode('; ', array_filter($val));
                $styles = preg_replace('/;+/', ';', trim($styles).';');
                $styles = preg_replace('/\s*:\s*/', ': ', $styles);
                $return['style'] = 'style="'.$styles.'"';
            }
            if (is_string($val) && trim($val) != '') {
                $styles = preg_replace('/\s*;+\s*/', '; ', trim($val).';');
                $styles = preg_replace('/\s*:\s*/', ': ', trim($styles));
                $return['style'] = 'style="'.$styles.'"';
            }
        } 
        else 

        // any other attribute (must be a string)
        if (is_string($val) && trim($val) != '')
        {
            $return[$key] = $key.'="'.trim($val).'"';
        }

    }

    if (!empty($return)) {
        return ' ' . implode(' ', $return);
    }

    return '';
}


function my_plugin_block_categories( $categories, $post ) {
    
    if ( $post->post_type !== 'post' ) {
        return $categories;
    }
    return array_merge(
        $categories,
        array(
            array(
                'slug' => DEFAULT_BLOCK_CATEGORY_SLUG,
                'title' => DEFAULT_BLOCK_CATEGORY_TITLE,
                'icon'  => 'wordpress',
            ),
        )
    );
}
add_filter( 'block_categories', 'my_plugin_block_categories', 10, 2 );