<?php

/**
 * @method string getName()
 * @method Stuntcoders_Banner_Model_Banner_Group setName(string $name)
 * @method string getCode()
 * @method Stuntcoders_Banner_Model_Banner_Group setCode(string $code)
 */
class Stuntcoders_Banner_Model_Banner_Group extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner_group');
    }

    /**
     * @return array
     */
    public function getSelectOptionValues()
    {
        $collections = $this->getCollection();

        $groups = array();
        foreach ($collections as $group) {
            $groups[] = array(
                'label' => $group->getName(),
                'value' => $group->getId()
            );
        }

        array_unshift($groups, array(
            'label' => Mage::helper('stuntcoders_banner')->__('-- Please select banner group --'),
            'value' => null
        ));

        return $groups;
    }

    /**
     * @return array
     */
    public function getGroupOptionValues()
    {
        $groups = array();
        foreach ($this->getCollection() as $group) {
            $groups[$group->getId()] = $group->getName();
        }

        return $groups;
    }

    public function getIdByCode($code)
    {
        return $this->_getResource()->getIdByCode($code);
    }

    /**
     * @return Stuntcoders_Banner_Model_Resource_Banner_Collection
     */
    public function getBannerCollection()
    {
        return Mage::getResourceModel('stuntcoders_banner/banner_collection')
            ->addGroupFilter($this->getId());
    }
}
