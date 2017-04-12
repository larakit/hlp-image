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
<img src="https://habrastorage.org/files/186/64c/865/18664c86506e4c299b8ab1090707937b.png"/>

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
<img src="https://habrastorage.org/files/054/e57/3ba/054e573badbd453faa4895915a5dc02b.png"/>

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
<img src="https://habrastorage.org/files/8b7/353/705/8b7353705ffc4bf49a81867aa1b27c73.png"/>

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
<img src="https://habrastorage.org/files/c52/cd5/2b7/c52cd52b783c4ee1b895b1252c75615c.png"/>

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
<img src="https://habrastorage.org/files/8b3/164/950/8b31649505ff4ed480d504d8640dd038.png"/>

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
<img src="https://habrastorage.org/files/e19/9c8/c03/e199c8c03e524803b15e7f0f0fd7d4b3.png"/>
