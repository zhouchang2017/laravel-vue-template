<?php

namespace App\Services\DataType;


class InvalidASIN extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'ASIN'        => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'ErrorReason' => [ 'FieldValue' => null, 'FieldType' => 'string' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the ASIN property.
     *
     * @return String ASIN.
     */
    public function getASIN()
    {
        return $this->_fields['ASIN']['FieldValue'];
    }

    /**
     * Set the value of the ASIN property.
     *
     * @param string asin
     * @return this instance
     */
    public function setASIN($value)
    {
        $this->_fields['ASIN']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ASIN is set.
     *
     * @return true if ASIN is set.
     */
    public function isSetASIN()
    {
        return !is_null($this->_fields['ASIN']['FieldValue']);
    }

    /**
     * Set the value of ASIN, return this.
     *
     * @param asin
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withASIN($value)
    {
        $this->setASIN($value);
        return $this;
    }

    /**
     * Get the value of the ErrorReason property.
     *
     * @return String ErrorReason.
     */
    public function getErrorReason()
    {
        return $this->_fields['ErrorReason']['FieldValue'];
    }

    /**
     * Set the value of the ErrorReason property.
     *
     * @param string errorReason
     * @return this instance
     */
    public function setErrorReason($value)
    {
        $this->_fields['ErrorReason']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ErrorReason is set.
     *
     * @return true if ErrorReason is set.
     */
    public function isSetErrorReason()
    {
        return !is_null($this->_fields['ErrorReason']['FieldValue']);
    }

    /**
     * Set the value of ErrorReason, return this.
     *
     * @param errorReason
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withErrorReason($value)
    {
        $this->setErrorReason($value);
        return $this;
    }

}
