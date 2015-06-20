<?php
namespace HierarchicalConfig\Writer;

/**
 * Interface WriterInterface
 * @package HierarchicalConfig\Writer
 */
interface WriterInterface
{
    /**
     * @param $value
     * @param string $newline
     * @return mixed
     */
    public static function write($value, $newline = PHP_EOL);
}
