<?php

class Stuntcoders_Banner_Block_Adminhtml_Banner_Grid_Image_Renderer
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if (empty($row['image'])) {
            return "<div class=\"a-center\">{$this->__('-- No image --')}</div>";

        }

        $url = Mage::helper('stuntcoders_banner')->getBaseMediaUrl() . $row['image'];

        return "<img src=\"{$url}\" width=\"100\"/>";
    }
}
