<?php
    //(1) On inclut la classe de Google Maps pour générer ensuite la carte.
    require_once '../maps/GoogleMapAPIv3.class.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Ma première carte Google Maps</title>
</head>

<body>
    <div id="map" onClick="document.getElementById('lat').value=getCurrentLat();document.getElementById('lng').value=getCurrentLng();">
        <?php

        $gmap = new GoogleMapAPI();
        $gmap->setDivId('test1');
        $gmap->setDirectionDivId('route');
        $gmap->setCenter('Nantes France');
        //$gmap->setCenterLatLng('2', '48');
        $gmap->setEnableWindowZoom(true);
        $gmap->setEnableAutomaticCenterZoom(true);
        $gmap->setDisplayDirectionFields(true);
        // $gmap->setClusterer(true);
        $gmap->setSize('1024px','670px');
        $gmap->setZoom(5);
        $gmap->setLang('fr');
        $gmap->setDefaultHideMarker(false);
        // $gmap->addDirection('nantes','paris');

        // cat1
       /*$coordtab = array();
        $coordtab []= array('nantes france','Nantes','<strong>html nantes</strong>');
        $coordtab []= array('carquefou france','Carquefou','<strong>html carquefou</strong>');
        $coordtab []= array('vertou france','Vertou','<strong>html vertou</strong>');
        $coordtab []= array('rezé france','Rezé','<strong>html rezé</strong>');
        // $gmap->setIconSize(20,34);
        $gmap->addArrayMarkerByAddress($coordtab,'cat1');*/

        // cat2
        /*$coordtab = array();
        $coordtab []= array('saint-herblain france','Saint-herblain','<strong>html saint-herblain</strong>');
        $coordtab []= array('bouguenais france','Bouguenais','<strong>html bouguenais</strong>');
        $coordtab []= array('orvault france','Orvault','<strong>html orvault</strong>');
        $gmap->addArrayMarkerByAddress($coordtab,'cat2');*/

        // cat3
        //$gmap->addMarkerByAddress('35 Rue de Roche Gènes, Aubière, France','hotspot 19','Hotspot 19');

        // cat4
        /*$coordtab = array();
        $coordtab []= array('48.8792','2.34778','test','<strong>test paris</strong>');
        $gmap->addArrayMarkerByCoords($coordtab,'cat4');*/

        $gmap->generate();
        echo $gmap->getGoogleMap();

        ?>
    </div>
</body>

</html>