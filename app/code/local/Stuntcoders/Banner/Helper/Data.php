<?php

class Stuntcoders_Banner_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return string
     */
    public function getBaseMediaPath()
    {
        return Mage::getBaseDir('media') . DS . 'stuntcoders' . DS . 'banner' . DS;
    }

    /**
     * @return string
     */
    public function getBaseMediaUrl()
    {
        return Mage::getBaseUrl('media') . 'stuntcoders/banner/';
    }
}
