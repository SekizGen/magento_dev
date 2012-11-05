<?php

class Sekizgen_Randevu_Model_System_Config_Source_Attributeset
{
    protected $_options;

    public function toOptionArray($isMultiselect=false)
    {
        if (!$this->_options) {
            $this->_options = Mage::getResourceModel('eav/entity_attribute_set_collection')->setEntityTypeFilter(4)->loadData()->toOptionArray(false);
        }

        $options = $this->_options;
        if(!$isMultiselect){
            array_unshift($options, array('value'=>'', 'label'=> Mage::helper('adminhtml')->__('--Please Select--')));
        }

        return $options;
    }
}
