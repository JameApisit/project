<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RudyController extends AbstractActionController
{
    public function rudyAction()
    {
      echo 'Rudy';
      exit();
      //return new ViewModel(); //เรียกหน้า view ตามที่ config ใน module.config.php
    }

    public function searchstringAction(){

      $number=3;
      $math=2;
      for($i=0; $i<=6; $i++){
        if($i==0){
          echo $number.',';
        }else{
          $data=2*$i;
          $number=$number+$data;
          if($i!=6){
            echo $number.',';
          }else{
            echo $number;
          }
        }
      }
      exit();
    }

    public function searchrestaurantAction(){

      $url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=13.8234866,100.5081204&radius=1500&type=restaurant&keyword=restaurant&key=Key';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_TIMEOUT, 5);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $json = curl_exec($ch);
      if(curl_error($ch)) { 
      echo 'error:' . curl_error($ch);
      };
      curl_close($ch);
      $data = json_decode($json,true);
      //echo '<pre>';
      //print_r($data['results']);

      $array=array();
      foreach($data['results'] AS $key => $r){
        
        array_push($array,[
                            'lat'=>$r['geometry']['location']['lat'],
                            'lng'=>$r['geometry']['location']['lng'],
                            'icon'=>$r['icon'],
                            'id'=>$r['id'],
                            'name'=>$r['name'],
                            'place_id'=>$r['place_id'],
                            'rating'=>$r['rating'],
                            'reference'=>$r['reference'],
                            'scope'=>$r['scope'],
                            'user_ratings_total'=>$r['user_ratings_total'],
                            'vicinity'=>$r['vicinity']

                          ]);
      }

      echo json_encode($array,true);
      exit();
    }

    
    
}
