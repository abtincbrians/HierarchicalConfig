<?php
namespace HierarchicalConfig\Filter;

use HierarchicalConfig\Filter\Filter as Filter;

/**
 * Class FilterAlwaysTrue
 * @package HierarchicalConfig\Filter
 */
class FilterAlwaysTrue extends Filter
{
    /**
     * @param $context
     * @param $value
     * @return mixed
     */
    public function apply($context, $value)
    {
        return true;
    }
}