<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Sample
 * @package     Sample_WidgetTwo
 * @copyright   Copyright (c) 2009 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */


/**
 * Widget which displays the social bookmarking services list
 *
 * @category    Sample
 * @package     Sample_WidgetTwo
 * @author      Magento Core Team <core@magentocommerce.com>
 
 
 
 
 
$price = Mage_Catalog_Block_Product::getPriceHtml($_product, true);
$price = str_replace('class="regular-price"','class="regular-price" style="color:#fff;"',$price);
$price = str_replace('class="price"','class="price" style="color:#fff;"',$price);

//$price = (string)Mage::helper('core')->currency($_products->getPrice());

$model = Mage::getModel('catalog/product') //getting product model

$_product = $model->load($productid); //getting product object for particular product id

echo $_product->getShortDescription(); //product's short description
echo $_product->getDescription(); // product's long description
echo $_product->getName(); //product name
echo $_product->getPrice(); //product's regular Price
echo $_product->getSpecialPrice(); //product's special Price
echo $_product->getProductUrl(); //product url
echo $_product->getImageUrl(); //product's image url
echo $_product->getSmallImageUrl(); //product's small image url
echo $_product->getThumbnailUrl(); //product's thumbnail image url  



 


//$this->getLayout()->getBlock('head')->addCss('plugins/tinycarousel/tinycarousel.css');
//$this->getLayout()->getBlock('head')->addJs('plugins/tinycarousel/jquery.tinycarousel.js');


//$head->addItem('css','plugins/tinycarousel/tinycarousel.css');
//$head->addItem('js','plugins/tinycarousel/jquery.tinycarousel.js');


//$head->addCss('plugins/tinycarousel/tinycarousel.css');
// $head->addJs('plugins/tinycarousel/jquery.tinycarousel.js');


 
 
*/
?>
<?php
class Sekizgen_Search_Block_List
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{

    /**
     * A model to serialize attributes
     * @var Varien_Object
     */
    protected $_serializer = null;

    /**
     * Initialization
     */
    protected function _construct()
    {
        $this->_serializer = new Varien_Object();
        parent::_construct();
    }

    /**
     * Produces links list html
     *
     * @return string
     */
    protected function _toHtml()
    {
        $html = '';


        $search_url = $this->getData('search_url');


        $list = array();
        $item = $this->_generateServiceLink($search_url);
        if ($item) 
        {
            $list[] = $item;
        }
        
        $this->assign('list', $list);
        return parent::_toHtml();
    }


    protected function _prepareLayout() 
    {
        if ($head = $this->getLayout()->getBlock('head')) 
        {
            echo '<link rel="stylesheet" type="text/css" href="'.$this->getSkinUrl().'/plugins/jqtransform/jqtransform.css" media="all" />';
            echo '<script type="text/javascript" src="'.$this->getSkinUrl().'/plugins/jqtransform/jquery.jqtransform.js"></script>';
        }
        return parent::_prepareLayout();
    }




    protected function _generateServiceLink($search_url)
    {       
        $widthArray = array();
        $ratioArray = array();
        $radiusArray = array();
        $speedArray = array();

        
        $product = Mage::getModel('catalog/product');      
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter($product->getResource()->getTypeId())->addFieldToFilter('attribute_code', 'width');
        $attribute = $attributes->getFirstItem()->setEntity($product->getResource());
        $arrays = $attribute->getSource()->getAllOptions(false);

        foreach ($arrays as $x)
        {
          array_push($widthArray,array('value'=>$x["value"], 'label'=>$x["label"]));
        }
                
                
        $product = Mage::getModel('catalog/product');      
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter($product->getResource()->getTypeId())->addFieldToFilter('attribute_code', 'ratio');
        $attribute = $attributes->getFirstItem()->setEntity($product->getResource());
        $arrays = $attribute->getSource()->getAllOptions(false);

        foreach ($arrays as $x)
        {
          array_push($ratioArray,array('value'=>$x["value"], 'label'=>$x["label"]));
        }   
   
                
        $product = Mage::getModel('catalog/product');      
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter($product->getResource()->getTypeId())->addFieldToFilter('attribute_code', 'radius');
        $attribute = $attributes->getFirstItem()->setEntity($product->getResource());
        $arrays = $attribute->getSource()->getAllOptions(false);

        foreach ($arrays as $x)
        {
          array_push($radiusArray,array('value'=>$x["value"], 'label'=>$x["label"]));
        }   

                
        $product = Mage::getModel('catalog/product');      
        $attributes = Mage::getResourceModel('eav/entity_attribute_collection')->setEntityTypeFilter($product->getResource()->getTypeId())->addFieldToFilter('attribute_code', 'speed_index');
        $attribute = $attributes->getFirstItem()->setEntity($product->getResource());
        $arrays = $attribute->getSource()->getAllOptions(false);

        foreach ($arrays as $x)
        {
          array_push($speedArray,array('value'=>$x["value"], 'label'=>$x["label"]));
        }       
        
        
        $item = array(
            'width' => $widthArray,
            'ratio' => $ratioArray,
            'radius' => $radiusArray,
            'speed' => $speedArray,
            'url' => $search_url,
        );

        return $item;
    }

} 