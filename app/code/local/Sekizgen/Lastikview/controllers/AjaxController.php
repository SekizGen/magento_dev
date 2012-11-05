<?php
class Sekizgen_Lastikview_AjaxController extends Mage_Core_Controller_Front_Action 
{
    public function indexAction() 
    {
            
      $countycode = $_REQUEST['countycode'];
      $productid = $_REQUEST['productid'];
      $customerid = $_REQUEST['customerid'];
      $tel = $_REQUEST['tel'];


      function get_real_IP_address()
      {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
        {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
        {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
      }


      $data = array('county_code'=>$countycode,'product_entity_id'=>$productid,'customer_entity_id'=>$customerid,'ip'=>get_real_IP_address(),'tel'=>$tel);
      $model = Mage::getModel('sekizgen_lastikview/countyselection')->setData($data);
      try 
      {
        $insertId = $model->save()->getId();
        echo 'ok';
      }
      catch (Exception $e)
      {
        echo $e->getMessage();  
      }


    }
}
?>