<?php
if (!defined('ABSPATH')) exit;
get_header();
get_template_part('template-parts/arquivo-documentos', null, array('tipo' => 'edital'));
get_footer();
