<?php

namespace Larakit\Tests;

use Larakit\Helpers\DTO\Size;
use Larakit\Helpers\ImageService;
use PHPUnit\Framework\TestCase;

/**
 * Class ResizeTest
 * @package Larakit\Tests
 *
 * @author  Sergey Koksharov <sharoff45@gmail.com>
 */
class ResizeTest extends TestCase
{
    /**
     * @group  unit
     * @covers ImageResource::resize()
     */
    public function testResizeMaxByWidth()
    {
        $imagePath = __DIR__ . '/data/image.jpg';
        $creator = new ImageService();
        $resource = $creator->createByPath($imagePath);

        $resource->resize(new Size(100, 250));

        $resultSize = $resource->getResultSize();
        $this->assertEquals(100, $resultSize->getWidth());
        $this->assertEquals(77, $resultSize->getHeight());
        $this->assertEquals(0, $resource->getResultOffsetX());
        $this->assertEquals(0, $resource->getResultOffsetY());
    }

    /**
     * @group  unit
     * @covers ImageResource::resize()
     */
    public function testResizeMaxByHeight()
    {
        $imagePath = __DIR__ . '/data/image.jpg';
        $creator = new ImageService();
        $resource = $creator->createByPath($imagePath);

        $resource->resize(new Size(500, 250));

        $resultSize = $resource->getResultSize();
        $this->assertEquals(323, $resultSize->getWidth());
        $this->assertEquals(250, $resultSize->getHeight());
        $this->assertEquals(0, $resource->getResultOffsetX());
        $this->assertEquals(0, $resource->getResultOffsetY());
    }

    /**
     * @group  unit
     * @covers ImageResource::resize()
     */
    public function testResizeAndCrop()
    {
        $imagePath = __DIR__ . '/data/image.jpg';
        $creator = new ImageService();
        $resource = $creator->createByPath($imagePath);

        // resizing width to 323
        $resource->resize(new Size(500, 250))
            // cropping and offset to center
                 ->crop(new Size(850, 250));

        $resultSize = $resource->getResultSize();
        $this->assertEquals(850, $resultSize->getWidth());
        $this->assertEquals(250, $resultSize->getHeight());
        $this->assertEquals(-263.5, $resource->getResultOffsetX());
        $this->assertEquals(0, $resource->getResultOffsetY());
    }
}
