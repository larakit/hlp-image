<?php

namespace Larakit\Tests;

use Larakit\Helpers\Exception\FileNotFoundException;
use Larakit\Helpers\Exception\FileNotSupportedException;
use Larakit\Helpers\ImageService;
use Larakit\Helpers\ImageResource;
use PHPUnit\Framework\TestCase;

/**
 * Class CreateSourceTest
 */
class CreateSourceTest extends TestCase
{
    /**
     * @group  unit
     * @covers ImageService::createByPath
     */
    public function testSuccessCreateImageResource()
    {
        $imagePath = __DIR__ . '/data/image.jpg';
        $creator = new ImageService();
        $this->assertInstanceOf(ImageResource::class, $creator->createByPath($imagePath));
    }

    /**
     * @group  unit
     * @covers ImageService::createByPath
     */
    public function testFailCreateFromDirectory()
    {
        $imagePath = __DIR__ . '/data';
        $creator = new ImageService();
        $this->expectException(FileNotSupportedException::class);
        $creator->createByPath($imagePath);
    }

    /**
     * @group  unit
     * @covers ImageService::createByPath
     */
    public function testFailCreateFromNotImage()
    {
        $imagePath = __DIR__ . '/data/not-images.txt';
        $creator = new ImageService();
        $this->expectException(FileNotSupportedException::class);
        $creator->createByPath($imagePath);
    }

    /**
     * @group  unit
     * @covers ImageService::createByPath
     */
    public function testFailCreateFromNotExistingFile()
    {
        $imagePath = __DIR__ . '/data/not-existing-file';
        $creator = new ImageService();
        $this->expectException(FileNotFoundException::class);
        $creator->createByPath($imagePath);
    }
}
