<?php
namespace HierarchicalConfig\Config;

/**
 * Class AbstractConfig
 * @package HierarchicalConfig\Config
 */
class GenericConfig extends AbstractConfig
{
    const DEFAULT_RETURN = null;

    protected $returnValue = self::DEFAULT_RETURN;

    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return mixed
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        return $this->deferToChild($key, $this->getReturnValue(), $allowOverride);
    }

    /**
     * @param null $returnValue
     * @return $this
     */
    public function setReturnValue($returnValue)
    {
        $this->returnValue = $returnValue;
        return $this;
    }

    /**
     * @return null
     */
    public function getReturnValue()
    {
        return $this->returnValue;
    }
}
