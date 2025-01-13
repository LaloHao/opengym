<?php
function render($filename, $replacements): void {
    $template = file_get_contents($filename);
    echo strtr($template, $replacements);
}

function render_html_header($page_name) {
    render('header.html', array('{page_name}' => $page_name));
}

const NavItems = array(
    'dashboard' => 'Dashboard',
    'clients' => 'Clientes',
    'reports' => 'Reportes',
    'logout' => 'Cerrar sesion'
);

function render_menu($current_item) {
    include_once('menu.php');
}