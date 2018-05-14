<?php

namespace App\Services\DataType;

class PutTransportContentRequest extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'SellerId'         => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'MWSAuthToken'     => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'ShipmentId'       => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'IsPartnered'      => [ 'FieldValue' => null, 'FieldType' => 'bool' ],
            'ShipmentType'     => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'TransportDetails' => [ 'FieldValue' => null, 'FieldType' => 'TransportDetailInput' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the SellerId property.
     *
     * @return String SellerId.
     */
    public function getSellerId()
    {
        return $this->_fields['SellerId']['FieldValue'];
    }

    /**
     * Set the value of the SellerId property.
     *
     * @param string sellerId
     * @return this instance
     */
    public function setSellerId($value)
    {
        $this->_fields['SellerId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SellerId is set.
     *
     * @return true if SellerId is set.
     */
    public function isSetSellerId()
    {
        return !is_null($this->_fields['SellerId']['FieldValue']);
    }

    /**
     * Set the value of SellerId, return this.
     *
     * @param sellerId
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSellerId($value)
    {
        $this->setSellerId($value);
        return $this;
    }

    /**
     * Get the value of the MWSAuthToken property.
     *
     * @return String MWSAuthToken.
     */
    public function getMWSAuthToken()
    {
        return $this->_fields['MWSAuthToken']['FieldValue'];
    }

    /**
     * Set the value of the MWSAuthToken property.
     *
     * @param string mwsAuthToken
     * @return this instance
     */
    public function setMWSAuthToken($value)
    {
        $this->_fields['MWSAuthToken']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if MWSAuthToken is set.
     *
     * @return true if MWSAuthToken is set.
     */
    public function isSetMWSAuthToken()
    {
        return !is_null($this->_fields['MWSAuthToken']['FieldValue']);
    }

    /**
     * Set the value of MWSAuthToken, return this.
     *
     * @param mwsAuthToken
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withMWSAuthToken($value)
    {
        $this->setMWSAuthToken($value);
        return $this;
    }

    /**
     * Get the value of the ShipmentId property.
     *
     * @return String ShipmentId.
     */
    public function getShipmentId()
    {
        return $this->_fields['ShipmentId']['FieldValue'];
    }

    /**
     * Set the value of the ShipmentId property.
     *
     * @param string shipmentId
     * @return this instance
     */
    public function setShipmentId($value)
    {
        $this->_fields['ShipmentId']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ShipmentId is set.
     *
     * @return true if ShipmentId is set.
     */
    public function isSetShipmentId()
    {
        return !is_null($this->_fields['ShipmentId']['FieldValue']);
    }

    /**
     * Set the value of ShipmentId, return this.
     *
     * @param shipmentId
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withShipmentId($value)
    {
        $this->setShipmentId($value);
        return $this;
    }

    /**
     * Check the value of IsPartnered.
     *
     * @return true if IsPartnered is set to true.
     */
    public function isIsPartnered()
    {
        return $this->_fields['IsPartnered']['FieldValue'];
    }

    /**
     * Get the value of the IsPartnered property.
     *
     * @return boolean IsPartnered.
     */
    public function getIsPartnered()
    {
        return $this->_fields['IsPartnered']['FieldValue'];
    }

    /**
     * Set the value of the IsPartnered property.
     *
     * @param bool isPartnered
     * @return this instance
     */
    public function setIsPartnered($value)
    {
        $this->_fields['IsPartnered']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if IsPartnered is set.
     *
     * @return true if IsPartnered is set.
     */
    public function isSetIsPartnered()
    {
        return !is_null($this->_fields['IsPartnered']['FieldValue']);
    }

    /**
     * Set the value of IsPartnered, return this.
     *
     * @param isPartnered
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withIsPartnered($value)
    {
        $this->setIsPartnered($value);
        return $this;
    }

    /**
     * Get the value of the ShipmentType property.
     *
     * @return String ShipmentType.
     */
    public function getShipmentType()
    {
        return $this->_fields['ShipmentType']['FieldValue'];
    }

    /**
     * Set the value of the ShipmentType property.
     *
     * @param string shipmentType
     * @return this instance
     */
    public function setShipmentType($value)
    {
        $this->_fields['ShipmentType']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ShipmentType is set.
     *
     * @return true if ShipmentType is set.
     */
    public function isSetShipmentType()
    {
        return !is_null($this->_fields['ShipmentType']['FieldValue']);
    }

    /**
     * Set the value of ShipmentType, return this.
     *
     * @param shipmentType
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withShipmentType($value)
    {
        $this->setShipmentType($value);
        return $this;
    }

    /**
     * Get the value of the TransportDetails property.
     *
     * @return TransportDetailInput TransportDetails.
     */
    public function getTransportDetails()
    {
        return $this->_fields['TransportDetails']['FieldValue'];
    }

    /**
     * Set the value of the TransportDetails property.
     *
     * @param TransportDetailInput transportDetails
     * @return this instance
     */
    public function setTransportDetails($value)
    {
        $this->_fields['TransportDetails']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if TransportDetails is set.
     *
     * @return true if TransportDetails is set.
     */
    public function isSetTransportDetails()
    {
        return !is_null($this->_fields['TransportDetails']['FieldValue']);
    }

    /**
     * Set the value of TransportDetails, return this.
     *
     * @param transportDetails
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withTransportDetails($value)
    {
        $this->setTransportDetails($value);
        return $this;
    }

}
