<?php

namespace App\Services\DataType;

class PrepFeesDetailsList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'AmazonPrepFeesDetails' => [ 'FieldValue' => [], 'FieldType' => [ 'AmazonPrepFeesDetails' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the AmazonPrepFeesDetails property.
     *
     * @return List<AmazonPrepFeesDetails> AmazonPrepFeesDetails.
     */
    public function getAmazonPrepFeesDetails()
    {
        if ($this->_fields['AmazonPrepFeesDetails']['FieldValue'] == null) {
            $this->_fields['AmazonPrepFeesDetails']['FieldValue'] = [];
        }
        return $this->_fields['AmazonPrepFeesDetails']['FieldValue'];
    }

    /**
     * Set the value of the AmazonPrepFeesDetails property.
     *
     * @param array amazonPrepFeesDetails
     * @return this instance
     */
    public function setAmazonPrepFeesDetails($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['AmazonPrepFeesDetails']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear AmazonPrepFeesDetails.
     */
    public function unsetAmazonPrepFeesDetails()
    {
        $this->_fields['AmazonPrepFeesDetails']['FieldValue'] = [];
    }

    /**
     * Check to see if AmazonPrepFeesDetails is set.
     *
     * @return true if AmazonPrepFeesDetails is set.
     */
    public function isSetAmazonPrepFeesDetails()
    {
        return !empty($this->_fields['AmazonPrepFeesDetails']['FieldValue']);
    }

    /**
     * Add values for AmazonPrepFeesDetails, return this.
     *
     * @param amazonPrepFeesDetails
     *             New values to add.
     *
     * @return This instance.
     */
    public function withAmazonPrepFeesDetails()
    {
        foreach (func_get_args() as $AmazonPrepFeesDetails) {
            $this->_fields['AmazonPrepFeesDetails']['FieldValue'][] = $AmazonPrepFeesDetails;
        }
        return $this;
    }

}
