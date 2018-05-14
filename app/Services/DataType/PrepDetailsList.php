<?php

namespace App\Services\DataType;

class PrepDetailsList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'PrepDetails' => [ 'FieldValue' => [], 'FieldType' => [ 'PrepDetails' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the PrepDetails property.
     *
     * @return List<PrepDetails> PrepDetails.
     */
    public function getPrepDetails()
    {
        if ($this->_fields['PrepDetails']['FieldValue'] == null) {
            $this->_fields['PrepDetails']['FieldValue'] = [];
        }
        return $this->_fields['PrepDetails']['FieldValue'];
    }

    /**
     * Set the value of the PrepDetails property.
     *
     * @param array prepDetails
     * @return this instance
     */
    public function setPrepDetails($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['PrepDetails']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear PrepDetails.
     */
    public function unsetPrepDetails()
    {
        $this->_fields['PrepDetails']['FieldValue'] = [];
    }

    /**
     * Check to see if PrepDetails is set.
     *
     * @return true if PrepDetails is set.
     */
    public function isSetPrepDetails()
    {
        return !empty($this->_fields['PrepDetails']['FieldValue']);
    }

    /**
     * Add values for PrepDetails, return this.
     *
     * @param prepDetails
     *             New values to add.
     *
     * @return This instance.
     */
    public function withPrepDetails()
    {
        foreach (func_get_args() as $PrepDetails) {
            $this->_fields['PrepDetails']['FieldValue'][] = $PrepDetails;
        }
        return $this;
    }

}
