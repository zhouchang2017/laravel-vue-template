<?php

namespace App\Services\DataType;


class UpdateInboundShipmentResponse extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'UpdateInboundShipmentResult' => [ 'FieldValue' => null, 'FieldType' => 'UpdateInboundShipmentResult' ],
            'ResponseMetadata'            => [ 'FieldValue' => null, 'FieldType' => 'ResponseMetadata' ],
            'ResponseHeaderMetadata'      => [ 'FieldValue' => null, 'FieldType' => 'ResponseHeaderMetadata' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the UpdateInboundShipmentResult property.
     *
     * @return UpdateInboundShipmentResult UpdateInboundShipmentResult.
     */
    public function getUpdateInboundShipmentResult()
    {
        return $this->_fields['UpdateInboundShipmentResult']['FieldValue'];
    }

    /**
     * Set the value of the UpdateInboundShipmentResult property.
     *
     * @param UpdateInboundShipmentResult updateInboundShipmentResult
     * @return this instance
     */
    public function setUpdateInboundShipmentResult($value)
    {
        $this->_fields['UpdateInboundShipmentResult']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if UpdateInboundShipmentResult is set.
     *
     * @return true if UpdateInboundShipmentResult is set.
     */
    public function isSetUpdateInboundShipmentResult()
    {
        return !is_null($this->_fields['UpdateInboundShipmentResult']['FieldValue']);
    }

    /**
     * Set the value of UpdateInboundShipmentResult, return this.
     *
     * @param updateInboundShipmentResult
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withUpdateInboundShipmentResult($value)
    {
        $this->setUpdateInboundShipmentResult($value);
        return $this;
    }

    /**
     * Get the value of the ResponseMetadata property.
     *
     * @return ResponseMetadata ResponseMetadata.
     */
    public function getResponseMetadata()
    {
        return $this->_fields['ResponseMetadata']['FieldValue'];
    }

    /**
     * Set the value of the ResponseMetadata property.
     *
     * @param ResponseMetadata responseMetadata
     * @return this instance
     */
    public function setResponseMetadata($value)
    {
        $this->_fields['ResponseMetadata']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ResponseMetadata is set.
     *
     * @return true if ResponseMetadata is set.
     */
    public function isSetResponseMetadata()
    {
        return !is_null($this->_fields['ResponseMetadata']['FieldValue']);
    }

    /**
     * Set the value of ResponseMetadata, return this.
     *
     * @param responseMetadata
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withResponseMetadata($value)
    {
        $this->setResponseMetadata($value);
        return $this;
    }

    /**
     * Get the value of the ResponseHeaderMetadata property.
     *
     * @return ResponseHeaderMetadata ResponseHeaderMetadata.
     */
    public function getResponseHeaderMetadata()
    {
        return $this->_fields['ResponseHeaderMetadata']['FieldValue'];
    }

    /**
     * Set the value of the ResponseHeaderMetadata property.
     *
     * @param ResponseHeaderMetadata responseHeaderMetadata
     * @return this instance
     */
    public function setResponseHeaderMetadata($value)
    {
        $this->_fields['ResponseHeaderMetadata']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ResponseHeaderMetadata is set.
     *
     * @return true if ResponseHeaderMetadata is set.
     */
    public function isSetResponseHeaderMetadata()
    {
        return !is_null($this->_fields['ResponseHeaderMetadata']['FieldValue']);
    }

    /**
     * Set the value of ResponseHeaderMetadata, return this.
     *
     * @param responseHeaderMetadata
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withResponseHeaderMetadata($value)
    {
        $this->setResponseHeaderMetadata($value);
        return $this;
    }

    /**
     * Construct UpdateInboundShipmentResponse from XML string
     *
     * @param $xml
     *        XML string to construct from
     *
     * @return UpdateInboundShipmentResponse
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
        $response = $xpath->query("//*[local-name()='UpdateInboundShipmentResponse']");
        if ($response->length == 1) {
            return new UpdateInboundShipmentResponse(($response->item(0)));
        } else {
            throw new Exception ("Unable to construct UpdateInboundShipmentResponse from provided XML. 
                                  Make sure that UpdateInboundShipmentResponse is a root element");
        }
    }

    /**
     * XML Representation for this object
     *
     * @return string XML for this object
     */
    public function toXML()
    {
        $xml = "";
        $xml .= "<UpdateInboundShipmentResponse xmlns=\"http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</UpdateInboundShipmentResponse>";
        return $xml;
    }

}
