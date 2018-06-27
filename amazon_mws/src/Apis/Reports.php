<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/5/24
 * Time: 下午4:38
 */

namespace Mws\Apis;


use Carbon\Carbon;
use Illuminate\Http\Request;

class Reports extends Api
{
    const VERSION = '2009-01-01';

    public function __construct(array $storeKeys)
    {
        parent::__construct($storeKeys);
        $this->setParamsVersion(self::VERSION)->setParamsMarketplaceId();
    }

    public function requestReport(Request $request)
    {
        $type = '_GET_FLAT_FILE_OPEN_LISTINGS_DATA_';
        $this->params = array_merge($this->params, [
            'ReportType' => $type,
            'StartDate'  => Carbon::now()->subWeek()->toIso8601String(),
        ]);
        return $this;
    }

    public function getReportRequestList()
    {
        $this->params = array_merge($this->params, [
            'ReportRequestIdList.Id.1' => '50003017675',
        ]);
        return $this;
    }

    public function getReport()
    {
        $this->params = array_merge($this->params, [
            'ReportId' => '9651317660017675',
        ]);
        return $this;
    }
}