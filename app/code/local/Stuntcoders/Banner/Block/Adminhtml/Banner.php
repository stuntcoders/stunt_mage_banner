<?php

class Stuntcoders_Banner_Block_Adminhtml_Banner extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_headerText = Mage::helper('stuntcoders_banner')->__('Banner Manager');
        parent::__construct();
        $this->setTemplate('stuntcoders/banner/banners.phtml');
    }

    protected function _prepareLayout()
    {
        $this->setChild('add_new_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('stuntcoders_banner')->__('Add Banner'),
                    'onclick'   => "setLocation('" . $this->getUrl('*/*/add') . "')",
                    'class'     => 'add'
                ))
        );

        $this->setChild('grid', $this->getLayout()->createBlock('stuntcoders_banner/adminhtml_banner_grid'));
    }

    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('add_new_button');
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

}
