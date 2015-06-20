<?php
namespace HierarchicalConfig\Config;

/**
 * Class EnvConfig
 * @package HierarchicalConfig\Config
 */
class EnvConfig extends AbstractConfig
{
    const DEFAULT_NAMESPACE = 'HCENV_';

    protected $namespace = self::DEFAULT_NAMESPACE;

    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return null|string
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        $myKey   = $this->makeKey($key);
        $myValue = getenv($myKey) ? getenv($myKey) : $default;

        return $this->deferToChild($key, $myValue, $allowOverride);
    }

    /**
     * @param $key
     * @return string
     */
    protected function makeKey($key)
    {
        return $this->getNamespace() . strtoupper($key);
    }

    /**
     * @param string $namespace
     * @return $this
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
}
