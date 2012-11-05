<?php
 
class Sekizgen_Lastikview_Adminhtml_CountyselectionController extends Mage_Adminhtml_Controller_Action
{
 
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('sekizgen_lastikview/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
   
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('sekizgen_lastikview/adminhtml_countyselection'));
        $this->renderLayout();
    }
 
    
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('sekizgen_lastikview/adminhtml_countyselection_grid')->toHtml()
        );
    }
    
    
    public function exportCsvAction()
    {
        $fileName   = 'countyselection.csv';
        $content    = $this->getLayout()->createBlock('sekizgen_lastikview/adminhtml_countyselection_grid')
            ->getCsv();
 
        $this->_prepareDownloadResponse($fileName, $content);
    }
 
    public function exportXmlAction()
    {
        $fileName   = 'countyselection.xml';
        $content    = $this->getLayout()->createBlock('sekizgen_lastikview/adminhtml_countyselection_grid')
            ->getXml();
 
        $this->_prepareDownloadResponse($fileName, $content);
    }
    
}