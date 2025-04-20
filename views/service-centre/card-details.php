<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>

        * {
            margin: 0;
            padding: 0;
            outline: none;
            text-decoration: none;
            list-style: none;
            box-sizing:border-box;
        }

        .clearfix:after {
            content: " "; /* Older browser do not support empty content */
            visibility: hidden;
            display: block;
            height: 0;
            clear: both;
        }

        body{
            font-family: poppins, arial, sans-serif;
            background-color: white;
        }

        .modal{
            width: 96%;
            max-width: 1000px;
            height: 550px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 3px;
            overflow: hidden;
            background-color: white;
            box-shadow: 5px 5px 30px rgba(0,0,0,.3);

            .modal-product{
                width: 40%;
                height: 100%;
                float: left;
                position: relative;

                .product{
                    width: 100%;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 2;

                    .product-slideshow {
                        max-width: 350px;
                        margin: 0 auto;
                        position: relative;

                        .productSlides {
                            display: none;
                        }

                        .dot {
                            cursor: pointer;
                            height: 10px;
                            width: 10px;
                            margin: 0 5px;
                            position: relative;
                            top: -36px;
                            background-color: rgba(255,255,255,.5);
                            border-radius: 50%;
                            display: inline-block;
                            transition: background-color 0.6s ease;
                            box-shadow: 0 0 5px rgba(0,0,0,.3);

                            &.active{
                                background-color: rgba(255,255,255,1);
                                box-shadow: 0 0 7px rgba(0,0,0,.6);
                            }

                            &:hover {
                                background-color: rgba(255,255,255,.8);
                            }

                            /* Fading animation */
                            .fade {
                                -webkit-animation-name: fade;
                                -webkit-animation-duration: 1.5s;
                                animation-name: fade;
                                animation-duration: 1.5s;
                            }

                            @-webkit-keyframes fade {
                                from {opacity: .4}
                                to {opacity: 1}
                            }

                            @keyframes fade {
                                from {opacity: .4}
                                to {opacity: 1}
                            }
                        }
                    }
                    .product-name{
                        color: #ffff;
                        font-size: 1.7rem;
                        font-weight: 300;
                        line-height: 2rem;
                        text-align: center;
                        margin-top: -22px;
                    }

                    .product-code-name{
                        font-size: .8rem;
                        font-weight: 300;
                        text-align: center;
                        margin: 8px auto 5px;
                    }

                    .product-price{
                        font-size: 1.5rem;
                        font-weight: 300;
                        letter-spacing: .18rem;
                        text-align: center;
                    }
                }

                .round-shape{
                    width: 125%;
                    height: 150%;
                    position: absolute;
                    top: 50%;
                    left: 38%;
                    transform: translate(-50%, -50%);
                    border-radius: 50%;
                    background-color: #010336;
                    box-shadow: 0 0 25px rgba(0,0,0,.3);
                    z-index: 1;
                }
            }
            .modal-info{
                width: 60%;
                height: 100%;
                float: right;
                position: relative;

                .info{
                    width: 90%;
                    height: 85%;
                    position: absolute;
                    top: 50%;
                    left: 5%;
                    transform: translate(0%, -50%);

                    h2{
                        font-size: 2.25rem;
                        margin-left: 1rem;
                    }

                    form{
                        .form-list{
                            margin-top: 1.5rem;
                            margin-left: 3.5rem;
                            .form-list-row{
                                margin: 1rem 0;

                                label{
                                    font-size: 1rem;
                                }

                                input{
                                    width: 70%;
                                    font-size: 1rem;
                                    padding: .4rem 0;
                                    border: none;
                                    display: inline-block;
                                    border-bottom: solid 2px #999;
                                    background-color: transparent;
                                    transition: all .3s ease;
                                    &:focus{
                                        border-color: #cdb196;
                                    }
                                }

                                .user{
                                    .fa-user{
                                        color: #fff;
                                        font-size: 1rem;
                                    }

                                    input{
                                        position: relative;
                                        left: -16px;
                                        padding-left: 30px;
                                    }
                                }

                                .number{

                                    .fa-credit-card{
                                        color: #ffff;
                                        font-size: 1rem;
                                    }

                                    input{
                                        position: relative;
                                        left: -20px;
                                        padding-left: 30px;
                                    }
                                }

                                .date{
                                    float: left;

                                    input{
                                        width: 60px;
                                        text-align: center;
                                    }
                                    .year{
                                        margin-left: 1.5rem;
                                    }
                                }

                                .cvc{
                                    float: left;
                                    margin-left: 6rem;
                                    text-align: center;

                                    .fa-question-circle{
                                        color: dodgerblue;
                                        display: inline-block;
                                        position: relative;
                                        left: .75rem;
                                    }

                                    input{
                                        width: 70px;
                                        text-align: center;
                                    }
                                }

                                .checkbox{
                                    margin-top: 2rem;
                                    input{
                                        width: auto;
                                    }

                                    span{
                                        font-size: .8rem;
                                    }
                                }
                            }
                        }
                        button{
                            color: white;
                            font-size: 1rem;
                            margin-left: 1rem;
                            padding: 1rem 2.5rem;
                            position: absolute;
                            bottom: 0;
                            border: none;
                            border-radius: 3px;
                            background-color: #010336;
                            box-shadow: 0 0 20px rgba(0,0,0,.25);
                            transition: all .3s ease;
                            cursor: pointer;

                            &:hover{
                                /*background-color: #b59779;*/
                            }
                        }
                    }
                }
            }
        }

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/base/_reset.css">
    <link rel="stylesheet" href="/css/base/_global.css">
    <link rel="stylesheet" href="/css/service-center/market-place-navbar.css">
    <link rel="stylesheet" href="/css/home/footer.css">
    <link rel="stylesheet" href="/css/home/home.css">
    <link rel="stylesheet" href="/css/service-center/marketplace.css">
    <link rel="stylesheet" href="/css/service-center/market-place-product-view.css">
    <script src="/js/home/main.js"></script>
    <script src="/js/technician/main.js"></script>
    <script src="/js/service-center/marketplace-home.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <script src="/js/service-center/card-details.js"></script>
    <title>Market Place</title>
</head>

<body>

<div class="modal clearfix">
    <div class="modal-product">
        <div class="product">

            <!-- Slideshow container -->
            <div class="product-slideshow">

                <!-- Full-width images with number and caption text -->
                <div class="productSlides fade">
                    <img src="https://github.com/EricGFigueroa/002-DailyUI-Gucci-Checkout/blob/master/img/gucci-bag-1.png?raw=true" style="width:100%">
                </div>

                <div class="productSlides fade">
                    <img src="https://github.com/EricGFigueroa/002-DailyUI-Gucci-Checkout/blob/master/img/gucci-bag-2.png?raw=true" style="width:100%">
                </div>

                <div class="productSlides fade">
                    <img src="https://github.com/EricGFigueroa/002-DailyUI-Gucci-Checkout/blob/master/img/gucci-bag-3.png?raw=true" style="width:100%">
                </div>

                <div class="productSlides fade">
                    <img src="https://github.com/EricGFigueroa/002-DailyUI-Gucci-Checkout/blob/master/img/gucci-bag-4.png?raw=true" style="width:100%">
                </div>

                <div class="productSlides fade">
                    <img src="https://github.com/EricGFigueroa/002-DailyUI-Gucci-Checkout/blob/master/img/gucci-bag-5.png?raw=true" style="width:100%">
                </div>

                <br>

                <!-- The dots/circles -->
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                    <span class="dot" onclick="currentSlide(5)"></span>
                </div>

            </div>

            <h1 class="product-name">
                Gucci Tian GG<br>Supreme Backpack
            </h1>
            <p class="product-code-name">
                Style ‎428027 K0LCN 8685
            </p>
            <p class="product-price">
                $1,590
            </p>

        </div>

        <div class="round-shape"></div>
    </div>
    <div class="modal-info">
        <div class="info">
            <h2>Payment Information</h2>
            <form action="#">
                <ul class="form-list">
                    <li class="form-list-row">
                        <div class="user">
                            <label for="#">Name</label><br>
                            <i class="fas fa-user"></i></i><input type="text" required>
                        </div>
                    </li>
                    <li class="form-list-row">
                        <div class="number">
                            <label for="#">Card Number</label><br>
                            <i class="far fa-credit-card"></i><input type="text" required>
                        </div>
                    </li>
                    <li class="form-list-row clearfix">
                        <div class="date">
                            <label for="#">Expiration Date</label><br>
                            <input class="month" type="text" required placeholder="MM">
                            <input class="year" type="text" required placeholder="YY">
                        </div>
                        <div class="cvc">
                            <label for="#">CVC</label><i class="fas fa-question-circle"></i><br>
                            <input type="text" required placeholder="123">
                        </div>
                    </li>
                    <li class="form-list-row">
                        <div class="checkbox">
                            <label for="checkbox">
                                <input id="checkbox" type="checkbox">
                                <span>Remember My Information</span>
                            </label>
                        </div>
                    </li>
                </ul>
                <button>Pay Now</button>
            </form>
        </div>
    </div>
</div>


</body>

</html>