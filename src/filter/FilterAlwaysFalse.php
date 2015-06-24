<?php
namespace HierarchicalConfig\Filter;

use HierarchicalConfig\Filter\Filter as Filter;

/**
 * Class FilterAlwaysFalse
 * @package HierarchicalConfig\Filter
 */
class FilterAlwaysFalse extends Filter
{
    /**
     * @param $context
     * @param $value
     * @return mixed
     */
    public function apply($context, $value)
    {
        return false;
    }
}