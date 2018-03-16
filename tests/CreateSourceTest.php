<?php

namespace Larakit\Tests;

use Larakit\Helpers\Exception\FileNotFoundException;
use Larakit\Helpers\Exception\FileNotSupportedException;
use Larakit\Helpers\ImageManager;
use Larakit\Helpers\ImageResource;
use PHPUnit\Framework\TestCase;

/**
 * Class CreateSourceTest
 */
class CreateSourceTest extends TestCase
{
    /**
     * @group  unit
     * @covers ImageManager::createByPath
     */
    public function testSuccessCreateImageResource()
    {
        $imagePath = __DIR__ . '/data/image.jpg';
        $creator = new ImageManager();
        $this->assertInstanceOf(ImageResource::class, $creator->createByPath($imagePath));
    }

    /**
     * @group  unit
     * @covers ImageManager::createByPath
     */
    public function testFailCreateFromDirectory()
    {
        $imagePath = __DIR__ . '/data';
        $creator = new ImageManager();
        $this->expectException(FileNotSupportedException::class);
        $creator->createByPath($imagePath);
    }

    /**
     * @group  unit
     * @covers ImageManager::createByPath
     */
    public function testFailCreateFromNotImage()
    {
        $imagePath = __DIR__ . '/data/not-images.txt';
        $creator = new ImageManager();
        $this->expectException(FileNotSupportedException::class);
        $creator->createByPath($imagePath);
    }

    /**
     * @group  unit
     * @covers ImageManager::createByPath
     */
    public function testFailCreateFromNotExistingFile()
    {
        $imagePath = __DIR__ . '/data/not-existing-file';
        $creator = new ImageManager();
        $this->expectException(FileNotFoundException::class);
        $creator->createByPath($imagePath);
    }
}
