<?php
/**
 * Created by PhpStorm.
 * User: brians
 * Date: 6/24/15
 * Time: 4:49 PM
 */

namespace tests;

use HierarchicalConfig\Config\GenericConfig;

class Test extends \PHPUnit_Framework_TestCase {

    public function testNewTest()
    {
        $config = new GenericConfig(array('test' => true));
        $value = $config->getConfiguredValue('test', null, false);

        self::assertEquals($value, true);
    }
}
 