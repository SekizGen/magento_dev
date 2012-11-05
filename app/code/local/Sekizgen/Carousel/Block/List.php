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
class Sekizgen_Carousel_Block_List
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
        $config = $this->getData('enabled_services');
        if (empty($config)) 
        {
            return $html;
        }
        
        
        $products_count = $this->getData('products_count');
        $featured_category = $this->getData('featured_category');
        $timer = $this->getData('timer');
        
        $services = explode(',', $config);
        $list = array();
        foreach ($services as $service) 
        {
            $item = $this->_generateServiceLink($service,$products_count,$featured_category,$timer);
            if ($item) 
            {
                $list[] = $item;
            }
        }
        $this->assign('list', $list);
        return parent::_toHtml();
    }


    protected function _prepareLayout() 
    {
        if ($head = $this->getLayout()->getBlock('head')) 
        {
            echo '<link rel="stylesheet" type="text/css" href="'.$this->getSkinUrl('plugins/tinycarousel/tinycarousel.css').'" media="all" />';
            echo '<script type="text/javascript" src="'.$this->getSkinUrl('plugins/tinycarousel/jquery.tinycarousel.js').'"></script>';
        }
        return parent::_prepareLayout();
    }




    protected function _generateServiceLink($service,$products_count,$featured_category,$timer)
    {
        if(!$products_count){ $products_count=0; }
        

        $productsArray = array();
        
        if($service=='mostviewed') 
        {     
          $today = time();
          $last = $today - (60*60*24*30);

          $from = date("Y-m-d", $last);
          $to = date("Y-m-d", $today);

          $storeId = Mage::app()->getStore()->getId();
          $products = Mage::getResourceModel('reports/product_collection')
          ->addOrderedQty()
          ->addAttributeToSelect('*')
          ->addAttributeToSelect(array('name', 'price', 'small_image'))
          ->setStoreId($storeId)
          ->addStoreFilter($storeId)
          ->addViewsCount()
          ->addAttributeToFilter('status', 1)
          ->addAttributeToFilter('visibility', 4)
          ->setPageSize($products_count) // limit number of results returned
          ->setCurPage(0);
          //->addViewsCount($from, $to);

          Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
          Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);

          $this->setProductCollection($products);


          if (($_products = $this->getProductCollection()) && $_products->getSize())
          {
            foreach ($_products->getItems() as $_product)
            { 
              $price = number_format($_product->getPrice(),2).' TL';
              $productUrl = $_product->getProductUrl();
              $imageLabel = $this->htmlEscape($this->getImageLabel($_product, 'small_image'));
              $productLabel = $this->htmlEscape($_product->getName());
              $imageSrc = (string)Mage::helper('catalog/image')->init($_product, 'image')->resize(140);   
              
              array_push($productsArray,array('price'=>$price, 'productUrl'=>$productUrl, 'imageLabel'=>$imageLabel, 'imageSrc'=>$imageSrc, 'productLabel'=>$productLabel));
            }  
          }  
        }
        else if($service=='featured')
        {
          $storeId = Mage::app()->getStore()->getId();
          $category = Mage::getModel('catalog/category')->load($featured_category); // category 4

          $products = Mage::getModel('catalog/product')
          ->getCollection()
          ->addAttributeToSelect('*') // select all attributes
          ->addAttributeToSelect(array('name', 'price', 'small_image'))
          ->addCategoryFilter($category)
          ->setPageSize($products_count) // limit number of results returned
          ->setCurPage(0)
          ->load();

          Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
          Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);

          $this->setProductCollection($products);    


          if (($_products = $this->getProductCollection()) && $_products->getSize())
          {
            foreach ($_products->getItems() as $_product)
            { 
              $price = number_format($_product->getPrice(),2).' TL';
              $productUrl = $_product->getProductUrl();
              $imageLabel = $this->htmlEscape($this->getImageLabel($_product, 'small_image'));
              $productLabel = $this->htmlEscape($_product->getName());
              $imageSrc = (string)Mage::helper('catalog/image')->init($_product, 'image')->resize(140);   
              //$urllabel = $this->stripTags($_product->getName(), null, true);
              array_push($productsArray,array('price'=>$price, 'productUrl'=>$productUrl, 'imageLabel'=>$imageLabel, 'imageSrc'=>$imageSrc, 'productLabel'=>$productLabel));
            }  
          }      
        
        }


        $item = array(
            'products_count' => $products_count,
            'data' => $productsArray,
            'service' => $service,
            'featured_category' => $featured_category,
            'timer' => $timer,
        );
        //$this->getSkinUrl("images/" . $icon)

        return $item;
    }

}     