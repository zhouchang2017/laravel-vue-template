<?php

namespace App\Services\DataType;

class EstimateTransportRequestResponse extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'EstimateTransportRequestResult' => [ 'FieldValue' => null, 'FieldType' => 'EstimateTransportRequestResult' ],
            'ResponseMetadata'               => [ 'FieldValue' => null, 'FieldType' => 'ResponseMetadata' ],
            'ResponseHeaderMetadata'         => [ 'FieldValue' => null, 'FieldType' => 'ResponseHeaderMetadata' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the EstimateTransportRequestResult property.
     *
     * @return EstimateTransportRequestResult EstimateTransportRequestResult.
     */
    public function getEstimateTransportRequestResult()
    {
        return $this->_fields['EstimateTransportRequestResult']['FieldValue'];
    }

    /**
     * Set the value of the EstimateTransportRequestResult property.
     *
     * @param EstimateTransportRequestResult estimateTransportRequestResult
     * @return this instance
     */
    public function setEstimateTransportRequestResult($value)
    {
        $this->_fields['EstimateTransportRequestResult']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if EstimateTransportRequestResult is set.
     *
     * @return true if EstimateTransportRequestResult is set.
     */
    public function isSetEstimateTransportRequestResult()
    {
        return !is_null($this->_fields['EstimateTransportRequestResult']['FieldValue']);
    }

    /**
     * Set the value of EstimateTransportRequestResult, return this.
     *
     * @param estimateTransportRequestResult
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withEstimateTransportRequestResult($value)
    {
        $this->setEstimateTransportRequestResult($value);
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
     * Construct EstimateTransportRequestResponse from XML string
     *
     * @param $xml
     *        XML string to construct from
     *
     * @return EstimateTransportRequestResponse
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
        $response = $xpath->query("//*[local-name()='EstimateTransportRequestResponse']");
        if ($response->length == 1) {
            return new EstimateTransportRequestResponse(($response->item(0)));
        } else {
            throw new Exception ("Unable to construct EstimateTransportRequestResponse from provided XML. 
                                  Make sure that EstimateTransportRequestResponse is a root element");
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
        $xml .= "<EstimateTransportRequestResponse xmlns=\"http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</EstimateTransportRequestResponse>";
        return $xml;
    }

}
