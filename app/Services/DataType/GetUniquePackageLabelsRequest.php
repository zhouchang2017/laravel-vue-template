<?php

namespace App\Services\DataType;

class GetUniquePackageLabelsRequest extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'SellerId'             => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'MWSAuthToken'         => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'ShipmentId'           => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'PageType'             => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'PackageLabelsToPrint' => [ 'FieldValue' => null, 'FieldType' => 'PackageIdentifiers' ],
        ];
        $this->setSellerId(config('amazon.seller_id'));
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
     * Get the value of the PageType property.
     *
     * @return String PageType.
     */
    public function getPageType()
    {
        return $this->_fields['PageType']['FieldValue'];
    }

    /**
     * Set the value of the PageType property.
     *
     * @param string pageType
     * @return this instance
     */
    public function setPageType($value)
    {
        $this->_fields['PageType']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PageType is set.
     *
     * @return true if PageType is set.
     */
    public function isSetPageType()
    {
        return !is_null($this->_fields['PageType']['FieldValue']);
    }

    /**
     * Set the value of PageType, return this.
     *
     * @param pageType
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPageType($value)
    {
        $this->setPageType($value);
        return $this;
    }

    /**
     * Get the value of the PackageLabelsToPrint property.
     *
     * @return PackageIdentifiers PackageLabelsToPrint.
     */
    public function getPackageLabelsToPrint()
    {
        return $this->_fields['PackageLabelsToPrint']['FieldValue'];
    }

    /**
     * Set the value of the PackageLabelsToPrint property.
     *
     * @param PackageIdentifiers packageLabelsToPrint
     * @return this instance
     */
    public function setPackageLabelsToPrint($value)
    {
        $this->_fields['PackageLabelsToPrint']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PackageLabelsToPrint is set.
     *
     * @return true if PackageLabelsToPrint is set.
     */
    public function isSetPackageLabelsToPrint()
    {
        return !is_null($this->_fields['PackageLabelsToPrint']['FieldValue']);
    }

    /**
     * Set the value of PackageLabelsToPrint, return this.
     *
     * @param packageLabelsToPrint
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPackageLabelsToPrint($value)
    {
        $this->setPackageLabelsToPrint($value);
        return $this;
    }

}
