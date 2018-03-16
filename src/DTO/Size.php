<?php

namespace Larakit\Helpers\DTO;

/**
 * Class Size
 * @package Larakit\Helpers\DTO
 */
class Size
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * Size constructor.
     *
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $width
     *
     * @return Size
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param int $height
     *
     * @return Size
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return float
     */
    public function getRatio()
    {
        return $this->width / $this->height;
    }

    /**
     * @param Size $size
     *
     * @return bool
     */
    public function isEqual(Size $size)
    {
        return $this->width === $size->getWidth() && $this->height === $this->getHeight();
    }
}
