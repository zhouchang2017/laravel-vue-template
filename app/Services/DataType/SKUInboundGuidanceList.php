<?php

namespace App\Services\DataType;

class SKUInboundGuidanceList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'SKUInboundGuidance' => [ 'FieldValue' => [], 'FieldType' => [ 'SKUInboundGuidance' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the SKUInboundGuidance property.
     *
     * @return List<SKUInboundGuidance> SKUInboundGuidance.
     */
    public function getSKUInboundGuidance()
    {
        if ($this->_fields['SKUInboundGuidance']['FieldValue'] == null) {
            $this->_fields['SKUInboundGuidance']['FieldValue'] = [];
        }
        return $this->_fields['SKUInboundGuidance']['FieldValue'];
    }

    /**
     * Set the value of the SKUInboundGuidance property.
     *
     * @param array skuInboundGuidance
     * @return this instance
     */
    public function setSKUInboundGuidance($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['SKUInboundGuidance']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear SKUInboundGuidance.
     */
    public function unsetSKUInboundGuidance()
    {
        $this->_fields['SKUInboundGuidance']['FieldValue'] = [];
    }

    /**
     * Check to see if SKUInboundGuidance is set.
     *
     * @return true if SKUInboundGuidance is set.
     */
    public function isSetSKUInboundGuidance()
    {
        return !empty($this->_fields['SKUInboundGuidance']['FieldValue']);
    }

    /**
     * Add values for SKUInboundGuidance, return this.
     *
     * @param skuInboundGuidance
     *             New values to add.
     *
     * @return This instance.
     */
    public function withSKUInboundGuidance()
    {
        foreach (func_get_args() as $SKUInboundGuidance) {
            $this->_fields['SKUInboundGuidance']['FieldValue'][] = $SKUInboundGuidance;
        }
        return $this;
    }

}
