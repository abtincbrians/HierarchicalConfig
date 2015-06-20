<?php
namespace HierarchicalConfig\Config;

use HierarchicalConfig\Config\ConfigInterface;
use HierarchicalConfig\Config\GenericConfig;
use HierarchicalConfig\Config\GlobalsConfig;
use HierarchicalConfig\Config\EnvConfig;
use HierarchicalConfig\Config\FileConfig;
use HierarchicalConfig\Config\ConfigBuilder;
use HierarchicalConfig\Writer\Writer;

/**
 * Class ConfigFactory
 * @package HierarchicalConfig\Config
 */
class ConfigFactory
{
    // Hold an instance of the class
    /**
     * @var
     */
    private static $instance;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var ConfigBuilder
     */
    protected $builder;

    // The singleton method
    /**
     * @return ConfigFactory
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param null $context
     * @return ConfigInterface
     */
    public function getConfig($context = null)
    {
        return $this->getBuilder()->build($context);
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param ConfigBuilder $builder
     * @return $this
     */
    public function setBuilder($builder)
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * @return ConfigBuilder
     */
    public function getBuilder()
    {
        if (!isset($this->builder)) {
            $this->builder = new ConfigBuilder();
        }

        return $this->builder;
    }
}