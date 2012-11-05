<?php
class Sekizgen_Lastikview_Block_Fitting extends Mage_Core_Block_Template
{
  public function getProduct()
  {
    if (!Mage::registry('product') && $this->getProductId()) 
    {
      $product = Mage::getModel('catalog/product')->load($this->getProductId());
      Mage::register('product', $product);
    }
    return Mage::registry('product');
  }

  protected function getLabel($ArrayCountryCodesDetails,$value)
  {
    foreach($ArrayCountryCodesDetails as $ArrayCountryCodesDetail)
    {
      if($ArrayCountryCodesDetail['option_id']==$value)
      {
       return $ArrayCountryCodesDetail['value']; 
      }
    }
    return -1;
  }

  protected function attributeValues($arg_attribute)
  {
    $attribute_model        = Mage::getModel('eav/entity_attribute');
    $attribute_options_model= Mage::getModel('eav/entity_attribute_source_table') ;

    $attribute_code         = $attribute_model->getIdByCode('catalog_product', $arg_attribute);
    $attribute              = $attribute_model->load($attribute_code);

    $attribute_table        = $attribute_options_model->setAttribute($attribute);
    $options                = $attribute_options_model->getAllOptions(false);

    return $options;
  }


  public function getFittingOptionsArray()
  {
    $result = '';

    $FittingTypes = $this->attributeValues('fitting_type');
    $CountryCodes = $this->attributeValues('county_code');
    $CountryCodesDetails = Mage::getResourceModel('eav/entity_attribute_option_collection')->setStoreFilter(1)->load()->getData('county_code');


    $FittingTypesIndex = 0;
    foreach($FittingTypes as $FittingType)
    {
     $result .= 'fittingtypes['.$FittingTypesIndex.'] = new Array(\''.$FittingType['value'].'\',\''.$FittingType['label'].'\');'; 
     $FittingTypesIndex++;
    }
    
    
    $CountryCodesIndex = 0;
    foreach($CountryCodes as $CountryCode)
    {
      $sonuc = $this->getLabel($CountryCodesDetails,$CountryCode['value']);
      if($sonuc != -1)
      {      
        list($sehir,$ilce) = explode('-',$sonuc);
        $result .= 'cities['.$CountryCodesIndex.'] = new Array(\''.$CountryCode['value'].'\',\''.$sehir.'\',\''.substr($CountryCode['label'],0,10).'\');'; 
        $result .= 'counties['.$CountryCodesIndex.'] = new Array(\''.$CountryCode['value'].'\',\''.$sehir.'\',\''.$ilce.'\',\''.$CountryCode['label'].'\');'; 
        $CountryCodesIndex++;
      }
    }
    

    $storeId = Mage::app()->getStore()->getId();

    $bundled_product = new Mage_Catalog_Model_Product();        
    $bundled_product = $this->getProduct();
    $selectionCollection = $bundled_product->getTypeInstance(true)->getSelectionsCollection($bundled_product->getTypeInstance(true)->getOptionsIds($bundled_product), $bundled_product);

    $SimpleProductsIndex = 0;
    foreach($selectionCollection as $option) 
    {
      $_product_Simple = Mage::getModel('catalog/product')->load($option->product_id);
      $_product_Simple_name = $_product_Simple->getName();
            
      $locations = ','.$_product_Simple->getData('county_code').',';

      $enlem = $_product_Simple->getData('enlem');
      $boylam = $_product_Simple->getData('boylam');
      $fitting_type = $_product_Simple->getData('fitting_type');



      $fitting_label = '';
      foreach($FittingTypes as $FittingType)
      {
        if($FittingType['value']==$fitting_type)
        {
          $fitting_label = $FittingType['label'];
          break;
        }
      }


      $price = number_format($_product_Simple->getPrice(),2);
      $webprice = number_format($_product_Simple->getwebprice(),2);
      $specialprice = number_format($_product_Simple->getFinalPrice(),2);
      $selectionPrice = number_format($option->selection_price_value,2);


      $result .= 'simpleproducts['.$SimpleProductsIndex.'] = new Array(\''.$option->selection_id.'\',\''.$_product_Simple_name.'\',\''.$locations.'\',\''.$enlem.'\',\''.$boylam.'\',\''.$price.'\',\''.$webprice.'\',\''.$specialprice.'\',\''.$selectionPrice.'\',\''.$fitting_type.'\',\''.$fitting_label.'\');'; 
      $SimpleProductsIndex++;
    }




    //sepetteki ürünler
    $CartIndex = 0;
    $cartItems = Mage::getSingleton('checkout/session')->getQuote()->getAllItems();
    foreach($cartItems as $item) 
    {
      $_product_Simple = Mage::getModel('catalog/product')->load($item->getProductId());
      $fitting_type = $_product_Simple->getData('fitting_type');


      $fitting_label = '';
      foreach($FittingTypes as $FittingType)
      {
        if($FittingType['value']==$fitting_type)
        {
          $fitting_label = $FittingType['label'];
          break;
        }
      }

      $result .= 'currentcart['.$CartIndex.'] = new Array(\''.$item->getProductId().'\',\''.$item->getName().'\',\''.$fitting_type.'\',\''.$fitting_label.'\');'; 
      $CartIndex++;
    }
    
    

    return $result;			
  }      
	
}
?>