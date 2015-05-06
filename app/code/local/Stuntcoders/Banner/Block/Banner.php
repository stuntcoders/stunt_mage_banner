<?php

class Stuntcoders_Banner_Block_Banner extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('stuntcoders/banner/banner.phtml');
    }

    public function getBannerUrl()
    {
        if (!$this->hasBanner()) {
            $this->_loadBanner();
        }

        return $this->getBanner()->getUrl();
    }

    public function getBannerImage()
    {
        if (!$this->hasBanner()) {
            $this->_loadBanner();
        }

        return $this->getBanner()->getImage();
    }

    public function getText()
    {
        if (!$this->hasBanner()) {
            $this->_loadBanner();
        }

        return $this->getBanner()->getText();
    }

    public function getTitle()
    {
        if (!$this->hasBanner()) {
            $this->_loadBanner();
        }

        return $this->getBanner()->getHeading();
    }

    public function canOpenInNewTab()
    {
        if (!$this->hasBanner()) {
            $this->_loadBanner();
        }

        return $this->getBanner()->getOpenInNewTab();
    }

    protected function _loadBanner()
    {
        $this->setBanner(Mage::getModel('stuntcoders_banner/banner'));
        if ($this->getId()) {
            $this->getBanner()->load($this->getId());
        } else if ($this->getCode()) {
            $this->getBanner()->load($this->getCode(), 'code');
        }

        return $this;
    }
}
