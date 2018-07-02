<?php

namespace App\Observers;


use App\Models\Manually;
use App\Models\ProcurementPlan;
use Illuminate\Support\Str;

class ManuallyObserver
{

    public function created(Manually $manually)
    {
        $this->syncProductVariants($manually);
    }

    public function willUpdate(Manually $manually)
    {
        dump('Manually willUpdate');
    }

    public function didUpdate(Manually $manually)
    {
        dump($manually);
        dd('Manually didUpdate');
    }

    public function updated(Manually $manually)
    {

    }

    public function afterUpdated(Manually $manually)
    {
        $this->syncProductVariants($manually);
    }

    public function deleted(Manually $manually)
    {

    }

    private function syncProductVariants(Manually $manually)
    {
        if (request()->has('variants')) {
            $manually->variants()->sync(request('variants'));
        }
        return $manually;
    }
}