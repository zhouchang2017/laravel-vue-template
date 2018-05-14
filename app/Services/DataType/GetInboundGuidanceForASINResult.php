<?php

namespace App\Services\DataType;


class GetInboundGuidanceForASINResult extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'ASINInboundGuidanceList' => [ 'FieldValue' => null, 'FieldType' => 'ASINInboundGuidanceList' ],
            'InvalidASINList'         => [ 'FieldValue' => null, 'FieldType' => 'InvalidASINList' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the ASINInboundGuidanceList property.
     *
     * @return ASINInboundGuidanceList ASINInboundGuidanceList.
     */
    public function getASINInboundGuidanceList()
    {
        return $this->_fields['ASINInboundGuidanceList']['FieldValue'];
    }

    /**
     * Set the value of the ASINInboundGuidanceList property.
     *
     * @param ASINInboundGuidanceList asinInboundGuidanceList
     * @return this instance
     */
    public function setASINInboundGuidanceList($value)
    {
        $this->_fields['ASINInboundGuidanceList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ASINInboundGuidanceList is set.
     *
     * @return true if ASINInboundGuidanceList is set.
     */
    public function isSetASINInboundGuidanceList()
    {
        return !is_null($this->_fields['ASINInboundGuidanceList']['FieldValue']);
    }

    /**
     * Set the value of ASINInboundGuidanceList, return this.
     *
     * @param asinInboundGuidanceList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withASINInboundGuidanceList($value)
    {
        $this->setASINInboundGuidanceList($value);
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
