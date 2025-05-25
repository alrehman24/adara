<?php
function pd($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    die();
}
function saveImage($file, $imagePath)
{
        $image_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($imagePath), $image_name);
        return  $imagePath . $image_name;
}
