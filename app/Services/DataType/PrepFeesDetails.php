<?php

namespace App\Services\DataType;

class PrepFeesDetails extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'PrepInstruction' => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'FeePerUnit'      => [ 'FieldValue' => null, 'FieldType' => 'Amount' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the PrepInstruction property.
     *
     * @return String PrepInstruction.
     */
    public function getPrepInstruction()
    {
        return $this->_fields['PrepInstruction']['FieldValue'];
    }

    /**
     * Set the value of the PrepInstruction property.
     *
     * @param string prepInstruction
     * @return this instance
     */
    public function setPrepInstruction($value)
    {
        $this->_fields['PrepInstruction']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PrepInstruction is set.
     *
     * @return true if PrepInstruction is set.
     */
    public function isSetPrepInstruction()
    {
        return !is_null($this->_fields['PrepInstruction']['FieldValue']);
    }

    /**
     * Set the value of PrepInstruction, return this.
     *
     * @param prepInstruction
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPrepInstruction($value)
    {
        $this->setPrepInstruction($value);
        return $this;
    }

    /**
     * Get the value of the FeePerUnit property.
     *
     * @return Amount FeePerUnit.
     */
    public function getFeePerUnit()
    {
        return $this->_fields['FeePerUnit']['FieldValue'];
    }

    /**
     * Set the value of the FeePerUnit property.
     *
     * @param Amount feePerUnit
     * @return this instance
     */
    public function setFeePerUnit($value)
    {
        $this->_fields['FeePerUnit']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if FeePerUnit is set.
     *
     * @return true if FeePerUnit is set.
     */
    public function isSetFeePerUnit()
    {
        return !is_null($this->_fields['FeePerUnit']['FieldValue']);
    }

    /**
     * Set the value of FeePerUnit, return this.
     *
     * @param feePerUnit
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withFeePerUnit($value)
    {
        $this->setFeePerUnit($value);
        return $this;
    }

}
