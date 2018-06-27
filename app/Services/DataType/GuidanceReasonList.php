<?php

namespace App\Services\DataType;

class GuidanceReasonList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'GuidanceReason' => [ 'FieldValue' => [], 'FieldType' => [ 'string' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the GuidanceReason property.
     *
     * @return List<String> GuidanceReason.
     */
    public function getGuidanceReason()
    {
        if ($this->_fields['GuidanceReason']['FieldValue'] == null) {
            $this->_fields['GuidanceReason']['FieldValue'] = [];
        }
        return $this->_fields['GuidanceReason']['FieldValue'];
    }

    /**
     * Set the value of the GuidanceReason property.
     *
     * @param array guidanceReason
     * @return this instance
     */
    public function setGuidanceReason($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['GuidanceReason']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear GuidanceReason.
     */
    public function unsetGuidanceReason()
    {
        $this->_fields['GuidanceReason']['FieldValue'] = [];
    }

    /**
     * Check to see if GuidanceReason is set.
     *
     * @return true if GuidanceReason is set.
     */
    public function isSetGuidanceReason()
    {
        return !empty($this->_fields['GuidanceReason']['FieldValue']);
    }

    /**
     * Add values for GuidanceReason, return this.
     *
     * @param guidanceReason
     *             New values to add.
     *
     * @return This instance.
     */
    public function withGuidanceReason()
    {
        foreach (func_get_args() as $GuidanceReason) {
            $this->_fields['GuidanceReason']['FieldValue'][] = $GuidanceReason;
        }
        return $this;
    }

}
