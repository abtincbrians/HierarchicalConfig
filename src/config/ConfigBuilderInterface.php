<?php
namespace HierarchicalConfig\Config;

/**
 * Interface ConfigBuilderInterface
 * @package HierarchicalConfig\Config
 */
interface ConfigBuilderInterface
{
    /**
     * @param array $options
     * @return mixed
     */
    public function build($options = array());
}
