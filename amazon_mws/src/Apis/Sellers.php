<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/5/24
 * Time: 下午4:19
 */

namespace Mws\Apis;


class Sellers extends Api
{
    const VERSION = '2011-07-01';

    public function __construct(array $storeKeys)
    {
        parent::__construct($storeKeys);
        $this->setParamsVersion(self::VERSION);
    }

    public function listMarketplaceParticipations()
    {
        return $this;
    }

    public function listMarketplaceParticipationsByNextToken()
    {

    }
}