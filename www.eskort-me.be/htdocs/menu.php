<!-- Start Header -->
        <header id="header" class="triangle header-title fleet">
            <!-- Menu toggle -->
            <label id="toggle" class="toggle"></label>
            <!-- Start Header-Inner -->
            <div class="header-inner cleafix">
                <!-- Start Header-Logo -->
                <div class="header-logo">
                    <a href="http://www.eskort-me.be">
            <img src="img/logo.png" alt="logo escort girl">
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
                                        <i class="fa fa-phone"></i>+32 489 761 043</li>
                                    <li>
                                        <i class="fa fa-envelope"></i>
                                        <a href="mailto:contact@eskort-me.be">
                        contact@eskort-me.be
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
                                        <a href="https://plus.google.com/100914571630442894583/about"><i class="fa fa-google-plus-square"></i></a>
                                    </li>
                                </ul>
                                <!-- End Social -->
                                <!-- Start Header-Login -->
                                
									<?php if(!isset($_SESSION['id_salon']))
										{
											?><div class="header-login">
                                    <button class="header-btn">
											<i class="fa fa-key"></i>Se connecter</button>
											    <div class="header-form"> 
													<form id="connection_salon" action="traitement_ajax_connection.php" method="POST" class="default-form">
													   <p class="alert-message warning">
															<i class="ico fa fa-exclamation-circle"></i>Tous les champs sont requis !
															<i class="fa fa-times close"></i>
														</p>
														<p class="form-row">
															<input class="required email" name="email" id="email" type="text" placeholder="Email">
														</p>
														<p class="form-row">
															<input class="required" type="password" name="password" id="password" placeholder="Mot de passe">
														</p>
														<p class="form-row">
															<input type="hidden" name="connection_post" value="connection_post"/>
															<input type="submit" class="submit-btn btn light" id="connection" value="Se connecter" />
														</p>
														<p class="form-row forgot-password">
															<a href="#">Mot de passe oublié ?</a>
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
                                        <i class="fa fa-globe"></i>FR</button>
                                    <nav class="header-form">
                                        <ul class="custom-list">
                                            <li>
                                               <a href="index_en.php">EN</a>
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
                                        <li class="menu">
                                            <a href="http://www.eskort-me.be/">Escortes</a>
                                        </li>
                                                                               <li class="menu">
                                            <a href="adresses.php">Adresses</a>
                                        </li>
                                       <li class="menu">
                                           <?php require_once("inscription.php"); ?>
                                        </li>
                                     </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                    
                                   
                                        
                                         <li class="menu">
                                            <a href="http://www.eskort-me.be/sex-shop/">Sex Shop</a>
                                        </li>

                                        <li class="menu">
                                            <a href="about.php">Le concept</a>
                                        </li>
                                           
                                        
                                        <li class="menu">
                                            <a href="contact.php" rel="nofollow">Contact</a>
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
            <!-- End Header-Inner -->
           
        </header>
        <!-- End Header -->
