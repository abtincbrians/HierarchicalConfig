<?php
namespace HierarchicalConfig\Config;

/**
 * Interface ConfigBuilderInterface
 * @package HierarchicalConfig\Config
 */
interface ConfigBuilderInterface
{
    /**
     * @param null $context
     * @return mixed
     */
    public function build($context = null);
}
