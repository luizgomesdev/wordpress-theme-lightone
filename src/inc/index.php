<?php

$filtersDIR = get_template_directory() . '/src/inc/filters';
$actionsDIR = get_template_directory() . '/src/inc/actions';
$generalDIR = get_template_directory() . '/src/inc/general';

$classesDIR = get_template_directory() . '/src/classes';

#   Filters
require_once "{$filtersDIR}/admin.php";
require_once "{$filtersDIR}/custom-wp-title.php";
require_once "{$filtersDIR}/page-template-add-subdir.php";

#   Actions
require_once "{$actionsDIR}/load-scripts.php";
require_once "{$actionsDIR}/acf-options-page.php";
require_once "{$actionsDIR}/create-api-post-meta.php";
require_once "{$actionsDIR}/remove-widgets.php";
require_once "{$actionsDIR}/restrict-rest-api.php";
require_once "{$actionsDIR}/theme-support.php";

#   General
require_once "{$generalDIR}/get-reading-time.php";
require_once "{$generalDIR}/get-theme-post-thumnail.php";
require_once "{$generalDIR}/get-theme-custom-logo.php";

#   Classes
require_once "{$classesDIR}/navwalker.php";
require_once "{$classesDIR}/register-custom-post-type.php";
require_once "{$classesDIR}/register-custom-taxonomy.php";
require_once "{$classesDIR}/script-loader.php";
require_once "{$classesDIR}/pagination.php";
