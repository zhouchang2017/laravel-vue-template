<?php

namespace App\Services\DataType;

class InboundShipmentPlanItem extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'SellerSKU'             => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'FulfillmentNetworkSKU' => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'Quantity'              => [ 'FieldValue' => null, 'FieldType' => 'int' ],
            'PrepDetailsList'       => [ 'FieldValue' => null, 'FieldType' => 'PrepDetailsList' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the SellerSKU property.
     *
     * @return String SellerSKU.
     */
    public function getSellerSKU()
    {
        return $this->_fields['SellerSKU']['FieldValue'];
    }

    /**
     * Set the value of the SellerSKU property.
     *
     * @param string sellerSKU
     * @return this instance
     */
    public function setSellerSKU($value)
    {
        $this->_fields['SellerSKU']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SellerSKU is set.
     *
     * @return true if SellerSKU is set.
     */
    public function isSetSellerSKU()
    {
        return !is_null($this->_fields['SellerSKU']['FieldValue']);
    }

    /**
     * Set the value of SellerSKU, return this.
     *
     * @param sellerSKU
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSellerSKU($value)
    {
        $this->setSellerSKU($value);
        return $this;
    }

    /**
     * Get the value of the FulfillmentNetworkSKU property.
     *
     * @return String FulfillmentNetworkSKU.
     */
    public function getFulfillmentNetworkSKU()
    {
        return $this->_fields['FulfillmentNetworkSKU']['FieldValue'];
    }

    /**
     * Set the value of the FulfillmentNetworkSKU property.
     *
     * @param string fulfillmentNetworkSKU
     * @return this instance
     */
    public function setFulfillmentNetworkSKU($value)
    {
        $this->_fields['FulfillmentNetworkSKU']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if FulfillmentNetworkSKU is set.
     *
     * @return true if FulfillmentNetworkSKU is set.
     */
    public function isSetFulfillmentNetworkSKU()
    {
        return !is_null($this->_fields['FulfillmentNetworkSKU']['FieldValue']);
    }

    /**
     * Set the value of FulfillmentNetworkSKU, return this.
     *
     * @param fulfillmentNetworkSKU
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withFulfillmentNetworkSKU($value)
    {
        $this->setFulfillmentNetworkSKU($value);
        return $this;
    }

    /**
     * Get the value of the Quantity property.
     *
     * @return Integer Quantity.
     */
    public function getQuantity()
    {
        return $this->_fields['Quantity']['FieldValue'];
    }

    /**
     * Set the value of the Quantity property.
     *
     * @param int quantity
     * @return this instance
     */
    public function setQuantity($value)
    {
        $this->_fields['Quantity']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Quantity is set.
     *
     * @return true if Quantity is set.
     */
    public function isSetQuantity()
    {
        return !is_null($this->_fields['Quantity']['FieldValue']);
    }

    /**
     * Set the value of Quantity, return this.
     *
     * @param quantity
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withQuantity($value)
    {
        $this->setQuantity($value);
        return $this;
    }

    /**
     * Get the value of the PrepDetailsList property.
     *
     * @return PrepDetailsList PrepDetailsList.
     */
    public function getPrepDetailsList()
    {
        return $this->_fields['PrepDetailsList']['FieldValue'];
    }

    /**
     * Set the value of the PrepDetailsList property.
     *
     * @param PrepDetailsList prepDetailsList
     * @return this instance
     */
    public function setPrepDetailsList($value)
    {
        $this->_fields['PrepDetailsList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PrepDetailsList is set.
     *
     * @return true if PrepDetailsList is set.
     */
    public function isSetPrepDetailsList()
    {
        return !is_null($this->_fields['PrepDetailsList']['FieldValue']);
    }

    /**
     * Set the value of PrepDetailsList, return this.
     *
     * @param prepDetailsList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPrepDetailsList($value)
    {
        $this->setPrepDetailsList($value);
        return $this;
    }

}
