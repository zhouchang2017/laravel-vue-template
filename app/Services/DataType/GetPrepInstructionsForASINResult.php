<?php

namespace App\Services\DataType;

class GetPrepInstructionsForASINResult extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'ASINPrepInstructionsList' => [ 'FieldValue' => null, 'FieldType' => 'ASINPrepInstructionsList' ],
            'InvalidASINList'          => [ 'FieldValue' => null, 'FieldType' => 'InvalidASINList' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the ASINPrepInstructionsList property.
     *
     * @return ASINPrepInstructionsList ASINPrepInstructionsList.
     */
    public function getASINPrepInstructionsList()
    {
        return $this->_fields['ASINPrepInstructionsList']['FieldValue'];
    }

    /**
     * Set the value of the ASINPrepInstructionsList property.
     *
     * @param ASINPrepInstructionsList asinPrepInstructionsList
     * @return this instance
     */
    public function setASINPrepInstructionsList($value)
    {
        $this->_fields['ASINPrepInstructionsList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ASINPrepInstructionsList is set.
     *
     * @return true if ASINPrepInstructionsList is set.
     */
    public function isSetASINPrepInstructionsList()
    {
        return !is_null($this->_fields['ASINPrepInstructionsList']['FieldValue']);
    }

    /**
     * Set the value of ASINPrepInstructionsList, return this.
     *
     * @param asinPrepInstructionsList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withASINPrepInstructionsList($value)
    {
        $this->setASINPrepInstructionsList($value);
        return $this;
    }

    /**
     * Get the value of the InvalidASINList property.
     *
     * @return InvalidASINList InvalidASINList.
     */
    public function getInvalidASINList()
    {
        return $this->_fields['InvalidASINList']['FieldValue'];
    }

    /**
     * Set the value of the InvalidASINList property.
     *
     * @param InvalidASINList invalidASINList
     * @return this instance
     */
    public function setInvalidASINList($value)
    {
        $this->_fields['InvalidASINList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if InvalidASINList is set.
     *
     * @return true if InvalidASINList is set.
     */
    public function isSetInvalidASINList()
    {
        return !is_null($this->_fields['InvalidASINList']['FieldValue']);
    }

    /**
     * Set the value of InvalidASINList, return this.
     *
     * @param invalidASINList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withInvalidASINList($value)
    {
        $this->setInvalidASINList($value);
        return $this;
    }

}
