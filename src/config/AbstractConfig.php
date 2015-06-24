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
        $this->config = new Config($config);
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
}
