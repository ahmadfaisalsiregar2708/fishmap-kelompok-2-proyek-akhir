<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Error</title>
        <style type="text/css">
            ::selection {
                background-color: #e13300;
                color: white;
            }
            ::-moz-selection {
                background-color: #e13300;
                color: white;
            }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4f5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #d0d0d0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #d0d0d0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #container {
                margin: 10px;
                border: 1px solid #d0d0d0;
                box-shadow: 0 0 8px #d0d0d0;
            }

            p {
                margin: 12px 15px 12px 15px;
            }
        </style>
    </head>
    <body>
        <!-- <div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div> -->
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            html,
            code {
                font: 15px/22px arial, sans-serif;
            }
            html {
                background: #fff;
                color: #222;
                padding: 15px;
            }
            body {
                margin: 7% auto 0;
                max-width: 390px;
                min-height: 180px;
                padding: 30px 0 15px;
            }
            * > body {
                background: url(//www.google.com/images/errors/robot.png) 100% 5px no-repeat;
                padding-right: 205px;
            }
            p {
                margin: 11px 0 22px;
                overflow: hidden;
            }
            ins {
                color: #777;
                text-decoration: none;
            }
            a img {
                border: 0;
            }
            @media screen and (max-width: 772px) {
                body {
                    background: none;
                    margin-top: 0;
                    max-width: none;
                    padding-right: 0;
                }
            }
            #logo {
                background: url(//www.google.com/images/branding/googlelogo/1x/googlelogo_color_150x54dp.png) no-repeat;
                margin-left: -5px;
            }
            @media only screen and (min-resolution: 192dpi) {
                #logo {
                    background: url(//www.google.com/images/branding/googlelogo/2x/googlelogo_color_150x54dp.png) no-repeat 0% 0%/100% 100%;
                    -moz-border-image: url(//www.google.com/images/branding/googlelogo/2x/googlelogo_color_150x54dp.png) 0;
                }
            }
            @media only screen and (-webkit-min-device-pixel-ratio: 2) {
                #logo {
                    background: url(//www.google.com/images/branding/googlelogo/2x/googlelogo_color_150x54dp.png) no-repeat;
                    -webkit-background-size: 100% 100%;
                }
            }
            #logo {
                display: inline-block;
                height: 54px;
                width: 150px;
            }
        </style>
        <!-- <a href="#"><span id="logo" aria-label="CISmart-3.1.11"></span></a> -->
        <p>
            <b> <ins><?php echo $heading; ?>.</ins> </b>
        </p>
        <p><?php echo $message; ?></p>
    </body>
</html>