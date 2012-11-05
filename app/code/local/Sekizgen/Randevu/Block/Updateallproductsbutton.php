<?php 
class Sekizgen_Randevu_Block_Updateallproductsbutton extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $url = $this->getUrl('sekizgen_randevu/index/update'); //

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setType('button')
                    ->setClass('scalable')
                    ->setLabel('Update All Products')
                    ->setOnClick("setLocation('$url')")
                    ->toHtml();

        return $html;
    }
}