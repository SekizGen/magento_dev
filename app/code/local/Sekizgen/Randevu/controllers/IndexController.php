<?php

class Sekizgen_Randevu_IndexController extends Mage_Adminhtml_Controller_Action
{

    const XML_PATH_ENABLED  = 'sekizgen_randevu/randevu/enabled';
    const XML_PATH_ATTRIBUTESET  = 'sekizgen_randevu/randevu/attributeset';
    const PATH_TO_BUTTON  = 'adminhtml/system_config/edit/section/sekizgen_randevu';

    
    public function updateAction()
    {
	    if(!Mage::getStoreConfigFlag(self::XML_PATH_ENABLED)){
		    $message = $this->__('Adding appointment custom option is not enabled!');
		    Mage::getSingleton('core/session')->addError($message);
		    $this->_redirect(self::PATH_TO_BUTTON);
		    return;
	    }
	    
	    if(!Mage::getStoreConfig(self::XML_PATH_ATTRIBUTESET)){
		    $message = $this->__('Select at least one attribute set!');
		    Mage::getSingleton('core/session')->addError($message);
		    $this->_redirect(self::PATH_TO_BUTTON);
		    return;
	    }
	    
        $config_options = explode(",",Mage::getStoreConfig(self::XML_PATH_ATTRIBUTESET));
		foreach($config_options as $config_option)
		{
		    $products = Mage::getModel('catalog/product')->getCollection()->addFieldToFilter('attribute_set_id',$config_option);
		    foreach($products as $product)
			    $product->save();
		}		    
	    
	    $message = $this->__('Update is successfull.');
	    Mage::getSingleton('core/session')->addSuccess($message);
        $this->_redirect(self::PATH_TO_BUTTON);
    }
}