<?php
/** @var $serviceCenter app\models\ServiceCenter */

use app\core\Application;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Center</title>
    <link rel="stylesheet" href="/css/customer/customer-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
    <link rel="stylesheet" href="/css/customer/flash-messages.css">
    <link rel="stylesheet" href="/css/customer/service-center-profile.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous"/>
    <!-- adding the css styling -->
    <link rel="stylesheet" href="/css/customer/reviews.css">
    <link rel="stylesheet" href="/css/service-center/appointment-book.css">
</head>

<body>
<?php

include_once 'components/sidebar.php';
include_once 'components/header.php';
?>


<!--https://via.placeholder.com/100-->
<header class="header">
    <!--    <div class="banner"></div>-->
    <div class="profile-info">
        <div class="profile-pic">
            <!--            <img src="-->
            <?php //echo $technician['profile_picture'] ?><!--" alt="Technician Profile Picture">-->
        </div>
        <div class="profile-details">
            <h2><?php echo $serviceCenter['name'] ?></h2>
            <p>Service center</p>
        </div>
        <div class="status">
            <!-- <div class="availability">
                <span class="status-dot"></span>
                <span>Available</span>
            </div> -->
            <button class="message-btn"
                    onclick="getDirections( <?php echo $serviceCenter['ser_cen_id'] . ', ' . Application::$app->session->get('customer') ?> )">
                Directions
            </button>
            <!-- <button class="message-btn">Message</button>
                <button class="message-btn">Call</button>
                <button class="message-btn"
                    onclick="sendRequest( <?php echo $serviceCenter['ser_cen_id'] . ', ' . Application::$app->session->get('customer') ?> )">
                    Request
                </button> -->
        </div>
    </div>
</header>

<?php if (Application::$app->session->getFlash('createCusSerCenReq-success')): ?>
    <div class="alert alert-success">
        <?php echo Application::$app->session->getFlash('createCusSerCenReq-success') ?>
    </div>
<?php endif; ?>
<?php if (Application::$app->session->getFlash('createCusSerCenReq-error')): ?>
    <div class="alert alert-error">
        <?php echo Application::$app->session->getFlash('createCusSerCenReq-error') ?>
    </div>
<?php endif; ?>

<nav class="tabs">
    <button class="tab active">Feed</button>
    <button class="tab" onclick="scrollToSection('ratings-reviews-section');">Ratings & Reviews</button>
</nav>

<!-- service center services cards -->
<div class="service-center-services"
     style="padding: 40px 20px; background: linear-gradient(135deg, #e0eafc, #cfdef3); border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); max-width: 1200px; margin: 40px auto; font-family: 'Poppins', sans-serif;">
    <h2
            style="text-align: center; margin-bottom: 40px; font-size: 36px; color: #222; font-weight: 700; letter-spacing: 1px;">
        Our Services</h2>

    <div class="services-list"
         style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
        <?php
        foreach ($services as $service) {
            echo '<div class="service-card" style="background: white; padding: 30px 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center; transition: all 0.4s ease; cursor: pointer; position: relative; overflow: hidden;" 
            onmouseover="this.style.transform=\'translateY(-10px)\'; this.style.boxShadow=\'0 8px 20px rgba(0,0,0,0.2)\';" 
            onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 4px 12px rgba(0,0,0,0.1)\';">';

            echo '<div style="width: 70px; height: 70px; background: linear-gradient(135deg, #74ebd5, #acb6e5); border-radius: 50%; margin: 0 auto 20px auto; display: flex; align-items: center; justify-content: center; font-size: 30px; color: white;">🔧</div>';
            echo '<h3 style="margin: 0; font-size: 22px; color: #444; font-weight: 600;">' . htmlspecialchars($service['name']) . '</h3>';

            echo '</div>';
        }
        ?>
    </div>
</div>


<!-- Feedback Section -->
<?php
include_once 'components/service-center-reviews.php';
?>


<h2 class="booking-heading">Book Appointment</h2>

<form action="/book-appointment" method="post" class="appointment-form">
    <input type="hidden" name="service_center_id" id="service_center_id"
           value="<?= $serviceCenter['ser_cen_id'] ?>">

    <label for="vehicle_details">Vehicle Issue</label>
    <input type="text" name="vehicle_details" id="vehicle_details" required>

    <label for="appointment_date">Appointment Date</label>
    <input type="date" name="appointment_date" id="appointment_date" required min="<?= date('Y-m-d') ?>"
           max="<?= date('Y-m-d', strtotime('+6 days')) ?>">

    <label for="appointment_time">Appointment Time</label>
    <select name="appointment_time" id="appointment_time" required>
        <option value="">-- Select a time --</option>
        <!-- JS will populate available times -->
    </select>

    <button type="submit">Book Now</button>
</form>


<!-- Overlay for the confirmation message -->
<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/customer-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/service-center-profile.js"></script>
<script src="/js/customer/customer-home.js"></script>
<script src="/js/customer/overlay.js"></script>
<script>
    console.log('Service Center Profile JS loaded');

    document.addEventListener('DOMContentLoaded', function () {
        const timeSelect = document.querySelector('#appointment_time');
        const dateInput = document.querySelector('#appointment_date');
        const serviceCenterId = document.querySelector('#service_center_id').value;

        dateInput.addEventListener('change', () => {
            const selectedDate = dateInput.value;
            if (!selectedDate) return;

            fetch('/fetch-appointment-dates', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    service_center_id: serviceCenterId,
                    appointment_date: selectedDate
                })
            })
                .then(res => res.json())
                .then(bookedTimes => {
                    const allSlots = generateTimeSlots('08:00', '17:00', 30);
                    timeSelect.innerHTML = '<option value="">-- Select a time --</option>';

                    // Extract and normalize booked times (convert to "HH:mm" format)
                    const normalizedBooked = bookedTimes.map(slot => slot.appointment_time.slice(0, 5));

                    allSlots.forEach(time => {
                        const option = document.createElement('option');
                        option.value = time;
                        option.textContent = time;

                        if (normalizedBooked.includes(time)) {
                            option.disabled = true;
                            option.textContent += ' (Booked)';
                            option.style.color = 'gray';
                        }

                        timeSelect.appendChild(option);
                    });
                })
                .catch(err => {
                    console.error("Error fetching booked slots: ", err);
                });

        });

        function generateTimeSlots(start, end, interval) {
            const slots = [];
            let [h, m] = start.split(':').map(Number);
            const [eh, em] = end.split(':').map(Number);

            while (h < eh || (h === eh && m < em)) {
                slots.push(`${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`);
                m += interval;
                if (m >= 60) {
                    m -= 60;
                    h++;
                }
            }
            return slots;
        }
    });
</script>

</body>

</html>