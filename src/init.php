<?php
Larakit\Boot::register_provider(\Intervention\Image\ImageServiceProvider::class);
Larakit\Boot::register_alias('Image', \Intervention\Image\Facades\Image::class);
