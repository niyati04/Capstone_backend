<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Email Verification</title>
    <!--fontawesomeicon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        type="text/css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" />
    <!--cssfile-->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        a {
            color: white;
            text-decoration: none;
        }

        /* h3 {
            color: rgb(0, 0, 0);
            text-decoration: none;
        } */

        h1 {
            font-family: 'DM Serif Display', serif;
            letter-spacing: 2px;
            font-size: 28px;
        }

        .text {
            padding: 0 40px;
            font-size: 15px;
        }

        .box {
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            background-color: #f3f3f4;
            height: 850px;
            padding: 20px 50px 50px 50px;
            box-shadow: 0px 0px 14px lightgrey;
        }

        .borderbox {
            margin: auto;
            max-width: 350px;
            height: 530px;
            background-color: rgb(248, 248, 248);
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 3px 5px lightgrey;
        }

        /* logo*/
        .logo {
            text-align: center;
        }

        .logo .cininfo {
            margin: 0;
            padding: 0;
            height: 100px;
            width: auto;

        }

        img {
            text-align: center;
        }

        .emailimg {
            width: 100%;
            border-radius: 10px 10px 0 0;

        }

        /* button verification */
        /* button{
        background-image: linear-gradient(#639FC0,#275a75);
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 14px;
        color: white;
        border:none;
        letter-spacing: 2px;
        } */
        h2 {
            /* background: -webkit-linear-gradient(#639FC0, #275a75); */
            /* -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; */
            font-size: 25px;
            font-weight: 700;
            color: rgb(0, 0, 0);
        }


        /* icons */
        .icons {
            margin-left: 135px;
        }

        .icons img {
            height: 25px;
            width: 25px;
            text-align: center;
            margin-top: 20px;
        }

        .fa-instagram {
            margin-right: 10px;
            border-radius: 50%;
            padding: 6px;
            text-align: center;
            color: white;
            height: 35px;
            width: 35px;
            font-size: 22px;
            background-image: linear-gradient(#405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
        }

        .fa-linkedin-in {
            border-radius: 50%;
            padding: 6px;
            text-align: center;
            color: white;
            height: 35px;
            width: 35px;
            font-size: 22px;
            background-color: #0072b1;
        }

        /* copyrights */
        .copyrights {
            text-align: center;
        }

        @media screen and (max-width:768px) {
            .text {
                font-size: 15px;
                padding: 0 25px;
            }
        }
    </style>
</head>

<body>
    <!--EmailVerification-->
    <section>
        <div class="box">
            {{-- <div class="logo">
                <img src="https://cininfo.sanjayjayani.com/cininfo.png" alt="" class="cininfo">
            </div> --}}
            <!-- inbox -->
            <div class="borderbox" style="box-shadow: 0 3px 5px lightgray;">
                <img src="https://cininfo.sanjayjayani.com/emailvector.jpeg" alt="" class="emailimg">

                <div class="heading">
                    <h1>Email Verification</h1>
                    <p style="color: #833ab4; z-index: 1; text-decoration: #405de6">{{ $data['email'] }}</p>
                    <p class="text">Hi, <br />
                        We're glad you're interested in joining us. To verify your account and ensure secure
                        access, we need to verify your email address.
                        Please use the OTP below to complete the verification process:</p>
                </div>
                <div class="button">
                    <!-- <span class="line">4</span>
                    <span class="line">5</span>
                    <span class="line">3</span>
                    <span class="line">9</span> -->
                    <h2>{{ $data['otp'] }}</h2>
                    <!-- <button> <a href="#">CONFIRM EMAIL</a></button> -->
                    <!-- <p class="text">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p> -->
                </div>
            </div>
            <!-- icons -->

            <!-- copyrights -->
            <div class="copyrights">
                <p class="text">Copyright. CININFO TECH PRIVATE LIMITED 2023.</p>
                <!-- <span>lorem ipsum is simply dummy text</span> -->
            </div>
        </div>
    </section>
</body>

</html>
