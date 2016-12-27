<?php

class Stuntcoders_Banner_Model_Banner extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner');
    }

    /**
     * @return bool
     */
    public function getOpenInNewTab()
    {
        return (bool) $this->getData('open_in_new_tab');
    }

    /**
     * @return Stuntcoders_Banner_Model_Banner
     */
    protected function _afterLoad()
    {
        if ($imageName = $this->getImage()) {
            $this->setImage($this->_getHelper()->getBaseMediaUrl() . $imageName);
            $this->setImageName($imageName);
        }

        return parent::_afterLoad();
    }

    /**
     * @return Stuntcoders_Banner_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('stuntcoders_banner');
    }
}
