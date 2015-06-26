<?php
namespace HierarchicalConfig\Config;

use HierarchicalConfig\Filterable;
use Zend\Config\Config;

/**
 * Class AbstractConfig
 * @package HierarchicalConfig\Config
 */
abstract class AbstractConfig implements ConfigInterface
{
    use Filterable;

    /**
     * @var
     */
    protected $child;

    /**
     * @var
     */
    protected $config;

    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return mixed
     */
    abstract public function getConfiguredValue($key, $default = null, $allowOverride = true);

    /**
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->init($config);
    }

    /**
     * Override in child if you need to override core config setup.
     *
     * @param array $config
     * @return array
     */
    protected function doSetup($config = array())
    {
        return $config;
    }

    /**
     * Override in child if you need to manipulate the starting config.
     *
     * @param array $config
     * @return array
     */
    protected function doPreSetup($config = array())
    {
        return $config;
    }

    /**
     * Override in child if you need to manipulate the final config.
     *
     * @param array $config
     * @return array
     */
    protected function doPostSetup($config = array())
    {
        return $config;
    }

    /**
     * @param ConfigInterface $config
     * @return ConfigInterface
     */
    public function push(ConfigInterface $config)
    {
        $this->child = $config;

        return $this->child;
    }

    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return null
     */
    protected function deferToChild($key, $default = null, $allowOverride = true)
    {
        if (isset($this->child) && $allowOverride) {
            return
                $this->applyFilters(
                    $key,
                    $this->child->getConfiguredValue($key, $default, $allowOverride)
                );
        } else {
            return $this->applyFilters($key, $default);
        }
    }

    /**
     * @param array $config
     */
    protected function init($config = array())
    {
        // Allow pre & post setup operations
        $config = $this->doPreSetup($config);
        $config = $this->doSetup($config);
        $config = $this->doPostSetup($config);

        $this->config = new Config($config);
    }
}
