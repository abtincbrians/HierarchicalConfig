<?php
namespace HierarchicalConfig\Config;

/**
 * Class GenericConfig
 * @package HierarchicalConfig\Config
 */
class GenericConfig extends AbstractConfig
{
    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return mixed
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        return $this->deferToChild($key, $this->config->get($key, $default), $allowOverride);
    }
}
