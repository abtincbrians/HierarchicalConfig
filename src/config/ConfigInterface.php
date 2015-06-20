<?php
namespace HierarchicalConfig\Config;

/**
 * Interface ConfigInterface
 * @package HierarchicalConfig\Config
 */
interface ConfigInterface
{
    const KEY_CONTEXT = 'context';

    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return mixed
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true);

    /**
     * @param ConfigInterface $config
     * @return mixed
     */
    public function push(ConfigInterface $config);
}
