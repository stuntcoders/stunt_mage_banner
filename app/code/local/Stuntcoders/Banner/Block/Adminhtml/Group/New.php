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
}
