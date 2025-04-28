<?php

use \app\core\Application;

?>

<?php
$isGuest = false;
if (Application::isGuestCustomer() && Application::isGuestTechnician() && Application::isGuestServiceCenter()) {
    $isGuest = true;
}
?>
<script>
    const isGuest = <?php echo $isGuest ? 'true' : 'false'; ?>;
</script>
<?php show($isGuest); ?>

<div class="container-map">
    <center>
        <!--        <h1>Geolocations of the technicians and service centres</h1>-->
    </center>
    <div class="map" id="map"></div>
</div>




