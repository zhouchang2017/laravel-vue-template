<?php

namespace App\Services\DataType;


class GetInboundGuidanceForSKUResult extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'SKUInboundGuidanceList' => [ 'FieldValue' => null, 'FieldType' => 'SKUInboundGuidanceList' ],
            'InvalidSKUList'         => [ 'FieldValue' => null, 'FieldType' => 'InvalidSKUList' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the SKUInboundGuidanceList property.
     *
     * @return SKUInboundGuidanceList SKUInboundGuidanceList.
     */
    public function getSKUInboundGuidanceList()
    {
        return $this->_fields['SKUInboundGuidanceList']['FieldValue'];
    }

    /**
     * Set the value of the SKUInboundGuidanceList property.
     *
     * @param SKUInboundGuidanceList skuInboundGuidanceList
     * @return this instance
     */
    public function setSKUInboundGuidanceList($value)
    {
        $this->_fields['SKUInboundGuidanceList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SKUInboundGuidanceList is set.
     *
     * @return true if SKUInboundGuidanceList is set.
     */
    public function isSetSKUInboundGuidanceList()
    {
        return !is_null($this->_fields['SKUInboundGuidanceList']['FieldValue']);
    }

    /**
     * Set the value of SKUInboundGuidanceList, return this.
     *
     * @param skuInboundGuidanceList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSKUInboundGuidanceList($value)
    {
        $this->setSKUInboundGuidanceList($value);
        return $this;
    }

    /**
     * Get the value of the InvalidSKUList property.
     *
     * @return InvalidSKUList InvalidSKUList.
     */
    public function getInvalidSKUList()
    {
        return $this->_fields['InvalidSKUList']['FieldValue'];
    }

    /**
     * Set the value of the InvalidSKUList property.
     *
     * @param InvalidSKUList invalidSKUList
     * @return this instance
     */
    public function setInvalidSKUList($value)
    {
        $this->_fields['InvalidSKUList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if InvalidSKUList is set.
     *
     * @return true if InvalidSKUList is set.
     */
    public function isSetInvalidSKUList()
    {
        return !is_null($this->_fields['InvalidSKUList']['FieldValue']);
    }

    /**
     * Set the value of InvalidSKUList, return this.
     *
     * @param invalidSKUList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withInvalidSKUList($value)
    {
        $this->setInvalidSKUList($value);
        return $this;
    }

}
