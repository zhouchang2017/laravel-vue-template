<?php

namespace App\Services\DataType;


class ASINInboundGuidanceList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'ASINInboundGuidance' => [ 'FieldValue' => [], 'FieldType' => [ 'ASINInboundGuidance' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the ASINInboundGuidance property.
     *
     * @return List<ASINInboundGuidance> ASINInboundGuidance.
     */
    public function getASINInboundGuidance()
    {
        if ($this->_fields['ASINInboundGuidance']['FieldValue'] == null) {
            $this->_fields['ASINInboundGuidance']['FieldValue'] = [];
        }
        return $this->_fields['ASINInboundGuidance']['FieldValue'];
    }

    /**
     * Set the value of the ASINInboundGuidance property.
     *
     * @param array asinInboundGuidance
     * @return this instance
     */
    public function setASINInboundGuidance($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['ASINInboundGuidance']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear ASINInboundGuidance.
     */
    public function unsetASINInboundGuidance()
    {
        $this->_fields['ASINInboundGuidance']['FieldValue'] = [];
    }

    /**
     * Check to see if ASINInboundGuidance is set.
     *
     * @return true if ASINInboundGuidance is set.
     */
    public function isSetASINInboundGuidance()
    {
        return !empty($this->_fields['ASINInboundGuidance']['FieldValue']);
    }

    /**
     * Add values for ASINInboundGuidance, return this.
     *
     * @param asinInboundGuidance
     *             New values to add.
     *
     * @return This instance.
     */
    public function withASINInboundGuidance()
    {
        foreach (func_get_args() as $ASINInboundGuidance) {
            $this->_fields['ASINInboundGuidance']['FieldValue'][] = $ASINInboundGuidance;
        }
        return $this;
    }

}
