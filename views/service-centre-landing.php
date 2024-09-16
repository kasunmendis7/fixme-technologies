<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Trusted Pit Stop for All Repairs</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
        }

        /* Header */
        header {
            background: #000033;
            color: #fff;
            padding: 1rem 0;
        }
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        header ul {
            display: flex;
            list-style: none;
        }
        header ul li {
            margin-left: 20px;
        }

        /* Hero Section */
        #hero {
            min-height: 400px;
            background: url('/assets/service-centre-cover.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            text-align: center;
            color: #fff;
            height: 100vh;
            /*color: black;*/
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            /*display: grid;*/
            grid-template-columns: 1fr 1fr;

        }
        #hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* Services */
        #services {
            padding: 2rem 0;
        }
        .services-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .service {
            flex-basis: calc(33.333% - 20px);
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f4f4f4;
            text-align: center;
        }

        /* FAQ */
        #faq {
            background: #f4f4f4;
            padding: 2rem 0;
        }
        .faq-item {
            margin-bottom: 1rem;
        }

        /* Contact */
        #contact {
            padding: 2rem 0;
        }
        #contact form {
            display: flex;
            flex-direction: column;
        }
        #contact form input, #contact form textarea {
            margin-bottom: 1rem;
            padding: 0.5rem;
        }
        #contact form button {
            background: #0066cc;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            cursor: pointer;
            align-self: flex-start;
        }

        /* Footer */
        footer {
            background: #000033;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
            }
            header ul {
                margin-top: 1rem;
            }
            #hero h1 {
                font-size: 2rem;
            }
            .service {
                flex-basis: 100%;
            }
        }

        @media (max-width: 480px) {
            header ul {
                flex-direction: column;
                align-items: center;
            }
            header ul li {
                margin: 0.5rem 0;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div id="branding">
            <h1>Car Repair Services</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>

<section id="hero">
    <div class="container">
        <h1>Your Trusted Pit Stop for All Repairs</h1>
        <p>Professional and reliable auto repair services</p>
    </div>
</section>

<section id="services">
    <div class="container">
        <h2>Our Services</h2>
        <div class="services-container">
            <div class="service">
                <h3>Engine Repair</h3>
                <p>Expert engine diagnostics and repair</p>
            </div>
            <div class="service">
                <h3>Brake Service</h3>
                <p>Ensure your safety with our brake services</p>
            </div>
            <div class="service">
                <h3>Oil Change</h3>
                <p>Regular maintenance for your vehicle</p>
            </div>
        </div>
    </div>
</section>

<section id="faq">
    <div class="container">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <h3>How long will it take to fix my car?</h3>
            <p>It depends on the issue, but we always strive for quick turnaround times.</p>
        </div>
        <div class="faq-item">
            <h3>Do I need to make an appointment?</h3>
            <p>While walk-ins are welcome, appointments are recommended for faster service.</p>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <form>
            <input type="text" placeholder="Name">
            <input type="email" placeholder="Email Address">
            <textarea placeholder="Your Message"></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

<footer>
    <p>&copy; 2024 Car Repair Services. All rights reserved.</p>
</footer>
</body>
</html>