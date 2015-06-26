<?php
/**
 * This is a sample bootstrap. Feel free to modify it for your purposes.
 *
 * Currently, this is being used to autoload the code for use in
 * functional and unit testing. It doesn't do anything else.
 *
 * Well, you do get a warning if you try to
 *
 *
 */
if (is_readable('vendor/autoload.php')) {
    require_once('vendor/autoload.php');
    define('PHPUNIT_TEST_DIR', __DIR__ . '/tests');
} else {
    echo
        PHP_EOL .
        '*******************' . PHP_EOL  .
        '***** WARNING *****' . PHP_EOL .
        '*******************' . PHP_EOL .
        PHP_EOL .
        'Unable to load necessary project files.' . PHP_EOL .
        'This most likely means you did not run composer to install dependencies.' . PHP_EOL .
        'Use `composer install` before your tests will execute.' . PHP_EOL .
        'Unable to load necessary project files.' . PHP_EOL .
        PHP_EOL .
        '*******************' . PHP_EOL .
        '***** WARNING *****' . PHP_EOL .
        '*******************' . PHP_EOL .
        PHP_EOL;
    die();
}