<!-- Start Header -->
        <header id="header" class="triangle header-title fleet">
            <!-- Menu toggle -->
            <label id="toggle" class="toggle"></label>
            <!-- Start Header-Inner -->
            <div class="header-inner cleafix">
                <!-- Start Header-Logo -->
                <div class="header-logo">
                    <a href="index_en.php">
            <img src="img/logo.png" alt="logo">
          </a>
                </div>
                <!-- End Header-Logo -->
                <!-- Start Header-Tool-Bar -->
                <div class="header-tool-bar">
                    <div class="container">
                        <div class="row">
                            <!-- Start Header-Left -->
                            <div class="col-lg-4 col-md-5 col-xs-12 header-left">
                                <!-- Start Header-Contact -->
                                <ul class="custom-list header-contact">
                                    <li>
                                        <i class="fa fa-phone"></i>02 736 93 89</li>
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        <a href="mailto:contact@eskort-me.be">
                        contact@vubineo.com
                        </a>
                                    </li>
                                </ul>
                                <!-- End Header-Contact -->
                            </div>
                            <!-- End Header-Left -->
                            <!-- Start Header-Right -->
                            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 col-lg-offset-4 col-md-offset-2 header-right">
                                <!-- Start Social -->
                                <ul class="header-social custom-list">
                                    <li>
                                        <a href="https://www.facebook.com/eskortme?ref=hl"><i class="fa fa-facebook-square"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/eskortme"><i class="fa fa-twitter-square"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://plus.google.com/100914571630442894583/about"><i class="fa fa-google-plus-square"></i></a>                                    </li>
                                </ul>
                                <!-- End Social -->
                                <!-- Start Header-Login -->
								<?php if(!isset($_SESSION['id_salon']))
										{
											?>
                                <div class="header-login">
                                    <button class="header-btn">
                                        <i class="fa fa-key"></i>Login</button>
                                    <div class="header-form">
                                        <form action="index.html" class="default-form">
                                            <p class="alert-message warning">
                                                <i class="ico fa fa-exclamation-circle"></i>All fields are required!
                                                <i class="fa fa-times close"></i>
                                            </p>
                                            <p class="form-row">
                                                <input class="required email" type="text" placeholder="Email">
                                            </p>
                                            <p class="form-row">
                                                <input class="required" type="password" placeholder="Password">
                                            </p>
                                            <p class="form-row">
                                                <button class="submit-btn btn light">Login</button>
                                            </p>
											<p class="form-row">
															<input type="hidden" name="connection_post" value="connection_post"/>
															<input type="submit" class="submit-btn btn light" id="connection" value="Se connecter" />
														</p>
                                            <p class="form-row forgot-password">
                                                <a href="#">Forgot Password?</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
								<?php 
										}	
										else
										{
											?><a href="http://www.eskort-me.be/Back.php"><?php echo " Espace client ".$_SESSION['salon']; ?></a><?php
										}
										?>
                                <!-- End Header-Login -->
                                <!-- Start Header-Language -->
                                <div class="header-language">
                                    <button class="header-btn">
                                        <i class="fa fa-globe"></i>EN</button>
                                    <nav class="header-form">
                                        <ul class="custom-list">
                                            <li>
                                                <a href="index.php">FR</a>
                                            </li>
                                            <li>
                                                <a href="#">NL</a>
                                            </li>
                                            <li>
                                                <a href="index_es.php">ES</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- End Header-Language -->
                            </div>
                            <!-- End Header-Right -->
                        </div>
                    </div>
                </div>
                <!-- End Header-tool-bar -->
                <!-- Start Header-Nav -->
                <div class="header-nav">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Start Nav -->
                                <nav role="navigation">
                                    <ul class="nav navbar-nav">
                                        <li class="has-submenu">
                                            <a href="index.php">Escorts</a>
                                        </li>
                                        <li class="has-submenu">
                                            <a href="adresses_en.php">Adresses</a>
                                        </li>
                                        <li>
                                            
<a class="typeform-share" href="https://clement4.typeform.com/to/BQyEKE" data-mode="1"target="_blank">Sign up</a></li>
                                     </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="has-submenu">
                                            <a href="about_en.php">Concept</a>
                                            
                                           
                                        
                                        <li class="has-submenu">
                                            <a href="contact_en.php">Contact</a>
                                            <ul class="sub-menu custom-list">
                                             </ul>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- End Nav -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Header-Nav -->

            </div>
        