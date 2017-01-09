<?php

class Stuntcoders_Banner_Block_Adminhtml_Group_New extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_headerText = $this->__('Add New Banner Group');
        $this->_mode = 'new';
        $this->_blockGroup = 'stuntcoders_banner';
        $this->_controller = 'adminhtml_group';

        parent::__construct();
    }

    /**
     * @return string
     */
    public function getFormScripts()
    {
        return $this->getChildHtml('form.scripts');
    }

    /**
     * @return Stuntcoders_Banner_Block_Adminhtml_Group_New
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->_addBannersGrid();
        $this->_addFormScripts();

        return $this;
    }

    protected function _addBannersGrid()
    {
        /** @var Stuntcoders_Banner_Block_Adminhtml_Group_New_Form $form */
        $form = $this->getChild('form');

        if ($form) {
            /** @var Stuntcoders_Banner_Block_Adminhtml_Group_Banners $block */
            $block = $this->getLayout()->createBlock('stuntcoders_banner/adminhtml_group_banners');

            $form->setChild('form_after', $block);
        }
    }

    protected function _addFormScripts()
    {
        /** @var Mage_Core_Block_Template $block */
        $block = $this->getLayout()
            ->createBlock('core/template')
            ->setTemplate('stuntcoders/banner/group/new/scripts.phtml');

        $this->setChild('form.scripts', $block);
    }
}
