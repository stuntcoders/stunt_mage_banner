<?php

class Stuntcoders_Banner_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getBaseMediaPath()
    {
        return Mage::getBaseDir('media') . DS . 'stuntcoders' . DS . 'banner' . DS;
    }

    public function getBaseMediaUrl()
    {
        return Mage::getBaseUrl('media') . 'stuntcoders/banner/';
    }
}
