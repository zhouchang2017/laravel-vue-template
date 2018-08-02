<?php

namespace App\Modules\Scaffold\Services;


use App\Modules\Scaffold\BaseService;
use App\Modules\Scaffold\Models\Asset;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use Closure;

class AssetService extends BaseService
{
    const THUMB_PREFIX = 'thumb_';
    protected $defaultStorePath;

    protected $model;

    protected $url;

    protected $height;

    protected $width;

    protected $size;

    protected $thumb;

    /**
     * \Intervention\Image\Image
     */
    protected $img;

    private $current;

    /**
     * AssetService constructor.
     * @param $model
     */
    public function __construct(Asset $model)
    {
        $this->model = $model;
        $this->defaultStorePath = storage_path('app/public');
    }

    public function save()
    {
        $file = current(request()->file());
        $path = $file->store(request('path'), 'public');
        $url = $this->getStorageUrl($path);
        return $url;
    }

    private function getStorageUrl($path)
    {
        return Storage::url($path);
    }

    private function readImage($path)
    {
        $this->current = [];
        $this->current['url'] = $path;
        $realPath = public_path() . $path;
        $this->img = Image::make($realPath);
        return $this;
    }

    private function saveImageExif()
    {
        $this->current = array_merge($this->current,[
            'extension' => $this->img->extension,
            'name'      => $this->img->filename,
            'size'      => $this->img->filesize(),
            'path'      => $this->img->dirname.'/'.$this->img->basename,
            'height'    =>$this->img->getHeight(),
            'width'     =>$this->img->getWidth()
        ]);
    }

    private function saveThumb():void
    {
        $this->img->fit(200)->save($this->getThumbSavePath());
    }

    private function getThumbSavePath()
    {
        return $this->defaultStorePath . '/' . self::THUMB_PREFIX . $this->current['name'] . '.' . $this->current['extension'];
    }

    private function getThumbStorageUrl()
    {
        return $this->getStorageUrl(self::THUMB_PREFIX . $this->current['name'] . '.' . $this->current['extension']);
    }

    public function store(array $paths, Closure $relationModel)
    {
        if (count($paths) > 0) {
            $options = collect($paths)->reduce(function ($res ,$path) {
                $this->readImage($path)->saveImageExif();
                $this->saveThumb();
                array_push($res,$this->storeThumbConfig());
                array_push($res,$this->storeOriginalConfig());
                return $res;
            },[]);
            return call_user_func($relationModel,$options);
        }
    }

    private function getStoreConfig()
    {
        return [
            $this->storeThumbConfig(),
            $this->storeOriginalConfig()
        ];
    }

    private function storeThumbConfig()
    {
        return [
            'path'   => $this->getThumbSavePath(),
            'url'    => $this->getThumbStorageUrl(),
            'height' => 200,
            'width'  => 200,
            'size'   => null,
            'type'   => 'thumb',
        ];
    }

    private function storeOriginalConfig()
    {
        return array_merge([
            'type'   => 'origin',
        ],array_except($this->current,['extension','name']));
    }

}