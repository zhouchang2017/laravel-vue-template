<?php

namespace App\Services\DataType;

class GetPrepInstructionsForASINResponse extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'GetPrepInstructionsForASINResult' => [ 'FieldValue' => null, 'FieldType' => 'GetPrepInstructionsForASINResult' ],
            'ResponseMetadata'                 => [ 'FieldValue' => null, 'FieldType' => 'ResponseMetadata' ],
            'ResponseHeaderMetadata'           => [ 'FieldValue' => null, 'FieldType' => 'ResponseHeaderMetadata' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the GetPrepInstructionsForASINResult property.
     *
     * @return GetPrepInstructionsForASINResult GetPrepInstructionsForASINResult.
     */
    public function getGetPrepInstructionsForASINResult()
    {
        return $this->_fields['GetPrepInstructionsForASINResult']['FieldValue'];
    }

    /**
     * Set the value of the GetPrepInstructionsForASINResult property.
     *
     * @param GetPrepInstructionsForASINResult getPrepInstructionsForASINResult
     * @return this instance
     */
    public function setGetPrepInstructionsForASINResult($value)
    {
        $this->_fields['GetPrepInstructionsForASINResult']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if GetPrepInstructionsForASINResult is set.
     *
     * @return true if GetPrepInstructionsForASINResult is set.
     */
    public function isSetGetPrepInstructionsForASINResult()
    {
        return !is_null($this->_fields['GetPrepInstructionsForASINResult']['FieldValue']);
    }

    /**
     * Set the value of GetPrepInstructionsForASINResult, return this.
     *
     * @param getPrepInstructionsForASINResult
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withGetPrepInstructionsForASINResult($value)
    {
        $this->setGetPrepInstructionsForASINResult($value);
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
     * Construct GetPrepInstructionsForASINResponse from XML string
     *
     * @param $xml
     *        XML string to construct from
     *
     * @return GetPrepInstructionsForASINResponse
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
        $response = $xpath->query("//*[local-name()='GetPrepInstructionsForASINResponse']");
        if ($response->length == 1) {
            return new GetPrepInstructionsForASINResponse(($response->item(0)));
        } else {
            throw new Exception ("Unable to construct GetPrepInstructionsForASINResponse from provided XML. 
                                  Make sure that GetPrepInstructionsForASINResponse is a root element");
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
        $xml .= "<GetPrepInstructionsForASINResponse xmlns=\"http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</GetPrepInstructionsForASINResponse>";
        return $xml;
    }

}
