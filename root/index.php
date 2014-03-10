<?php
    //(1) On inclut la classe de Google Maps pour générer ensuite la carte.
    require_once '../maps/GoogleMapAPIv3.class.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <style type="text/css">
        body {
            margin: 10px; /* pour eviter les marges */
            text-align: center; /* pour corriger le bug de centrage IE */
            width: 1000px;
        }
        #global {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
        #route {
            height: 130px;
            overflow-y: auto;
        }
        #map {
            float: left;
        }
        #options {
            width: 350px;
            float: left;
            padding: 0 10px 10px 10px;
            text-align: left;
        }
        .panel {
            background-color: #E8ECF9;
            border: 1px dashed black;
            padding: 5px;
            margin: 10px 0 10px 0;
        }
        .titre {
            text-align: left;
            font-weight: bold;
            margin: 0 0 5px 0;
        }

        .inputTxt {
            width: 100px;
        }
    </style>
    <title>Ma première carte Google Maps</title>
</head>

<body>
    <div id="global">
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
            $gmap->setSize('600px','600px');
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
        <div id="options">
            <span class="titre">Informations : </span>
            <div class="panel">
                Lat : <input type="text" id="lat" class="inputTxt" onClick="" value=""/>
                Lng : <input type="text" id="lng" class="inputTxt" onClick="" value=""/>
            </div>
        </div>
    </div>
</body>

</html>