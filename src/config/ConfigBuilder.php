<?php
namespace HierarchicalConfig\Config;

use HierarchicalConfig\ConfigBuilderInterface;
use HierarchicalConfig\ConfigInterface;
use HierarchicalConfig\GenericInterface;


/**
 * Class ConfigBuilder
 * @package HierarchicalConfig\Config
 */
class ConfigBuilder implements ConfigBuilderInterface
{
    public function build($options = array())
    {
        $config = new GenericConfig($options);

        return $config;
    }
}
