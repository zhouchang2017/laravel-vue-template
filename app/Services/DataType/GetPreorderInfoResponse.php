<?php

namespace App\Services\DataType;

class GetPreorderInfoResponse extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'GetPreorderInfoResult'  => [ 'FieldValue' => null, 'FieldType' => 'GetPreorderInfoResult' ],
            'ResponseMetadata'       => [ 'FieldValue' => null, 'FieldType' => 'ResponseMetadata' ],
            'ResponseHeaderMetadata' => [ 'FieldValue' => null, 'FieldType' => 'ResponseHeaderMetadata' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the GetPreorderInfoResult property.
     *
     * @return GetPreorderInfoResult GetPreorderInfoResult.
     */
    public function getGetPreorderInfoResult()
    {
        return $this->_fields['GetPreorderInfoResult']['FieldValue'];
    }

    /**
     * Set the value of the GetPreorderInfoResult property.
     *
     * @param GetPreorderInfoResult getPreorderInfoResult
     * @return this instance
     */
    public function setGetPreorderInfoResult($value)
    {
        $this->_fields['GetPreorderInfoResult']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if GetPreorderInfoResult is set.
     *
     * @return true if GetPreorderInfoResult is set.
     */
    public function isSetGetPreorderInfoResult()
    {
        return !is_null($this->_fields['GetPreorderInfoResult']['FieldValue']);
    }

    /**
     * Set the value of GetPreorderInfoResult, return this.
     *
     * @param getPreorderInfoResult
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withGetPreorderInfoResult($value)
    {
        $this->setGetPreorderInfoResult($value);
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
     * Construct GetPreorderInfoResponse from XML string
     *
     * @param $xml
     *        XML string to construct from
     *
     * @return GetPreorderInfoResponse
     */
    public static function fromXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        $xpath = new DOMXPath($dom);
        $response = $xpath->query("//*[local-name()='GetPreorderInfoResponse']");
        if ($response->length == 1) {
            return new GetPreorderInfoResponse(($response->item(0)));
        } else {
            throw new Exception ("Unable to construct GetPreorderInfoResponse from provided XML. 
                                  Make sure that GetPreorderInfoResponse is a root element");
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
        $xml .= "<GetPreorderInfoResponse xmlns=\"http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/\">";
        $xml .= $this->_toXMLFragment();
        $xml .= "</GetPreorderInfoResponse>";
        return $xml;
    }

}
