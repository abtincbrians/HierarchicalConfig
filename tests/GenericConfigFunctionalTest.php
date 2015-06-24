<?php
/**
 * Created by PhpStorm.
 * User: brians
 * Date: 6/24/15
 * Time: 4:49 PM
 */

namespace tests;

use HierarchicalConfig\Config\GenericConfig;
use HierarchicalConfig\Filter\Filter;
use HierarchicalConfig\Filter\FilterAlwaysTrue;

class GenericConfigFunctionalTest extends \PHPUnit_Framework_TestCase {

    public function testGenericConfigReturnsDefault()
    {
        $config = new GenericConfig(array('test' => false));
        $value = $config->getConfiguredValue('a', true);

        self::assertEquals($value, true);
    }

    public function testGenericConfigAbidesByAllowOverrideFalse()
    {
        $config = new GenericConfig(array('test' => false));
        $value = $config->getConfiguredValue('test', true, false);

        self::assertEquals($value, false);
    }

    public function testGenericConfigReturnsTrue()
    {
        $config = new GenericConfig(array('test' => true));
        $value = $config->getConfiguredValue('test');

        self::assertEquals($value, true);
    }

    public function testGenericConfigStackReturnsTrue()
    {

        $config = new GenericConfig(array('test' => false));

        $config
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => true)));

        $value = $config->getConfiguredValue('test');

        self::assertEquals($value, true);
    }

    public function testFilteredGenericConfigReturnsTrue()
    {
        $config = new GenericConfig(array('test' => false));
        $filter = new FilterAlwaysTrue();

        $config->addFilter('always.true', $filter);

        $value = $config->getConfiguredValue('test');

        self::assertEquals($value, true);
    }

    public function testFilteredGenericConfigStackReturnsTrue()
    {
        $config = new GenericConfig(array('test' => false));
        $filter = new FilterAlwaysTrue();

        $config
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => false)))
            ->push(new GenericConfig(array('test' => false)));

        $config->addFilter('always.true', $filter);

        $value = $config->getConfiguredValue('test');

        self::assertEquals($value, true);
    }
}
 