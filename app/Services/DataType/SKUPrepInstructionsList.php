<?php

namespace App\Services\DataType;

class SKUPrepInstructionsList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'SKUPrepInstructions' => [ 'FieldValue' => [], 'FieldType' => [ 'SKUPrepInstructions' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the SKUPrepInstructions property.
     *
     * @return List<SKUPrepInstructions> SKUPrepInstructions.
     */
    public function getSKUPrepInstructions()
    {
        if ($this->_fields['SKUPrepInstructions']['FieldValue'] == null) {
            $this->_fields['SKUPrepInstructions']['FieldValue'] = [];
        }
        return $this->_fields['SKUPrepInstructions']['FieldValue'];
    }

    /**
     * Set the value of the SKUPrepInstructions property.
     *
     * @param array skuPrepInstructions
     * @return this instance
     */
    public function setSKUPrepInstructions($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['SKUPrepInstructions']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear SKUPrepInstructions.
     */
    public function unsetSKUPrepInstructions()
    {
        $this->_fields['SKUPrepInstructions']['FieldValue'] = [];
    }

    /**
     * Check to see if SKUPrepInstructions is set.
     *
     * @return true if SKUPrepInstructions is set.
     */
    public function isSetSKUPrepInstructions()
    {
        return !empty($this->_fields['SKUPrepInstructions']['FieldValue']);
    }

    /**
     * Add values for SKUPrepInstructions, return this.
     *
     * @param skuPrepInstructions
     *             New values to add.
     *
     * @return This instance.
     */
    public function withSKUPrepInstructions()
    {
        foreach (func_get_args() as $SKUPrepInstructions) {
            $this->_fields['SKUPrepInstructions']['FieldValue'][] = $SKUPrepInstructions;
        }
        return $this;
    }

}
