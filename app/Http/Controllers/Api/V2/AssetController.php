<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Scaffold\Services\AssetService;

class AssetController extends Controller
{
    public function upload(AssetService $assetService)
    {
        return $assetService->save();
    }
}
