<?php

/**
 * @method string getCode()
 * @method Stuntcoders_Banner_Model_Banner setCode(string $code)
 * @method string getUrl()
 * @method Stuntcoders_Banner_Model_Banner setUrl(string $url)
 * @method string getImageName()
 * @method Stuntcoders_Banner_Model_Banner setImageName(string $name)
 * @method string getImage()
 * @method Stuntcoders_Banner_Model_Banner setImage(string $image)
 * @method string getContent()
 * @method Stuntcoders_Banner_Model_Banner setContent(string $text)
 * @method string getTitle()
 * @method Stuntcoders_Banner_Model_Banner setTitle(string $heading)
 * @method int getSortOrder()
 * @method Stuntcoders_Banner_Model_Banner setSortOrder(int $sortOrder)
 * @method int|null getGroupId()
 * @method Stuntcoders_Banner_Model_Banner setGroupId(int $group)
 */
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
