<?php
if (!defined('ABSPATH')) exit;
get_header();
get_template_part('template-parts/documento-individual', null, array('tipo' => 'resultado'));
get_footer();
