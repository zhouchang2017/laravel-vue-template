<?php

namespace App\Services\DataType;


class PartneredLtlDataInput extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'Contact'             => [ 'FieldValue' => null, 'FieldType' => 'Contact' ],
            'BoxCount'            => [ 'FieldValue' => null, 'FieldType' => 'int' ],
            'SellerFreightClass'  => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'FreightReadyDate'    => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'PalletList'          => [ 'FieldValue' => null, 'FieldType' => 'PalletList' ],
            'TotalWeight'         => [ 'FieldValue' => null, 'FieldType' => 'Weight' ],
            'SellerDeclaredValue' => [ 'FieldValue' => null, 'FieldType' => 'Amount' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the Contact property.
     *
     * @return Contact Contact.
     */
    public function getContact()
    {
        return $this->_fields['Contact']['FieldValue'];
    }

    /**
     * Set the value of the Contact property.
     *
     * @param Contact contact
     * @return this instance
     */
    public function setContact($value)
    {
        $this->_fields['Contact']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if Contact is set.
     *
     * @return true if Contact is set.
     */
    public function isSetContact()
    {
        return !is_null($this->_fields['Contact']['FieldValue']);
    }

    /**
     * Set the value of Contact, return this.
     *
     * @param contact
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withContact($value)
    {
        $this->setContact($value);
        return $this;
    }

    /**
     * Get the value of the BoxCount property.
     *
     * @return Long BoxCount.
     */
    public function getBoxCount()
    {
        return $this->_fields['BoxCount']['FieldValue'];
    }

    /**
     * Set the value of the BoxCount property.
     *
     * @param int boxCount
     * @return this instance
     */
    public function setBoxCount($value)
    {
        $this->_fields['BoxCount']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if BoxCount is set.
     *
     * @return true if BoxCount is set.
     */
    public function isSetBoxCount()
    {
        return !is_null($this->_fields['BoxCount']['FieldValue']);
    }

    /**
     * Set the value of BoxCount, return this.
     *
     * @param boxCount
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withBoxCount($value)
    {
        $this->setBoxCount($value);
        return $this;
    }

    /**
     * Get the value of the SellerFreightClass property.
     *
     * @return String SellerFreightClass.
     */
    public function getSellerFreightClass()
    {
        return $this->_fields['SellerFreightClass']['FieldValue'];
    }

    /**
     * Set the value of the SellerFreightClass property.
     *
     * @param string sellerFreightClass
     * @return this instance
     */
    public function setSellerFreightClass($value)
    {
        $this->_fields['SellerFreightClass']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SellerFreightClass is set.
     *
     * @return true if SellerFreightClass is set.
     */
    public function isSetSellerFreightClass()
    {
        return !is_null($this->_fields['SellerFreightClass']['FieldValue']);
    }

    /**
     * Set the value of SellerFreightClass, return this.
     *
     * @param sellerFreightClass
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSellerFreightClass($value)
    {
        $this->setSellerFreightClass($value);
        return $this;
    }

    /**
     * Get the value of the FreightReadyDate property.
     *
     * @return String FreightReadyDate.
     */
    public function getFreightReadyDate()
    {
        return $this->_fields['FreightReadyDate']['FieldValue'];
    }

    /**
     * Set the value of the FreightReadyDate property.
     *
     * @param string freightReadyDate
     * @return this instance
     */
    public function setFreightReadyDate($value)
    {
        $this->_fields['FreightReadyDate']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if FreightReadyDate is set.
     *
     * @return true if FreightReadyDate is set.
     */
    public function isSetFreightReadyDate()
    {
        return !is_null($this->_fields['FreightReadyDate']['FieldValue']);
    }

    /**
     * Set the value of FreightReadyDate, return this.
     *
     * @param freightReadyDate
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withFreightReadyDate($value)
    {
        $this->setFreightReadyDate($value);
        return $this;
    }

    /**
     * Get the value of the PalletList property.
     *
     * @return PalletList PalletList.
     */
    public function getPalletList()
    {
        return $this->_fields['PalletList']['FieldValue'];
    }

    /**
     * Set the value of the PalletList property.
     *
     * @param PalletList palletList
     * @return this instance
     */
    public function setPalletList($value)
    {
        $this->_fields['PalletList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PalletList is set.
     *
     * @return true if PalletList is set.
     */
    public function isSetPalletList()
    {
        return !is_null($this->_fields['PalletList']['FieldValue']);
    }

    /**
     * Set the value of PalletList, return this.
     *
     * @param palletList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPalletList($value)
    {
        $this->setPalletList($value);
        return $this;
    }

    /**
     * Get the value of the TotalWeight property.
     *
     * @return Weight TotalWeight.
     */
    public function getTotalWeight()
    {
        return $this->_fields['TotalWeight']['FieldValue'];
    }

    /**
     * Set the value of the TotalWeight property.
     *
     * @param Weight totalWeight
     * @return this instance
     */
    public function setTotalWeight($value)
    {
        $this->_fields['TotalWeight']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if TotalWeight is set.
     *
     * @return true if TotalWeight is set.
     */
    public function isSetTotalWeight()
    {
        return !is_null($this->_fields['TotalWeight']['FieldValue']);
    }

    /**
     * Set the value of TotalWeight, return this.
     *
     * @param totalWeight
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withTotalWeight($value)
    {
        $this->setTotalWeight($value);
        return $this;
    }

    /**
     * Get the value of the SellerDeclaredValue property.
     *
     * @return Amount SellerDeclaredValue.
     */
    public function getSellerDeclaredValue()
    {
        return $this->_fields['SellerDeclaredValue']['FieldValue'];
    }

    /**
     * Set the value of the SellerDeclaredValue property.
     *
     * @param Amount sellerDeclaredValue
     * @return this instance
     */
    public function setSellerDeclaredValue($value)
    {
        $this->_fields['SellerDeclaredValue']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SellerDeclaredValue is set.
     *
     * @return true if SellerDeclaredValue is set.
     */
    public function isSetSellerDeclaredValue()
    {
        return !is_null($this->_fields['SellerDeclaredValue']['FieldValue']);
    }

    /**
     * Set the value of SellerDeclaredValue, return this.
     *
     * @param sellerDeclaredValue
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSellerDeclaredValue($value)
    {
        $this->setSellerDeclaredValue($value);
        return $this;
    }

}
