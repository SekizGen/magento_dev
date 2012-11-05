<?php
class Sekizgen_Search_AjaxController extends Mage_Core_Controller_Front_Action 
{
    public function indexAction() 
    {        
        $width = 0;
        $ratio = 0;
        $radius = 0;
        
        if(isset($_REQUEST['width']))
        {
          $width = $_REQUEST['width'];
        }
        else
        {
          $width = 0;
        }
        
        if(isset($_REQUEST['ratio']))
        {
          $ratio = $_REQUEST['ratio'];
        }
        else
        {
          $ratio = 0;
        }

        
        if(isset($_REQUEST['radius']))
        {
          $radius = $_REQUEST['radius'];
        }
        else
        {
          $radius = 0;
        }

        $attributeCode = '';
        $whereWidth = '';
        $whereRatio = '';
        $whereRadius = '';
        
       
        
        if($radius!='0' && $ratio!='0' && $width!='0')
        { 
          $attributeCode = 'speed_index';
          $whereWidth = array(array('attribute'=>'width','eq' => $width));  
          $whereRatio = array(array('attribute'=>'ratio','eq' => $ratio)); 
          $whereRadius = array(array('attribute'=>'radius','eq' => $radius)); 
        }
        else if($ratio!='0' && $width!='0')
        { 
          $attributeCode = 'radius';
          $whereWidth = array(array('attribute'=>'width','eq' => $width));  
          $whereRatio = array(array('attribute'=>'ratio','eq' => $ratio));  
        }
        else if($width!='0')
        { 
          $attributeCode = 'ratio'; 
          $whereWidth = array(array('attribute'=>'width','eq' => $width));  
        }


        $product = Mage::getModel('catalog/product');
        $productCollection = '';
        

        if($whereRadius!='')
        {
          $productCollection = $product->getCollection()->addAttributeToFilter($whereWidth)->addAttributeToFilter($whereRatio)->addAttributeToFilter($whereRadius)->addAttributeToSelect($attributeCode)->load();
        }              
        else if($whereRatio!='')
        {
          $productCollection = $product->getCollection()->addAttributeToFilter($whereWidth)->addAttributeToFilter($whereRatio)->addAttributeToSelect($attributeCode)->load();
        } 
        else if($whereWidth!='')
        {
          $productCollection = $product->getCollection()->addAttributeToFilter($whereWidth)->addAttributeToSelect($attributeCode);
        } 
        
           
        $_attributeSearch = Mage::getModel('eav/config')->getAttribute($product->getResource()->getEntityType(), $attributeCode)->getFrontend()->getSelectOptions();
        
        
        $unique = null;
        $sonuc = null;
        
        $unique = array();
        $sonuc = array();
        
        $sayac = 0;

        foreach ($productCollection as $x)
        {
          if(array_search($x[$attributeCode],$unique) === false)
          {
            foreach($_attributeSearch as $attributeSearch) 
            {
              if($attributeSearch['value']==$x[$attributeCode]) 
              {
                  $lbl = $attributeSearch['label'];
                  break;
              }
            }
            
            array_push($sonuc,array('value'=>$x[$attributeCode], 'label'=>$lbl));

            $unique[$sayac] = $x[$attributeCode];
            $sayac++;
          }
        }
      
      





        function sort_multi_array ($array, $key)
        {
          $keys = array();
          for ($i=1;$i<func_num_args();$i++) {
            $keys[$i-1] = func_get_arg($i);
          }

          // create a custom search function to pass to usort
          $func = function ($a, $b) use ($keys) {
            for ($i=0;$i<count($keys);$i++) {
              if ($a[$keys[$i]] != $b[$keys[$i]]) {
                return ($a[$keys[$i]] < $b[$keys[$i]]) ? -1 : 1;
              }
            }
            return 0;
          };

          usort($array, $func);

          return $array;
        }



      
        //array_multisort($sonuc['label'], SORT_NUMERIC, SORT_ASC);
      
        echo json_encode(sort_multi_array($sonuc,'label'));       
        

    }
}
?>