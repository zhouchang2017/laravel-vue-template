<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateManuallyRequest;
use App\Http\Transformers\ManuallyTransformer;
use App\Models\Manually;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManuallyController extends Controller
{

    protected $formRequest = [
        'update' => UpdateManuallyRequest::class,
    ];

    public function __construct(Manually $model, ManuallyTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
