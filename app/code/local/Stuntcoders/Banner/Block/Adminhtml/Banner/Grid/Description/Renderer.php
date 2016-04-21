<?php

class Stuntcoders_Banner_Block_Adminhtml_Banner_Grid_Description_Renderer
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return Mage::helper('core/string')->truncate($row['text']);
    }
}
