<?php
namespace HierarchicalConfig\Config;

use HierarchicalConfig\Config\ConfigInterface;
use HierarchicalConfig\Config\GenericConfig;
use HierarchicalConfig\Config\GlobalsConfig;
use HierarchicalConfig\Config\EnvConfig;
use HierarchicalConfig\Config\FileConfig;
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
        return $this->initConfig($context);
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
     * You need to call setup before using this baby.
     *
     * Override this function to create your application's custom
     * configuration setup
     *
     * @param string $context
     * @return ConfigInterface
     */
    protected function initConfig($context = null)
    {
        if (isset($context)) {
            $this->options[ConfigFactory::KEY_CONTEXT] = $context;
        }

        $config = new GenericConfig($this->getOptions());

        return $config;
    }
}