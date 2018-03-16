<?php

namespace Larakit\Helpers;

use Larakit\Helpers\Exception\FileNotFoundException;
use Larakit\Helpers\Exception\FileNotSupportedException;

/**
 * Class FileCreator
 * @package Larakit\Helpers
 */
class ImageService
{
    const IMAGE_PNG = 'png';
    const IMAGE_JPEG = 'jpg';

    /**
     * @param string $path
     *
     * @return ImageResource
     * @throws FileNotFoundException
     * @throws FileNotSupportedException
     */
    public function createByPath($path)
    {
        try {
            $file = new \SplFileObject($path);
        } catch (\RuntimeException $e) {
            throw new FileNotFoundException('File cannot be opened');
        } catch (\LogicException $e) {
            throw new FileNotSupportedException('File is a directory');
        }

        return $this->createImageResource($file);
    }

    /**
     * @param \SplFileObject $file
     *
     * @return ImageResource
     * @throws FileNotFoundException
     * @throws FileNotSupportedException
     */
    public function createByFile(\SplFileObject $file)
    {
        return $this->createImageResource($file);
    }

    /**
     * Saving changed image to filesystem
     *
     * @param ImageResource $imageResource
     * @param string        $path
     * @param string        $type
     *
     * @return bool
     *
     * @throws FileNotSupportedException
     */
    public function save(ImageResource $imageResource, $path, $type = self::IMAGE_JPEG)
    {
        $imageResource->applyChanges();

        switch ($type) {
            case self::IMAGE_JPEG:
                $result = imagejpeg($imageResource->getResource(), $path);
                break;
            case self::IMAGE_PNG:
                $result = imagepng($imageResource->getResource(), $path);
                break;
            default:
                throw new FileNotSupportedException(sprintf('Image type "%s" not supported', $type));
                break;
        }

        return $result;
    }

    /**
     * @param \SplFileObject $file
     *
     * @return ImageResource
     * @throws FileNotFoundException
     * @throws FileNotSupportedException
     */
    private function createImageResource(\SplFileObject $file)
    {
        if (!$file->isFile() || !$file->isReadable()) {
            throw new FileNotFoundException('File not found or not readable');
        }

        $imageInfo = @getimagesize($file->getRealPath());

        if (!is_array($imageInfo)) {
            throw new FileNotSupportedException('This is not image');
        }

        switch ($imageInfo['mime']) {
            case 'image/jpeg':
                $resource = imagecreatefromjpeg($file->getRealPath());
                break;
            case 'image/png':
                $resource = imagecreatefrompng($file->getRealPath());
                break;
            default:
                throw new FileNotSupportedException(sprintf('Image mime "%s" not supported', $imageInfo['mime']));
                break;
        }

        return new ImageResource($resource, $imageInfo[0], $imageInfo[1]);
    }
}
