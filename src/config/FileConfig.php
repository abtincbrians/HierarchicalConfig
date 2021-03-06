<?php
namespace HierarchicalConfig\Config;

use HierarchicalConfig\Exception\FileNotFoundException;
use Zend\Stdlib\ArrayUtils;

/**
 * Class FileConfig
 * @package HierarchicalConfig\Config
 */
class FileConfig extends AbstractConfig
{
    /**
     * Configuration key that defines where the file is located.
     */
    const CONFIG_KEY_FILE_PATH = 'configurationFilePath';

    /**
     * @var
     */
    protected $configFilePath;

    /**
     * @var null
     */
    protected $context = null;

    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return mixed
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        $myValue = $this->config->get($key, $default);

        return $this->deferToChild($key, $myValue, $allowOverride);
    }

    /**
     * Reload the configuration from file.
     *
     * Apply this after changing context or the file path.
     */
    public function reload()
    {
        // Rebuild the configuration data
        // Re-init
        $this->init(
            array(
                self::CONFIG_KEY_FILE_PATH   => $this->getConfigFilePath(),
                ConfigInterface::KEY_CONTEXT => $this->getContext(),
            )
        );
    }

    /**
     * @param string $configFilePath
     * @return this
     */
    public function setConfigFilePath($configFilePath)
    {
        $this->configFilePath = $configFilePath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfigFilePath()
    {
        if (!isset($this->configFilePath)) {
            $this->configFilePath = __DIR__ . '/config/';
        }

        return $this->configFilePath;
    }

    /**
     * @param null $context
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @return null
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     *
     * @return array
     */
    protected function readConfigurationFiles()
    {
        $config  = array();

        // Load global configs (configs marked .global)
        foreach (glob($this->getConfigFilePath() . "{,*}.php", GLOB_BRACE) as $filename) {
            if (is_readable($filename)) {
                $tempConfig = include $filename;
                $config     = ArrayUtils::merge($config, $tempConfig);
            }
        }

        return $config;
    }

    /**
     * Override in child if you need to override core config setup.
     *
     * @param array $config
     * @return array
     */
    protected function doSetup($config = array())
    {
        // Catch the configuration file path
        if (isset($config[self::CONFIG_KEY_FILE_PATH])) {
            $this->configFilePath = $config[self::CONFIG_KEY_FILE_PATH];
        } else {
            // Also consider throwing an exception here instead
            // of failing silently
            return $config;
        }

        // Catch the context
        if (isset($config[ConfigInterface::KEY_CONTEXT])) {
            $this->context = $config[ConfigInterface::KEY_CONTEXT];
        }

        return $this->readConfigurationFiles();
    }
}
