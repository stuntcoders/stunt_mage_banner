<?php

/**
 * @method Stuntcoders_Banner_Model_Banner getBanner()
 * @method Stuntcoders_Banner_Block_Banner setBanner(Stuntcoders_Banner_Model_Banner $banner)
 * @method string getCode()
 * @method Stuntcoders_Banner_Block_Banner setCode(string $code)
 */
class Stuntcoders_Banner_Block_Banner extends Mage_Core_Block_Template
{
    public function getBannerUrl()
    {
        return $this->getBanner()->getUrl();
    }

    public function getBannerImage()
    {
        return $this->getBanner()->getImage();
    }

    public function getText()
    {
        return $this->getBanner()->getText();
    }

    public function getHeading()
    {
        return $this->getBanner()->getHeading();
    }

    public function canOpenInNewTab()
    {
        return $this->getBanner()->getOpenInNewTab();
    }

    protected function _toHtml()
    {
        $this->setBanner(Mage::getModel('stuntcoders_banner/banner'));
        if ($this->getCode()) {
            $this->getBanner()->load($this->getCode(), 'code');
        }

        return parent::_toHtml();
    }
}
