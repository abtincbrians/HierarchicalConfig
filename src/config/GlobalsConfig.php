<?php
namespace HierarchicalConfig\Config;

use HierarchicalConfig\Config\EnvConfig as EnvConfig;
/**
 * Class GlobalsConfig
 * @package HierarchicalConfig\Config
 */
class GlobalsConfig extends EnvConfig
{
    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return null
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        $myKey   = $this->makeKey($key);
        $myValue = isset($GLOBALS[$myKey]) ? $GLOBALS[$myKey] : $default;

        return $this->deferToChild($key, $myValue, $allowOverride);
    }
}
