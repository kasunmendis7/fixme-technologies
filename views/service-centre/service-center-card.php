<div class="col service-center-card" data-name="<?= strtolower($serviceCenter['name']) ?>">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($serviceCenter['name']) ?></h5>
            <!-- <h6 class="distance"><?= htmlspecialchars($serviceCenter['distance']) ?> km Away</h6> -->
            <!-- <h6 class="distance"><?= round($serviceCenter['duration']) ?> mins Away</h6> -->
            <!-- <h5 class="rating">Rating: <span>4.5</span></h5> -->
            <!-- <h5 class="service-category">Motor Mechanic</h5> -->
            <!-- <p class="card-text">12 years experienced motor mechanic worked for BMW.</p> -->
            <h5 class="address"><?= htmlspecialchars($serviceCenter['address']) ?></h5>
            <h5 class="phone_no"><?= htmlspecialchars($serviceCenter['phone_no']) ?></h5>
            <h5 class="email"><?= htmlspecialchars($serviceCenter['email']) ?></h5>
            <button type="button" class="btn btn-primary"
                    onclick="viewProfile(<?= $serviceCenter['ser_cen_id'] ?>)">View Profile
            </button>
        </div>
    </div>
</div>