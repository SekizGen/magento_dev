<?php
 
class Sekizgen_Lastikview_Block_Adminhtml_Countyselection_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('countySelectionGrid');
        // This is the primary key of the database
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sekizgen_lastikview/countyselection')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'    => Mage::helper('sekizgen_lastikview')->__('ID'),
            'align'     =>'right',
            'index'     => 'id',
        ));

        $this->addColumn('county_code', array(
            'header'    => Mage::helper('sekizgen_lastikview')->__('County Code'),
            'align'     =>'left',
            'index'     => 'county_code',
        ));

        $this->addColumn('product_entity_id', array(
            'header'    => Mage::helper('sekizgen_lastikview')->__('Product id'),
            'align'     =>'right',
            'index'     => 'product_entity_id',
        ));

        $this->addColumn('customer_entity_id', array(
            'header'    => Mage::helper('sekizgen_lastikview')->__('Customer id'),
            'align'     =>'right',
            'index'     => 'customer_entity_id',
        ));

        $this->addColumn('time', array(
            'header'    => Mage::helper('sekizgen_lastikview')->__('Time'),
            'align'     =>'left',
            'index'     => 'time',
        ));

        $this->addColumn('ip', array(
            'header'    => Mage::helper('sekizgen_lastikview')->__('IP'),
            'align'     =>'left',
            'index'     => 'ip',
        ));

        $this->addColumn('tel', array(
            'header'    => Mage::helper('sekizgen_lastikview')->__('TEL'),
            'align'     =>'left',
            'index'     => 'tel',
        ));
 
 
		$this->addExportType('*/*/exportCsv', Mage::helper('sekizgen_lastikview')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('sekizgen_lastikview')->__('XML'));

        return parent::_prepareColumns();
    }
 
    
    //public function getRowUrl($row)
    //{
    //    return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    //}
 
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
 
 
}