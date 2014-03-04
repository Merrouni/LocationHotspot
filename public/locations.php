<?php
    //(1) On inclut la classe de Google Maps pour générer ensuite la carte.
    require_once '../maps/GoogleMapAPI.class.php';
    //(2) On crée une nouvelle carte; Ici, notre carte sera $map.
    $map = new GoogleMapAPI('map');
    //(3) On ajoute la clef de Google Maps.
    $map->setAPIKey('AIzaSyCms20Gv9OzHXLpc8r6_U3yf1Jr3JRbMjg');
    //(4) On ajoute les caractéristiques que l'on désire à notre carte.
    $map->setWidth("1200px");
    $map->setHeight("670px");
    $map->setCenterCoords ('2', '48');
    $map->addMarkerByCoords( 3.1145887, 45.7507817,  "hotspot 19", "<em>WIFI</em> gratuit", "Hotspot 19");
    $map->setZoomLevel (5);
    //(5) On applique la base XHTML avec les fonctions à appliquer ainsi que le onload du body.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Ma première carte Google Maps</title>
    <?php $map->printHeaderJS(); ?>
    <?php $map->printMapJS(); ?>
</head>

<body onload="onLoad();">
<?php $map->printMap(); ?>
</body>

</html>