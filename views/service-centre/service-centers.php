<div class="cust-tech-container">
    <div class="tech-container">
        <?php
        foreach($service_centers as $serviceCenter) {
            if (!$serviceCenter) {
                # code...
                echo '<div class="alert alert-danger">No service centers found</div>';
            } else {
                include __DIR__ . '/service-center-card.php';
            }
        }
        ?>
    </div>
</div>