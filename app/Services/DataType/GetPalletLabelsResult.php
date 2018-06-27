<?php

namespace App\Services\DataType;

class GetPalletLabelsResult extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'TransportDocument' => [ 'FieldValue' => null, 'FieldType' => 'TransportDocument' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the TransportDocument property.
     *
     * @return TransportDocument TransportDocument.
     */
    public function getTransportDocument()
    {
        return $this->_fields['TransportDocument']['FieldValue'];
    }

    /**
     * Set the value of the TransportDocument property.
     *
     * @param TransportDocument transportDocument
     * @return this instance
     */
    public function setTransportDocument($value)
    {
        $this->_fields['TransportDocument']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if TransportDocument is set.
     *
     * @return true if TransportDocument is set.
     */
    public function isSetTransportDocument()
    {
        return !is_null($this->_fields['TransportDocument']['FieldValue']);
    }

    /**
     * Set the value of TransportDocument, return this.
     *
     * @param transportDocument
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withTransportDocument($value)
    {
        $this->setTransportDocument($value);
        return $this;
    }

}
