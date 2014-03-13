<?php

class locationsController extends Controller {

       function view($name) {

           $gateway = new PlaceGateway();
           //$places = $gateway->findAll();

           $this->set('places', $gateway->findAll());

           /*foreach($places as $key => $place)
           $this->set('place'.$key,$place);*/

           //$this->set('phrase', 'test de la phrase '.$name );
           $this->render('view');
       }
}