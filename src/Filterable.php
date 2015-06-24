<?php
namespace HierarchicalConfig;

use HierarchicalConfig\Filter\FilterInterface;

use HierarchicalConfig\Writer\Writer; // Leave this in place for dev purposes

/**
 * Class Filterable
 * @package HierarchicalConfig
 */
trait Filterable
{
    /**
     * @var array
     */
    protected $priorityMap = array();

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @param string $key
     * @return FilterInterface
     */
    public function getFilter($key)
    {
        return isset($this->filters[$key]) ? $this->filters[$key] : null;
    }

    /**
     * @param $key
     * @param FilterInterface $filter
     * @param int $priority
     * @return $this
     */
    public function addFilter($key, FilterInterface $filter, $priority = 100)
    {
        $this->filters[$key] = $filter;
        $this->addFilterToPriorityMap($key, $priority);

        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function removeFilter($key)
    {
        // Keeping this simple now, just remove from filters, later we can clean up the priority map
        unset($this->filters[$key]);

        return $this;
    }

    /**
     * @param $key
     * @param $context
     * @param $value
     * @return mixed
     */
    public function applyFilter($key, $context, $value)
    {
        $filter = $this->getFilter($key);
        return isset($filter) ? $filter->apply($context, $value) : $value;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @return $this
     */
    public function clearFilters()
    {
        $this->filters = array();

        return $this;
    }

    /**
     * @param $context
     * @param $value
     * @return mixed
     */
    public function applyFilters($context, $value)
    {
        foreach ($this->priorityMap as $priority => $bucket) {
            foreach ($bucket as $index => $key) {
                $value = $this->applyFilter($key, $context, $value);
            }
        }

        return $value;
    }

    /**
     * @param $priority
     * @return $this
     */
    protected function primePriorityMap($priority)
    {
        if (!isset($this->priorityMap[$priority])) {
            $this->priorityMap[$priority] = array();
        }

        return $this;
    }

    /**
     * @param $key
     * @param $priority
     * @return $this
     */
    protected function addFilterToPriorityMap($key, $priority)
    {
        $this->primePriorityMap($priority);
        array_push($this->priorityMap[intval($priority)], $key);

        return $this;
    }
}

