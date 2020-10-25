<?php

namespace App\Services;


trait UtilService
{
    public function uploadFile($file, $code)
    {
        $extension = $file->getClientOriginalExtension();
        $pathThumb = $code . '.' . $extension;
        $file->storeAs('public/images', $pathThumb);

        return 'images/' . $pathThumb;
    }
}
