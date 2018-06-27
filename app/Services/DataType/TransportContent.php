<?php

namespace App\Services\DataType;

class TransportContent extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'TransportHeader'  => [ 'FieldValue' => null, 'FieldType' => 'TransportHeader' ],
            'TransportDetails' => [ 'FieldValue' => null, 'FieldType' => 'TransportDetailOutput' ],
            'TransportResult'  => [ 'FieldValue' => null, 'FieldType' => 'TransportResult' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the TransportHeader property.
     *
     * @return TransportHeader TransportHeader.
     */
    public function getTransportHeader()
    {
        return $this->_fields['TransportHeader']['FieldValue'];
    }

    /**
     * Set the value of the TransportHeader property.
     *
     * @param TransportHeader transportHeader
     * @return this instance
     */
    public function setTransportHeader($value)
    {
        $this->_fields['TransportHeader']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if TransportHeader is set.
     *
     * @return true if TransportHeader is set.
     */
    public function isSetTransportHeader()
    {
        return !is_null($this->_fields['TransportHeader']['FieldValue']);
    }

    /**
     * Set the value of TransportHeader, return this.
     *
     * @param transportHeader
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withTransportHeader($value)
    {
        $this->setTransportHeader($value);
        return $this;
    }

    /**
     * Get the value of the TransportDetails property.
     *
     * @return TransportDetailOutput TransportDetails.
     */
    public function getTransportDetails()
    {
        return $this->_fields['TransportDetails']['FieldValue'];
    }

    /**
     * Set the value of the TransportDetails property.
     *
     * @param TransportDetailOutput transportDetails
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

    /**
     * Get the value of the TransportResult property.
     *
     * @return TransportResult TransportResult.
     */
    public function getTransportResult()
    {
        return $this->_fields['TransportResult']['FieldValue'];
    }

    /**
     * Set the value of the TransportResult property.
     *
     * @param TransportResult transportResult
     * @return this instance
     */
    public function setTransportResult($value)
    {
        $this->_fields['TransportResult']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if TransportResult is set.
     *
     * @return true if TransportResult is set.
     */
    public function isSetTransportResult()
    {
        return !is_null($this->_fields['TransportResult']['FieldValue']);
    }

    /**
     * Set the value of TransportResult, return this.
     *
     * @param transportResult
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withTransportResult($value)
    {
        $this->setTransportResult($value);
        return $this;
    }

}
