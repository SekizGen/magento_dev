<?php
    class Sekizgen_Randevu_Model_Observer {

	    const XML_PATH_ENABLED  = 'sekizgen_randevu/randevu/enabled';
	    const XML_PATH_ATTRIBUTESET  = 'sekizgen_randevu/randevu/attributeset';

	    
	    public function hasRandevuOption($product)
	    {
			//$options = $product->getProductOptions();
			$options = $product->getOptions();
			if(!$options)
				return false;
			foreach($options as $option)
			{
				//if($option['sku'] == '_randevu')
				if($option->getData('title') == 'Randevu')
					return true;
			}		    
			return false;
	    }

	    public function isProductsAttributeSetEnabled($product)
	    {
	        $config_options = explode(",",Mage::getStoreConfig(self::XML_PATH_ATTRIBUTESET));

			foreach($config_options as $config_option)
			{
				if($config_option == $product->getAttributeSetId())
					return true;
			}		    
			return false;
	    }


	    public function addRandevuOption($observer)
	    {
	        $product = $observer->getEvent()->getProduct();
	        if($this->hasRandevuOption($product) || !$product->getId() || !Mage::getStoreConfigFlag(self::XML_PATH_ENABLED) || !$this->isProductsAttributeSetEnabled($product) )
	        	return $this;
	        	
			$optionData= array(
				'previous_group'    => 'text',
				'title' => 'Randevu',
				'type' => 'date_time',
				'is_require' => 0,
				'sort_order' => 0,
				'price'      => 0,
				'price_type' => 'fixed',					
				'sku'      => ''
			);


	        $product->setHasOptions(1);
	        $option = Mage::getModel('catalog/product_option')
	                  ->setProductId($product->getId())
	                  ->setStoreId($product->getStoreId())
	                  ->addData($optionData);
	        $option->save();
	        //$product->addOption($option);		

			return $this;			    
			
	    }
	    
	    
	    /*
	    public function getAttributeSetName()
	    {
	        if ($setId = $this->getProduct()->getAttributeSetId()) {
	            $set = Mage::getModel('eav/entity_attribute_set')
	                ->load($setId);
	            return $set->getAttributeSetName();
	        }
	        return '';
	    }*/	    
	    
	    
    }