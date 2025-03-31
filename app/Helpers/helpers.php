<?php

if(!function_exists('upload_image')) {
    function upload_image($img)
    {
        $fileName = uniqid() . '.' . $img->getClientOriginalExtension();
        $path = $img->storeAs('images/brands', $fileName, 'public');

        $port = $_SERVER['SERVER_PORT'];
        return env('APP_URL') . ':' . $port . '/api/v1/' . $path;
    }
}
