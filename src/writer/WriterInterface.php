<?php
namespace HierarchicalConfig\Writer;

/**
 * Interface WriterInterface
 * @package HierarchicalConfig\Writer
 */
Interface WriterInterface
{
    /**
     * @param $value
     * @param string $newline
     * @return mixed
     */
    public static function write($value, $newline = PHP_EOL);
}
