<?php

class locationsController extends Controller {

       function view($name) {

           //$ip = $_SERVER['REMOTE_ADDR'];
           $ip = '176.31.98.71';
           $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

           //echo $ip.' : ';
           $myCoords = explode(',',$details->loc);
           //print_r($myCoords);

           //$this->set('myLat',$myCoords[0]);
           //$this->set('myLon',$myCoords[1]);

           $gateway = new PlaceGateway();
           //$places = $gateway->findAll();

           $this->set('places', $gateway->findClosestTo($myCoords[0],$myCoords[1],10000));

           /*foreach($places as $key => $place)
           $this->set('place'.$key,$place);*/

           //$this->set('phrase', 'test de la phrase '.$name );
           $this->render('view');
       }
}