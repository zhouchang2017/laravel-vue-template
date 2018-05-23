<?php
namespace Mws\Apis;

use Mws\Mws;
use Mws\Collection;

abstract class Api
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function client($endpoint = 'https://mws.amazonservices.com')
	{
		$collection = new Collection();

        return new Mws($collection, $endpoint);
	}

	protected function cleanQuery(array $query, array $allowed)
	{
		$query = collect($query)->transform(function($item) {
			if ($item instanceOf \Carbon\Carbon) {
				$item = $item->toIso8601String();
			}
			return $item;
		})->flip()->transform(function($item) {
			return studly_case($item);			
		})->filter(function($item) use ($allowed) {
			return in_array($item, $allowed);
		})->flip()->toArray();

		return $query;
	}
}