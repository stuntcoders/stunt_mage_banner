<?php

class Stuntcoders_Banner_Block_Banner extends Mage_Core_Block_Template
{
    public function __construct()
    {
        if (!$this->getTemplate()) {
            $this->setTemplate('banner/banner.phtml');
        }
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

    protected function _loadBanner()
    {
        if ($this->getId()) {
            $this->setBanner(Mage::getModel('stuntcoders_banner/banner')->load($this->getId()));
        } else if ($this->getCode()) {
            $this->setBanner(Mage::getModel('stuntcoders_banner/banner')->load($this->getCode(), 'code'));
        }

        return $this;
    }
}
