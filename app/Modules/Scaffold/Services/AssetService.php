<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/8/1
 * Time: 3:55 PM
 */

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
        $path = $file->store(request('path'),'public');
        $url = Storage::url($path);
        return $url;
    }

    private function readImage($path)
    {
        $realPath = storage_path('app/public').'/'.$path;
        $img = Image::make($realPath);

        dd($img);
    }
}