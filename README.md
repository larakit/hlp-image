# Larakit Helper Image
Модуль-обертка для добавления "синтаксического сахара" к модулю <a href="https://github.com/intervention/image">intervention/image</a>

### 1. Вписываем изображение в указанную ширину
~~~
/**
 * Вписываем изображение в указанную ширину
 * Высота какая получится такая и будет
 * Пример: фотки на аватарках в контактике
 *
 * @param \Intervention\Image\Image $img
 * @param                           $w
 * @param bool                      $can_upsize
 *
 * @return \Intervention\Image\Image
 */
\Larakit\Helpers\HelperImage::resizeByWidth($img, $w, $can_upsize);
~~~

### 2. Насильно вписываем изображение без учета пропорций в указанные рамки 
~~~
/**
 * Насильно вписываем изображение без учета пропорций в указанные рамки
 *
 * @param \Intervention\Image\Image $img
 * @param                           $w
 * @param                           $h
 *
 * @return \Intervention\Image\Image
 */
\Larakit\Helpers\HelperImage::resizeIgnoringAspectRatio($img, $w, $h);
~~~

### 3. Исходная картинка сжимается до тех пор пока не начнет целиком входить в указанные рамки
~~~
/**
 * Исходная картинка сжимается до тех пор пока не начнет целиком входить в указанные рамки
 * С сохранением пропорций
 *
 * @param int $w
 * @param int $h
 *
 * @return \Image
 */
\Larakit\Helpers\HelperImage::resizeImgInBox($img, $w, $h, $can_upsize);
~~~

### 4. Уменьшаем размер исходного изображения с сохранением пропорций так, 
### чтобы новое получилось вписанным в указанный размер
~~~
/**
 * Уменьшаем размер исходного изображения с сохранением пропорций так, 
 * чтобы новое получилось вписанным в указанный размер
 * Там где изображение уже отсутствует - добиваем белым цветом до указанного размера
 *
 * @param type $width
 * @param type $height
 *
 * @return \Image
 */
\Larakit\Helpers\HelperImage::cropImgInBox($img, $width, $height);
~~~

### 5. Уменьшаем размер исходного изображения с сохранением пропорций так,
### чтобы новое получилось описанным вокруг указанного размера
~~~
/**
 * Уменьшаем размер исходного изображения с сохранением пропорций так,чтобы новое получилось 
 * описанным вокруг указанного размера
 * Там где изображение будет за границами рамки оно будет просто обрезано с центровкой посредине картинки
 *
 * @param \Intervention\Image\Image $img
 * @param                           $width
 * @param                           $height
 *
 * @return \Intervention\Image\Image
 */
\Larakit\Helpers\HelperImage::cropBoxInImg($img, $width, $height);
~~~


### 6. Указанная рамка должна помещаться внутрь конечного изображения
~~~
/**
 * Указанная рамка должна помещаться внутрь конечного изображения
 * Т.е. если заказываем 100 на 400 а картинка 2000 на 1000
 * То картинка будет уменьшаться до тех пор пока ее высота меньше указанного
 * или ширина меньше указанного
 *
 * @param \Intervention\Image\Image $img
 * @param                           $w
 * @param                           $h
 *
 * @return \Intervention\Image\Image
 */
\Larakit\Helpers\HelperImage::resizeBoxInImg($img, $w, $h);
~~~
