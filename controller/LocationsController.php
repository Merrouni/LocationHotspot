<?php

class locationsController extends Controller {

       function view($name) {
           $this->set('phrase', 'test de la phrase '.$name);
           $this->render('index');
       }
}