<?php
namespace HierarchicalConfig\Filter;

use HierarchicalConfig\Filter\FilterInterface as FilterInterface;

/**
 * Class Filter
 * @package HierarchicalConfig\Filter
 */
class Filter implements FilterInterface
{
    /**
     * @param $context
     * @param $value
     * @return mixed
     */
    public function apply($context, $value)
    {
        return $value;
    }
}