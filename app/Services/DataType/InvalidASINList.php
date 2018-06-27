<?php

namespace App\Services\DataType;

class InvalidASINList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'InvalidASIN' => [ 'FieldValue' => [], 'FieldType' => [ 'InvalidASIN' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the InvalidASIN property.
     *
     * @return List<InvalidASIN> InvalidASIN.
     */
    public function getInvalidASIN()
    {
        if ($this->_fields['InvalidASIN']['FieldValue'] == null) {
            $this->_fields['InvalidASIN']['FieldValue'] = [];
        }
        return $this->_fields['InvalidASIN']['FieldValue'];
    }

    /**
     * Set the value of the InvalidASIN property.
     *
     * @param array invalidASIN
     * @return this instance
     */
    public function setInvalidASIN($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['InvalidASIN']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear InvalidASIN.
     */
    public function unsetInvalidASIN()
    {
        $this->_fields['InvalidASIN']['FieldValue'] = [];
    }

    /**
     * Check to see if InvalidASIN is set.
     *
     * @return true if InvalidASIN is set.
     */
    public function isSetInvalidASIN()
    {
        return !empty($this->_fields['InvalidASIN']['FieldValue']);
    }

    /**
     * Add values for InvalidASIN, return this.
     *
     * @param invalidASIN
     *             New values to add.
     *
     * @return This instance.
     */
    public function withInvalidASIN()
    {
        foreach (func_get_args() as $InvalidASIN) {
            $this->_fields['InvalidASIN']['FieldValue'][] = $InvalidASIN;
        }
        return $this;
    }

}
