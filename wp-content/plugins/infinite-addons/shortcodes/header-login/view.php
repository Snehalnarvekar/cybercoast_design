<?php

// Enqueue Conditional Script
$this->scripts();
$this->generate_css();

$located = locate_template( 'templates/header/header-login.php' );
include $located;