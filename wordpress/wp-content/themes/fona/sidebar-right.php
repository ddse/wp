<?php
/**
 * The sidebar right containing the main widget area.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @license     GPL v2
 */

if (zoo_get_sidebar('right') != 'none') {
    $class = 'col-sm-3';
    ?>
    <aside id="sidebar-right" class="sidebar widget-area col-xs-12 <?php echo esc_attr($class);?>">
        <?php dynamic_sidebar(zoo_get_sidebar('right')); ?>
    </aside>
<?php } ?>