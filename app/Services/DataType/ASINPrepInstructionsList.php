<?php

namespace App\Services\DataType;


class ASINPrepInstructionsList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'ASINPrepInstructions' => [ 'FieldValue' => [], 'FieldType' => [ 'ASINPrepInstructions' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the ASINPrepInstructions property.
     *
     * @return List<ASINPrepInstructions> ASINPrepInstructions.
     */
    public function getASINPrepInstructions()
    {
        if ($this->_fields['ASINPrepInstructions']['FieldValue'] == null) {
            $this->_fields['ASINPrepInstructions']['FieldValue'] = [];
        }
        return $this->_fields['ASINPrepInstructions']['FieldValue'];
    }

    /**
     * Set the value of the ASINPrepInstructions property.
     *
     * @param array asinPrepInstructions
     * @return this instance
     */
    public function setASINPrepInstructions($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['ASINPrepInstructions']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear ASINPrepInstructions.
     */
    public function unsetASINPrepInstructions()
    {
        $this->_fields['ASINPrepInstructions']['FieldValue'] = [];
    }

    /**
     * Check to see if ASINPrepInstructions is set.
     *
     * @return true if ASINPrepInstructions is set.
     */
    public function isSetASINPrepInstructions()
    {
        return !empty($this->_fields['ASINPrepInstructions']['FieldValue']);
    }

    /**
     * Add values for ASINPrepInstructions, return this.
     *
     * @param asinPrepInstructions
     *             New values to add.
     *
     * @return This instance.
     */
    public function withASINPrepInstructions()
    {
        foreach (func_get_args() as $ASINPrepInstructions) {
            $this->_fields['ASINPrepInstructions']['FieldValue'][] = $ASINPrepInstructions;
        }
        return $this;
    }

}
