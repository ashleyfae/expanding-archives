<?php
/**
 * PHPUnit Bootstrap
 *
 * @package   expanding-archives
 * @copyright Copyright (c) 2022, Ashley Gibson
 * @license   GPL2+
 */

$testsDir = getenv('WP_TESTS_DIR') ? : '/tmp/wordpress-tests-lib';
require_once $testsDir.'/includes/functions.php';

require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';

/**
 * Load plugin files.
 */

tests_add_filter('muplugins_loaded', function () {
    require dirname(__FILE__).'/../expanding-archives.php';
});

// Start up the WP testing environment.
require $testsDir.'/includes/bootstrap.php';

activate_plugin('expanding-archives/expanding-archives.php');
