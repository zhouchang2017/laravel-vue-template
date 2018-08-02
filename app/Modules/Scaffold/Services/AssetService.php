<?php

namespace App\Modules\Scaffold\Services;


use App\Modules\Scaffold\BaseService;
use App\Modules\Scaffold\Models\Asset;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class AssetService extends BaseService
{
    protected $model;

    protected $url;

    protected $height;

    protected $width;

    protected $size;

    protected $thumb;

    protected $img;

    /**
     * AssetService constructor.
     * @param $model
     */
    public function __construct(Asset $model)
    {
        $this->model = $model;
    }

    public function save()
    {
        $file = current(request()->file());
        $path = $file->store(request('path'), 'public');
        $url = Storage::url($path);
        return $url;
    }

    private function readImage($path)
    {
        $realPath = public_path() . $path;
        $this->img = Image::make($realPath);
        return $this;
    }

    public function createThumb()
    {
        dd(1);
    }

}