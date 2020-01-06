<?php
/**
 * Created by PhpStorm.
 * User: Mpande Andrew
 * Date: 10/08/2019
 * Time: 12:35
 */

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Ddondola\Media;

if (!function_exists('media_url')) {

    /**
     * Generate url for media
     *
     * @param Media $media
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function media_url(Media $media)
    {
        // return $media->getFullUrl(); // todo uncomment this in production
        return asset("/storage/$media->order_column/$media->file_name");
    }
}

if (!function_exists('has_media')) {

    /**
     * Check if a given model has media in a given collection
     *
     * @param HasMedia $model
     * @param string $collection
     * @return bool
     */
    function has_media(HasMedia $model, $collection='')
    {
        return $model->hasMedia($collection);
    }
}

if (!function_exists('media_placeholder')) {

    /**
     * Placeholder url location
     *
     * @return string
     */
    function media_placeholder()
    {
        return asset('/images/product/placeholder.jpg');
    }
}