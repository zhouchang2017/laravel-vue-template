<?php

namespace App\Modules\Scaffold\Services;


use App\Modules\Scaffold\BaseService;
use App\Modules\Scaffold\Contracts\AssetRelation;
use App\Modules\Scaffold\Models\Asset;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\FileHelpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use File;

class AssetService extends BaseService
{
    use FileHelpers;

    const THUMB_PREFIX = 'thumb_';

    const THUMB_SIZE = 200;

    protected $defaultStorePath;

    protected $basename;

    protected $dirName;

    protected $model;

    protected $thumbSavePath;

    protected $fullPath;

    protected $fileName;

    protected $url;

    protected $height;

    protected $width;

    protected $size;

    protected $thumb;

    /**
     * \Intervention\Image\Image
     */
    protected $img;

    /**
     * AssetService constructor.
     * @param $model
     */
    public function __construct(Asset $model)
    {
        $this->model = $model;
        $this->defaultStorePath = config('filesystems.disks.public.root');
    }

    public function save($dirName = 'app')
    {
        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $this->handleFile($dirName);
        $path = $file->store($dirName, 'public');
        $this->basename = File::basename($path);

        $this->handleThumb($dirName, $this->basename);
        return [
            'src' => $this->getStorageUrl($path),
            'thumb' => $this->getStorageUrl($this->thumbSavePath),
        ];
    }

    private function handleThumb($dirname, $baseName)
    {
        $this->img->fit(self::THUMB_SIZE)->save($this->getThumbSavePath($dirname, $baseName));
    }

    private function getThumbName($baseName): string
    {
        return self::THUMB_PREFIX . $baseName;
    }

    private function handleFile($dirName)
    {
        /** @var \Illuminate\Http\UploadedFile $file */
        $file = current(request()->file());
        $this->setImage($file);
        $this->dirName = $dirName;
        return $file;
    }

    private function getStorageUrl($path)
    {
        return Storage::url($path);
    }

    /**
     * @param $source
     * @return $this
     */
    private function setImage($source)
    {
        $this->img = Image::make($source);
        return $this;
    }


    private function getThumbSavePath($dirname, $baseName)
    {
        $this->thumbSavePath = $dirname . '/' . $this->getThumbName($baseName);
        $thumbSavePath = $this->defaultStorePath . '/' . $dirname . '/' . $this->getThumbName($baseName);
        return $thumbSavePath;
    }


    public function store(AssetRelation $model, array $images)
    {
        $options = collect($images)->reduce(function ($res, $img) {
            $src = $this->getImageExif($img['src']);
            $src['thumb'] = $this->getImageExif($img['thumb']);
            array_push($res, $src);
            return $res;
        }, []);
        return $this->callTargetRelation($model)->createMany($options);
    }

    public function update(AssetRelation $model, array $images)
    {
        $change = $this->calcUpdateChange($model, $images);
        count($change['created']) > 0 && $this->store($model, $change['created']);
        $this->destroyAsset($change['deleted']);
    }

    private function destroyAsset(Collection $assets)
    {
        $assets->map(function(Asset $asset){
            $asset->delete();
        });
    }

    private function calcUpdateChange(AssetRelation $model, array $images)
    {
        $assets = $this->callTargetRelation($model)->get();
        $init = [
            'updated' => [],
            'created' => [],
            'deleted' => [],
        ];
        $ids = array_filter(array_pluck($images,'id'));

        $init['deleted'] = $assets->filter(function($item) use ($ids){
           return !in_array($item->id,$ids);
        });
        return collect($images)->reduce(function ($res, $image) use ($assets) {
            if (array_key_exists('id', $image)) {

                if ($asset = $assets->where('id', $image['id'])->first()) {
                    if ($asset->url !== $image['src']) {
                        // update
                        $res['updated'][] = $image;
                    }
                }
            } else {
                // create
                $res['created'][] = $image;
            }
            return $res;
        }, $init);
    }

    private function callTargetRelation(AssetRelation $model): MorphMany
    {
        return call_user_func([$model, $model->getAssetMethod()]);
    }

    private function getImageExif($src)
    {
        $fullPath = $this->getSourcePath($src);
        $this->setImage($fullPath);
        return [
            'url' => $src,
            'type' => $this->img->extension,
            'size' => $this->img->filesize(),
            'path' => $fullPath,
            'height' => $this->img->getHeight(),
            'width' => $this->img->getWidth(),
        ];
    }

    private function getSourcePath($path)
    {
        $path = Str::replaceFirst('/storage/', '/', $path);
        return $this->defaultStorePath . $path;
    }


}