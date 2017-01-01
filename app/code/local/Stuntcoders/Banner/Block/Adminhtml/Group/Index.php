<?php

class Stuntcoders_Banner_Block_Adminhtml_Group_Index extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_headerText = $this->__('Manage Banner Groups');
        $this->_addButtonLabel = $this->__('Add New Banner Group');
        $this->_blockGroup = 'stuntcoders_banner';
        $this->_controller = 'adminhtml_group_index';

        parent::__construct();
    }
}
