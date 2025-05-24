<?php
function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
    echo "</pre>";
}

function saveImage($request, $imageName, $imagePath)
{
        $file = $request->file($imageName);
        $image_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($imagePath), $image_name);
        return  $imagePath . $image_name;

}
