<?php

class Stuntcoders_Banner_Block_Adminhtml_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_headerText = $this->__('Manage Banners');
        $this->_addButtonLabel = $this->__('Add New Banner');
        $this->_blockGroup = 'stuntcoders_banner';
        $this->_controller = 'adminhtml_index';

        parent::__construct();
    }
}
