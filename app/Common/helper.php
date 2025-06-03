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
function checkTokenExpiry($time, $timeDiff)
{
    $data = Carbon\Carbon::parse($time->format('Y-m-d H:i:s'));
    $now = Carbon\Carbon::now();
    $diff = $data->diffInMinutes($now);
    if ($diff > $timeDiff) {
        return true;
    } else {
        return false;
    }
}
function generateToken()
{
    $token = base64_encode(random_bytes(32));
    return $token;
}
