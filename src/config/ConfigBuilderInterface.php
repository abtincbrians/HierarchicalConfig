<?php
namespace HierarchicalConfig\Config;

use HierarchicalConfig\Config\ConfigInterface;
/**
 * Interface ConfigBuilderInterface
 * @package HierarchicalConfig\Config
 */
interface ConfigBuilderInterface
{
    /**
     * @param array $options
     * @return ConfigInterface
     */
    public function build($options = array());
}
