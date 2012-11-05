<?php
 
class Sekizgen_Lastikview_Block_Adminhtml_Countyselection extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_countyselection';
        $this->_blockGroup = 'sekizgen_lastikview';
        $this->_headerText = Mage::helper('sekizgen_lastikview')->__('County Selections');
        //$this->_addButtonLabel = Mage::helper('sekizgen_lastikview')->__('Add Item');
        parent::__construct();
        $this->removeButton('add');
    }
}