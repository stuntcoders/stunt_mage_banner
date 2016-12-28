<?php

/**
 * @method Stuntcoders_Banner_Model_Banner_Group getGroup()
 * @method Stuntcoders_Banner_Model_Banner_Group setGroup(Stuntcoders_Banner_Model_Banner_Group $group)
 * @method string getCode()
 * @method Stuntcoders_Banner_Block_Banner_Group setCode(string $code)
 */
class Stuntcoders_Banner_Block_Banner_Group extends Mage_Core_Block_Template
{
    protected function _toHtml()
    {
        $this->setGroup(Mage::getModel('stuntcoders_banner/banner_group'));
        if ($this->getCode()) {
            $this->getGroup()->load($this->getCode(), 'code');
        }

        return parent::_toHtml();
    }
}
