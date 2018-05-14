<?php

namespace App\Http\Controllers;

use App\Services\Mws;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $mws;

    /**
     * TestController constructor.
     * @param $mws
     */
    public function __construct(Mws $mws)
    {
        $this->mws = $mws;
    }

    public function index()
    {
        dd($this->mws->build());
    }
}
