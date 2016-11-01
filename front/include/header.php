<!doctype html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Anak Beken | Kreatif, Positif dan Inovatif.</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="<?=SITEURL;?>css/styles.css">
        <link rel="stylesheet" href="<?=SITEURL;?>css/style-default.css">
        <link rel="stylesheet" href="<?=SITEURL;?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=SITEURL;?>css/bootstrap.clearfix.css">
        <link rel="stylesheet" href="<?=SITEURL;?>css/animate.css">
        <link rel="stylesheet" href="<?=SITEURL;?>css/jquery.fancybox.css">
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#target-navbar" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div><!--.navbar-header-->
                <div class="collapse navbar-collapse" id="target-navbar">
                    <ul class="nav navbar-nav navbar-sm-center">
                        <li><a href="#">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Free Download <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Free Software</a></li>
                                <li><a href="#">Free E-Book</a></li>
                                <li><a href="#">Free Graphic</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Komik Strip</a></li>
                        <li><a href="#">Meme Komik</a></li>
                        <li><a href="#">Front-end Developer Resources</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right navbar-inline navbar-sm-center">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="hidden-xs"><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div><!--.navbar-collapse-->
            </div><!--.container-->
        </nav>

        <section class="l-search" id="l-search">
            <div class="search">
                <input type="text" name="search" class="form-control search-line" placeholder="Search.." />
                <button type="button" class="search-btn">Search</button>
            </div>
        </section>

        <section class="l-brand">
            <h1><a class="brand" href="#"><img src="<?=SITEURL;?>images/web/logo5.png" /></a></h1>
        </section>

        <section class="l-secondary-menu">
            <nav class="nav-menu-secondary" id="nav-menu-secondary">
                <div class="container">
                    <ul class="secondary-menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Teknologi</a></li>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Travelling</a></li>
                        <li><a href="#">Jajan</a></li>
                        <li><a href="#">Nongkrong</a>
                        <li><a href="#">Photography</a></li>
                        <li><a href="#">Random</a></li>
                    </ul>

                    <button class="nav-hamburger-menu" id="hamburger-menu">
                        <span class="strip-bar"></span>
                        <span class="strip-bar"></span>
                        <span class="strip-bar"></span>
                    </button>

                    <ul class="secondary-menu-hamburger" id="secondary-menu-hamburger">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Teknologi</a></li>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Travelling</a></li>
                        <li><a href="#">Jajan</a></li>
                        <li><a href="#">Nongkrong</a>
                        <li><a href="#">Photography</a></li>
                        <li><a href="#">Random</a></li>
                        <li>
                            <div class="search-mobile input-group">
                                <input type="text" class="form-control" placeholder="Search.." aria-describedby="basic-addon2" />
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></span>
                            </div>
                        </li>
                    </ul>

                    <div class="l-search" id="l-search-mobile">
                        <div class="search">
                            <input type="text" name="search" class="form-control search-line" placeholder="Search.." />
                            <button type="button" class="search-btn">Search</button>
                        </div>
                    </div>
                </div>
            </nav>
        </section>