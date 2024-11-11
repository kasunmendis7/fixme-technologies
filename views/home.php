<?php

use app\core\Application;

?>
<section class="section-1">
    <div class="box-1">
        <div class="box-1-container">
            <div class="box-1-navigate">
                <div class="item-1">
                    <button class="active item-btn" onclick="toggleVisibility()">Customer</button>
                </div>
                <div class="item-2">
                    <button class="item-btn" onclick="toggleVisibility()">Technicians</button>
                </div>
            </div>
            <div class="box-1-content">
                <h2 class="box-1-title">Find technician and get fixed</h2>
                <p class="box-1-desc">
                    Find trustworthy technician when your vehicle breaks down
                </p>
                <button class="box-1-btn" type="button" onclick="redirectCustomerSignUp()">Find Technician</button>
            </div>
            <div class="box-1-content hidden">
                <h2 class="box-1-title">Provide services to customers</h2>
                <p class="box-1-desc">
                    Provide service to customers who are in need of your service
                </p>
                <button class="box-1-btn" type="button" onclick="redirectTechnicianLanding()">Find Customers</button>
            </div>
        </div>
    </div>
    <div class="box-2">
    </div>
</section>
<section class="section-2">
    <div class="box-2">
        <div class="box-2-container">
            <div class="box-2-content">
                <h2 class="box-2-title">Fixme For Service Center</h2>
                <p class="box-2-desc">
                    Transform the way your service center moves and feeds its people.
                </p>
                <button class="box-2-btn" type="button" onclick="redirectServiceCentreLanding()">See More...</button>
            </div>
        </div>
    </div>
</section>
<section class="section-3">
    <div class="heading-container">
        <h2>
            Focus on safety, Wherever you go
        </h2>
    </div>
    <div class="row">
        <div class="box-3-container">
            <div class="box-3">
                <div class="img-box-3">
                    <img src="assets/homeimage2.jpg" alt="">
                </div>
                <div class="detail-box-3">
                    <h5>
                        Our Commitment to your safety
                    </h5>
                    <p>Your Safety is Our Priority: From strict vetting processes to real-time support, we ensure a
                        secure experience with every interaction
                    </p>
                    <p>
                        <a href="/">See More...</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="box-3-container">
            <div class="box-3">
                <div class="img-box-3">
                    <img src="assets/homeimage4.jpg" alt="">
                </div>
                <div class="detail-box-3">
                    <h5>
                        Ensuring Technicians with Upfront Payments
                    </h5>
                    <p>
                        Ensuring Fairness for Technicians: With upfront payments and verified customer profiles, we
                        protect your time and effort from potential fraud
                    </p>
                    <p>
                        <a href="/">See More...</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-4">
    <div class="heading-container">
        <h2>
            Find trusted and certified automobile technicians and service centres in your area.
        </h2>
    </div>
    <div class="row">
        <div class="box-4-container">
            <div class="box-4">

                <div class="detail-box-4">
                    <h5>
                        Become a Technician
                        <a href="/technician-landing"><ion-icon name="chevron-forward-circle"></ion-icon></ion-icon></a>
                    </h5>

                </div>
            </div>
        </div>
        <div class="box-4-container">
            <div class="box-4">
                <div class="detail-box-4">
                    <h5>
                        Register Service Centre
                        <a href="/service-centre-landing"><ion-icon name="chevron-forward-circle"></ion-icon></ion-icon></a>
                    </h5>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-5">

    <div class="row">
        <div class="box-5-container">
            <div class="box-5">
                <span class="box-5-logo">
                    <ion-icon name="people-outline"></ion-icon>
                </span>
                <div class="detail-box-5">
                    <h5>
                        About Us
                    </h5>
                    <p>Find out how we started and what drives us.</p>
                    <p>
                        <a href="/about-us">Learn More...</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="box-5-container">
            <div class="box-5">
                <span class="box-5-logo">
                    <ion-icon name="construct-outline"></ion-icon>
                </span>
                <div class="detail-box-5">
                    <h5>
                        Locate Nearby Technicians
                    </h5>
                    <p>We connect highly skilful and trustworthy technicians for vehicle repair anywhere, anytime </p>
                    <p>
                        <a href="/technician-map">Learn More...</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="box-5-container">
            <div class="box-5">
                <span class="box-5-logo">
                    <ion-icon name="storefront-outline"></ion-icon>
                </span>
                <div class="detail-box-5">
                    <h5>
                        Locate Nearby Service Centres
                    </h5>
                    <p>Discover our certified service centers, offering expert care and quality vehicle repairs you can
                        trust</p>
                    <p>
                        <a href="service-centre-map">Learn More...</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>