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
    public function build($context = null)
    {
        if (isset($context)) {
            $this->options[ConfigInterface::KEY_CONTEXT] = $context;
        }

        $config = new GenericConfig($this->getOptions());

        return $config;
    }
}
