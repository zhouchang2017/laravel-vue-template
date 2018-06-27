<?php

namespace App\Services\DataType;


class ConfirmTransportRequestResult extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'TransportResult' => [ 'FieldValue' => null, 'FieldType' => 'TransportResult' ],
        ];
        parent::__construct($data);
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
