<?php

namespace Tests;

use HierarchicalConfig\Config\FileConfig;

/**
 * Class GenericConfigFunctionalTest
 * @package tests
 */
class FileConfigFunctionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function setUp()
    {

    }

    /**
     *
     */
    public function testLoadFile()
    {
        $fileConfig =
            new FileConfig(
                array(
                    FileConfig::CONFIG_KEY_FILE_PATH => $this->getTestConfigDirectory()
                )
            );

        self::assertEquals($fileConfig->getConfiguredValue('test', null, true), true);
    }


    /**
     *
     */
    public function testMissingFile()
    {
        $fileConfig =
            new FileConfig(
                array(
                    FileConfig::CONFIG_KEY_FILE_PATH => $this->getTestConfigDirectory() . 'xyz'
                )
            );

        self::assertEquals($fileConfig->getConfiguredValue('test', null, true), null);
    }

    /**
     * @return string
     */
    protected function getTestConfigDirectory()
    {
        return PHPUNIT_TEST_DIR . '/config/';
    }
}
