<?php

namespace App\Services\DataType;

class InboundShipmentPlanRequestItemList extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'member' => [ 'FieldValue' => [], 'FieldType' => [ 'InboundShipmentPlanRequestItem' ] ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the member property.
     *
     * @return List<InboundShipmentPlanRequestItem> member.
     */
    public function getmember()
    {
        if ($this->_fields['member']['FieldValue'] == null) {
            $this->_fields['member']['FieldValue'] = [];
        }
        return $this->_fields['member']['FieldValue'];
    }

    /**
     * Set the value of the member property.
     *
     * @param array member
     * @return this instance
     */
    public function setmember($value)
    {
        if ( !$this->_isNumericArray($value)) {
            $value = [ $value ];
        }
        $this->_fields['member']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Clear member.
     */
    public function unsetmember()
    {
        $this->_fields['member']['FieldValue'] = [];
    }

    /**
     * Check to see if member is set.
     *
     * @return true if member is set.
     */
    public function isSetmember()
    {
        return !empty($this->_fields['member']['FieldValue']);
    }

    /**
     * Add values for member, return this.
     *
     * @param member
     *             New values to add.
     *
     * @return This instance.
     */
    public function withmember()
    {
        foreach (func_get_args() as $member) {
            $this->_fields['member']['FieldValue'][] = $member;
        }
        return $this;
    }

}
