<?php

namespace App\Services\DataType;

class SKUPrepInstructions extends Base
{

    public function __construct($data = null)
    {
        $this->_fields = [
            'SellerSKU'                 => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'ASIN'                      => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'BarcodeInstruction'        => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'PrepGuidance'              => [ 'FieldValue' => null, 'FieldType' => 'string' ],
            'PrepInstructionList'       => [ 'FieldValue' => null, 'FieldType' => 'PrepInstructionList' ],
            'AmazonPrepFeesDetailsList' => [ 'FieldValue' => null, 'FieldType' => 'AmazonPrepFeesDetailsList' ],
        ];
        parent::__construct($data);
    }

    /**
     * Get the value of the SellerSKU property.
     *
     * @return String SellerSKU.
     */
    public function getSellerSKU()
    {
        return $this->_fields['SellerSKU']['FieldValue'];
    }

    /**
     * Set the value of the SellerSKU property.
     *
     * @param string sellerSKU
     * @return this instance
     */
    public function setSellerSKU($value)
    {
        $this->_fields['SellerSKU']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if SellerSKU is set.
     *
     * @return true if SellerSKU is set.
     */
    public function isSetSellerSKU()
    {
        return !is_null($this->_fields['SellerSKU']['FieldValue']);
    }

    /**
     * Set the value of SellerSKU, return this.
     *
     * @param sellerSKU
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withSellerSKU($value)
    {
        $this->setSellerSKU($value);
        return $this;
    }

    /**
     * Get the value of the ASIN property.
     *
     * @return String ASIN.
     */
    public function getASIN()
    {
        return $this->_fields['ASIN']['FieldValue'];
    }

    /**
     * Set the value of the ASIN property.
     *
     * @param string asin
     * @return this instance
     */
    public function setASIN($value)
    {
        $this->_fields['ASIN']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if ASIN is set.
     *
     * @return true if ASIN is set.
     */
    public function isSetASIN()
    {
        return !is_null($this->_fields['ASIN']['FieldValue']);
    }

    /**
     * Set the value of ASIN, return this.
     *
     * @param asin
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withASIN($value)
    {
        $this->setASIN($value);
        return $this;
    }

    /**
     * Get the value of the BarcodeInstruction property.
     *
     * @return String BarcodeInstruction.
     */
    public function getBarcodeInstruction()
    {
        return $this->_fields['BarcodeInstruction']['FieldValue'];
    }

    /**
     * Set the value of the BarcodeInstruction property.
     *
     * @param string barcodeInstruction
     * @return this instance
     */
    public function setBarcodeInstruction($value)
    {
        $this->_fields['BarcodeInstruction']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if BarcodeInstruction is set.
     *
     * @return true if BarcodeInstruction is set.
     */
    public function isSetBarcodeInstruction()
    {
        return !is_null($this->_fields['BarcodeInstruction']['FieldValue']);
    }

    /**
     * Set the value of BarcodeInstruction, return this.
     *
     * @param barcodeInstruction
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withBarcodeInstruction($value)
    {
        $this->setBarcodeInstruction($value);
        return $this;
    }

    /**
     * Get the value of the PrepGuidance property.
     *
     * @return String PrepGuidance.
     */
    public function getPrepGuidance()
    {
        return $this->_fields['PrepGuidance']['FieldValue'];
    }

    /**
     * Set the value of the PrepGuidance property.
     *
     * @param string prepGuidance
     * @return this instance
     */
    public function setPrepGuidance($value)
    {
        $this->_fields['PrepGuidance']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PrepGuidance is set.
     *
     * @return true if PrepGuidance is set.
     */
    public function isSetPrepGuidance()
    {
        return !is_null($this->_fields['PrepGuidance']['FieldValue']);
    }

    /**
     * Set the value of PrepGuidance, return this.
     *
     * @param prepGuidance
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPrepGuidance($value)
    {
        $this->setPrepGuidance($value);
        return $this;
    }

    /**
     * Get the value of the PrepInstructionList property.
     *
     * @return PrepInstructionList PrepInstructionList.
     */
    public function getPrepInstructionList()
    {
        return $this->_fields['PrepInstructionList']['FieldValue'];
    }

    /**
     * Set the value of the PrepInstructionList property.
     *
     * @param PrepInstructionList prepInstructionList
     * @return this instance
     */
    public function setPrepInstructionList($value)
    {
        $this->_fields['PrepInstructionList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if PrepInstructionList is set.
     *
     * @return true if PrepInstructionList is set.
     */
    public function isSetPrepInstructionList()
    {
        return !is_null($this->_fields['PrepInstructionList']['FieldValue']);
    }

    /**
     * Set the value of PrepInstructionList, return this.
     *
     * @param prepInstructionList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withPrepInstructionList($value)
    {
        $this->setPrepInstructionList($value);
        return $this;
    }

    /**
     * Get the value of the AmazonPrepFeesDetailsList property.
     *
     * @return AmazonPrepFeesDetailsList AmazonPrepFeesDetailsList.
     */
    public function getAmazonPrepFeesDetailsList()
    {
        return $this->_fields['AmazonPrepFeesDetailsList']['FieldValue'];
    }

    /**
     * Set the value of the AmazonPrepFeesDetailsList property.
     *
     * @param AmazonPrepFeesDetailsList amazonPrepFeesDetailsList
     * @return this instance
     */
    public function setAmazonPrepFeesDetailsList($value)
    {
        $this->_fields['AmazonPrepFeesDetailsList']['FieldValue'] = $value;
        return $this;
    }

    /**
     * Check to see if AmazonPrepFeesDetailsList is set.
     *
     * @return true if AmazonPrepFeesDetailsList is set.
     */
    public function isSetAmazonPrepFeesDetailsList()
    {
        return !is_null($this->_fields['AmazonPrepFeesDetailsList']['FieldValue']);
    }

    /**
     * Set the value of AmazonPrepFeesDetailsList, return this.
     *
     * @param amazonPrepFeesDetailsList
     *             The new value to set.
     *
     * @return This instance.
     */
    public function withAmazonPrepFeesDetailsList($value)
    {
        $this->setAmazonPrepFeesDetailsList($value);
        return $this;
    }

}
