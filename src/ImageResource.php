<?php

namespace Larakit\Helpers;

use Larakit\Helpers\DTO\Size;

/**
 * Class ImageResource
 * @package Larakit\Helpers
 */
class ImageResource
{
    /**
     * @var resource
     */
    private $resource;

    /**
     * @var Size
     */
    private $originalSize;

    /**
     * @var Size
     */
    private $resultSize;

    /**
     * @var int
     */
    private $resultOffsetX;

    /**
     * @var int
     */
    private $resultOffsetY;

    /**
     * @var bool
     */
    private $isCrop;

    /**
     * ImageResource constructor.
     *
     * @param resource $resource
     * @param int      $originalWidth
     * @param int      $originalHeight
     */
    public function __construct($resource, $originalWidth, $originalHeight)
    {
        $this->resource = $resource;
        $this->originalSize = new Size($originalWidth, $originalHeight);
        $this->resultSize = new Size($originalWidth, $originalHeight);
        $this->resultOffsetX = 0;
        $this->resultOffsetY = 0;
        $this->isCrop = false;
    }

    /**
     * @param Size $newSize
     *
     * @return $this
     */
    public function resize(Size $newSize)
    {
        $this->applyChanges();
        $this->isCrop = false;

        $width = min($this->resultSize->getWidth(), $newSize->getWidth());
        $this->resultSize->setHeight((int) round($width / $this->resultSize->getRatio()));
        $this->resultSize->setWidth($width);

        $height = min($this->resultSize->getHeight(), $newSize->getHeight());
        $this->resultSize->setWidth((int) round($height * $this->resultSize->getRatio()));
        $this->resultSize->setHeight($height);

        return $this;
    }

    /**
     * @param Size $newSize
     *
     * @return $this
     */
    public function crop(Size $newSize)
    {
        $this->applyChanges();
        $this->isCrop = true;

        $this->resultOffsetX = (0 - ($newSize->getWidth() - $this->resultSize->getWidth()) / 2);
        $this->resultOffsetY = (0 - ($newSize->getHeight() - $this->resultSize->getHeight()) / 2);
        $this->resultSize = clone $newSize;

        return $this;
    }

    /**
     * @return Size
     */
    public function getResultSize()
    {
        return $this->resultSize;
    }

    /**
     * @return int
     */
    public function getResultOffsetX()
    {
        return $this->resultOffsetX;
    }

    /**
     * @return int
     */
    public function getResultOffsetY()
    {
        return $this->resultOffsetY;
    }

    /**
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Applying changes
     */
    public function applyChanges()
    {
        // nothing to change
        if ($this->originalSize->isEqual($this->resultSize)) {
            return;
        }

        if ($this->isCrop) {
            $destination = imagecrop($this->resource, [
                'x' => $this->resultOffsetX,
                'y' => $this->resultOffsetY,
                'width' => $this->resultSize->getWidth(),
                'height' => $this->resultSize->getHeight(),
            ]);
        } else {
            $destination = imagecreatetruecolor($this->getResultSize()->getWidth(), $this->getResultSize()->getHeight());
            imagecopyresampled(
                $destination,
                $this->resource,
                $this->resultOffsetX,
                $this->resultOffsetY,
                0,
                0,
                $this->resultSize->getWidth(),
                $this->resultSize->getHeight(),
                $this->originalSize->getWidth(),
                $this->originalSize->getHeight()
            );
        }

        imagedestroy($this->resource);

        $this->resource = $destination;
        $this->originalSize = clone $this->resultSize;
        $this->resultOffsetX = 0;
        $this->resultOffsetY = 0;
    }
}
