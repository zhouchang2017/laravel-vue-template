<?php

namespace Mws;

use Illuminate\Support\Collection as BaseCollection;


class Collection extends BaseCollection
{
    public function __construct($items = null)
    {
        if (is_null($items)) {
            return parent::__construct(config('amazon.mws'));
        }

        return parent::__construct($items);
    }


    private function versionCollect()
    {
        return new static($this->get('version'));
    }

    public function getVersion(string $action)
    {
        return $this->versionCollect()->get($this->getModule($action));
    }

    public function getModule(string $action)
    {
        return $this->actionCollect()->filter(function($item) use ($action){
            return in_array(studly_case($action),$item);
        })->keys()->first();
    }


    private function actionCollect(){
        return new static($this->get('actions'));
    }

    public function actions()
    {
        return $this->actionCollect()->flatten()->toArray();
    }
}