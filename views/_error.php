<?php
/** @var $exception \Exception */
?>

<div class="error-container">
    <!-- Error Icon/Image -->
    <img src="/assets/_error_img.jpg" alt="Error Icon" class="error-icon">

    <!-- Error Code -->
    <h1><?php echo $exception->getCode() ?: 500 ?></h1>

    <!-- Error Message -->
    <h2><?php echo $exception->getMessage() ?: 'Oops! Something went wrong.' ?></h2>

    <!-- Error Description -->
    <p class="error-description">
        We’re sorry, but the page you’re looking for encountered an error. <br>
        You can use the button below to return to the homepage or contact our support team if the issue persists.
    </p>

    <!-- Back to Homepage -->
    <a href="/" class="error-button">Go to Homepage</a>
</div>

<style>
    .error-container {
        text-align: center;
        margin: auto;
        margin-bottom: 2rem;
        margin-top: 2rem;
        padding: 2rem;
        max-width: 600px;
        min-height: 40vh;
        background-color: rgba(255, 255, 255, 0.05); /* Light overlay for better contrast in a dark theme */
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        color: #333333;
    }

    .error-icon {
        width: 100px;
        height: 100px;
        margin-bottom: 20px;
    }

    .error-container h1 {
        font-size: 72px;
        margin-bottom: 10px;
        color: #ff4f4f; /* Soft error red color for error code */
    }

    .error-container h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #03033c;
    }

    .error-description {
        font-size: 16px;
        color: #cbd5e1; /* Light gray for secondary text */
        margin-bottom: 3rem;
    }

    .error-button {
        display: inline-block;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
        color: #ffffff;
        background-color: #007bff; /* Blue color for button */
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .error-button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
</style>
