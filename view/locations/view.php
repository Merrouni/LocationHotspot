<?php
//.'willdurand'.DS.'geocoder'.DS.'src'.DS.
//require ROOT.DS.'vendor'.DS.'autoload.php';

$title_for_layout = 'Internet Hotspots';
?>

<style type="text/css">
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
        padding: 5px;
        margin: 10px 0 10px 0;
    }
    .gmnoprint img {
        max-width: none;
    }
</style>

<div id="map" onClick="document.getElementById('lat').value=getCurrentLat();document.getElementById('lng').value=getCurrentLng();" >
    <?php

    $gmap = new GoogleMapAPI();
    $gmap->setDivId('maps');
    $gmap->setDirectionDivId('route');
    $gmap->setCenterLatLng('47.18', '2.19');
    //$gmap->setEnableWindowZoom(true);
    //$gmap->setEnableAutomaticCenterZoom(true);
    //$gmap->setDisplayDirectionFields(true);
    //// $gmap->setClusterer(true);
    $gmap->setSize('550px','550px');
    $gmap->setZoom(6);
    //$gmap->setLang('fr');
    //$gmap->setDefaultHideMarker(false);

    // insert the hotspots in the map
    foreach($places as $key => $place){
        $gmap->addMarkerByAddress($place->getAddress(),$key,$key);
    }
    //$gmap->addMarkerByAddress('35 Rue de Roche Gènes, Aubière, France','hotspot 19','Hotspot 19');
    //$gmap->addMarkerByAddress('Nantes, France','hotspot 20','Hotspot 20');
    //$gmap->addMarkerByAddress($place->getAddress(),'hotspot 20','Hotspot 20');

    $gmap->generate();
    echo $gmap->getGoogleMap();

    ?>
</div>
<div id="options">
    <span class="titre">Informations : <?php echo $vars; ?></span>
    <div class="panel">
        Lat : <input type="text" id="lat" class="inputTxt" onClick="" value=""/><br/>
        Lng : <input type="text" id="lng" class="inputTxt" onClick="" value=""/>
    </div>
</div>
