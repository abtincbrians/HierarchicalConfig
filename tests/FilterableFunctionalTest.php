<?php
/**
 * Created by PhpStorm.
 * User: brians
 * Date: 6/24/15
 * Time: 4:49 PM
 */

namespace Tests;

use HierarchicalConfig\Stub\Filterable;
use HierarchicalConfig\Filter\Filter;
use HierarchicalConfig\Filter\FilterAlwaysTrue;
use HierarchicalConfig\Filter\FilterAlwaysFalse;

/**
 * Class GenericConfigFunctionalTest
 * @package tests
 */
class FilterableFunctionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $filterable;

    /**
     *
     */
    public function setUp()
    {
        $this->filterable = new Filterable();
    }

    /**
     * Can a filter be added?
     */
    public function testAddFilter()
    {
        $this->filterable->addFilter('test', new Filter());

        self::assertNotEmpty($this->filterable->getFilter('test'));
    }

    /**
     * Is the filter removed?
     */
    public function testRemoveFilter()
    {
        $this->filterable->addFilter('test', new Filter());
        $this->filterable->removeFilter('test');

        self::assertEmpty($this->filterable->getFilter('test'));
    }

    /**
     * Is the filter removed when there are a list of filters?
     */
    public function testRemoveFilterFromFilters()
    {
        $this->filterable->addFilter('a', new Filter(), 1);
        $this->filterable->addFilter('b', new Filter(), 100);
        $this->filterable->addFilter('c', new Filter(), 1000);
        $this->filterable->addFilter('d', new FilterAlwaysFalse(), 10000);
        $this->filterable->removeFilter('d');

        self::assertTrue($this->filterable->applyFilters(null, true));
    }


    /**
     * Test that applyFilter works as expected
     */
    public function testApplyFilter()
    {
        $this->filterable->addFilter('test', new FilterAlwaysTrue());
        self::assertTrue($this->filterable->applyFilter('test', null, false));
    }

    /**
     * Test that clear filters works as expected
     */
    public function testClearFilters()
    {
        $this->filterable->addFilter('test', new FilterAlwaysTrue());
        $this->filterable->clearFilters();
        self::assertFalse($this->filterable->applyFilters(null, false));
    }

    /**
     * Test that applyFilters works
     */
    public function testApplyFilters()
    {
        $this->filterable->addFilter('test', new FilterAlwaysTrue());
        self::assertTrue($this->filterable->applyFilters(null, false));
    }

    /**
     * Test filter priority is being respected.
     */
    public function testApplyFiltersPriority()
    {
        $this->filterable->addFilter('a', new FilterAlwaysTrue(), 10);
        $this->filterable->addFilter('b', new FilterAlwaysFalse(), 11);

        self::assertFalse($this->filterable->applyFilters(null, false));

        $this->filterable->clearFilters();

        $this->filterable->addFilter('a', new FilterAlwaysTrue(), 100);
        $this->filterable->addFilter('b', new FilterAlwaysFalse(), 11);

        self::assertTrue($this->filterable->applyFilters(null, false));
    }
}
 