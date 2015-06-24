<?php
namespace HierarchicalConfig\Filter;

/**
 * Interface FilterInterface
 * @package HierarchicalConfig\Filter
 */
interface FilterInterface
{
    /**
     * Transform a given value based on the provided context.
     *
     * @param $context
     * @param $value
     * @return mixed
     */
    public function apply($context, $value);
}