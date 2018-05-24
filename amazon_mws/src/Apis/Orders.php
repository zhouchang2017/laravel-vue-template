<?php
namespace Mws\Apis;

use Carbon\Carbon;

class Orders extends Api
{
    const VERSION = '2013-09-01';

	protected $status = [
		'PendingAvailability',
		'Pending',
		'Unshipped',
		'PartiallyShipped',
		'Shipped',
		'InvoiceUnconfirmed',
		'Canceled',
		'Unfulfillable',
	];

	protected $options = [
		'CreatedAfter', 
		'CreatedBefore', 
		'LastUpdatedAfter', 
		'LastUpdatedBefore', 
		'OrderStatus',
		'FulfillmentChannel',
		'PaymentMethod',
		'BuyerEmail',
		'SellerOrderId',
		'TFMShipmentStatus',
	];

	public function __construct()
    {
    }

    public function listOrders($query = [])
	{
		if (empty($options)) {
			$query['CreatedAfter'] = Carbon::now()->subMonth();
		}
		$query = $this->cleanQuery($query, $this->options);

		return $this->client()->request('ListOrders', $query);
	}

	public function ListOrdersByNextToken($token)
	{

	}

	public function GetOrder($orderId)
	{

	}

	public function ListOrderItems($orderId)
	{

	}

	public function ListOrderItemsByNextToken($token)
	{

	}

	public function GetServiceStatus()
	{

	}
}