<?
ob_start(); session_start();
require('lib/dbaSis.php');
require('lib/getSis.php');
require('lib/setSis.php');
require('lib/outSis.php');
?>


<?
$urlNavegacao = getHome();
//mostraMatriz($urlNavegacao);
?> 

<?
	 //mostraVar('dld', count($urlNavegacao));
    if ($urlNavegacao[0] == 'ct' || $urlNavegacao[0] == 'pd') {
         //   www.dominio.com.ber/ct/nome_menu/uri_conteudo
				$conteudoDB = read('conteudo', "WHERE uri = '$urlNavegacao[2]'");
				if ($conteudoDB) {
					foreach ($conteudoDB as $conteudoH) {
						$site_name = SITENAME;
						$title = $conteudoH['title']." | ".SITENAME;
						$description = $conteudoH['description'];
						$url_site = BASE."/$urlNavegacao[0]/$urlNavegacao[1]/$urlNavegacao[2]";
					}
				}
    }elseif ($urlNavegacao[0] == 'ml' || $urlNavegacao[0] == 'mc') {
        $conteudoDB = read('menu', "WHERE uri = '$urlNavegacao[1]'");
        if ($conteudoDB) {
          foreach ($conteudoDB as $conteudoH) {
            $site_name = SITENAME;
            $title = $conteudoH['title']." | ".SITENAME;
            $description = $conteudoH['description'];
            $url_site = BASE."/$urlNavegacao[0]/$urlNavegacao[1]";
          }
        }
      
    }else if ($urlNavegacao[0] == 'blog') {
			$site_name = SITENAME;
			$title = "BLOG | ".SITENAME;
			$description = "Blog da Regina Bianch - confira as últimas novidades aqui no nosso site.";
			$url_site = BASE."/$urlNavegacao[0]";

    }else {
      $site_name    = SITENAME;
      $title        = SITETITLE; 
      $description  = SITEDESC;
      $url_site     = BASE;
    }

  ?>   
  
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?=$title?></title>
        <meta name="description" content="<?=$description?>">

        <meta property="og:site_name" content="<?=$site_name?>">
        <meta property="og:title" content="<?=$title?>">
        <meta property="og:description" content="<?=$description?>">

        <meta property="og:locale" content="pt_BR">
        <meta property="og:image" content="<?=BASE?>/images/logo/logo.png">
        <meta property="og:url" content="<?=$url_site?>">
        <meta property="og:type" content="website">
        
        <meta name="robots" content="index, follow">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?=BASE?>/logo.ico" type="image/x-icon">
         
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="<?=BASE?>/css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="<?=BASE?>/css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="<?=BASE?>/css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="<?=BASE?>/css/meanmenu.min.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="<?=BASE?>/css/owl.carousel.min.css">
        <!-- bxslider css -->
        <link rel="stylesheet" href="<?=BASE?>/css/jquery.bxslider.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" href="<?=BASE?>/css/magnific-popup.css">
        <!-- Bootstrap Touchspin css -->
         <link rel="stylesheet" href="<?=BASE?>/css/jquery.bootstrap-touchspin.min.css">
		<!-- font-awesome css -->
        <link rel="stylesheet" href="<?=BASE?>/css/font-awesome.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="<?=BASE?>/style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="<?=BASE?>/css/responsive.css">
		<!-- modernizr css -->
        <script src="<?=BASE?>/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!--Preloader area start>
        <div id="loader_wrapper">
            <div class="loader"></div>
        </div>
        <!Preloader area end-->


<?
	 //mostraVar('urlNavegacao', $urlNavegacao[0]);
	 //mostraMatriz($urlNavegacao);
  
  
 
switch ($urlNavegacao[0]) {
 case 'index':
   require('home.php');
   break;
 case 'ml':
   require('conteudo_lista_linha.php');
   break;
 
 case 'mc':
   require('conteudo_lista_coluna.php');
   break;

 case 'lc':
   require('conteudo_lista_coluna_lancamento.php');
   break;
 
 case 'ct':
   require('conteudo_detalhe.php');
   break;
 case 'pd':
   require('conteudo_produto_detalhe.php');
   break;

   
 case 'blog':
   require('blog.php');
   break;
 case 'blt':
   require('blog_detalhe.php');
   break;
 case 'bll':
   require('blog_lista_categoria.php');
   break;

 case 'galeria':
   require('galeria.php');
   break;
    
    
    
 case 'foto-galeria':
   require('galeria-foto.php');
   break;
 case 'video-galeria':
   require('galeria-video.php');
   break;
 case 'faca-parte-do-time':
   require('cadastro-revendedora.php');
   break;

 default:
   require('home.php');
   break;

}

?>


        <!--Footer area start here-->
        <footer>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <div class="foo-about">
                                <div class="foo-logo">
                                    <a href="#"><img src="images/logo/logo.png" alt=""/></a>
                                </div>
                                <div class="content">
                                    <p><!-- Hair Salon was founded in 1996 with the mission. --></p>
                                    <span>+(41) 3777-7777</span>
                                    <p>Conte com a gente!!!</p>
                                    <a href="#"><!-- Read More <i class="fa fa-angle-double-right"> </i>--></a>
                                </div>
                                <ul class="list-inline">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <div class="weight foo-link">
                                <h3>Nosso Site</h3>
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i><span>Galeria </span></a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i><span>Blog</span></a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i><span>Entre em Contato</span></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <div class="weight insta">
                                <h3>Instagram</h3>
                                <? include "instagram.php" ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <div class="weight offer">
                                <h3>Conte com a Gente!</h3>
                                <div class="content">
                                    <p>Se puder, venha nos visitar. Temos certeza que você ficará satisfeito(a) com nossos trajes.</p>
                                    <!-- <span class="tit">Newsletters</span>
                                    <form>
                                        <input type="email" placeholder="Email Address *">
                                        <button class="btn4"><span>subscribe</span></button>
                                    </form> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="top-link-button text-center">
                                <a id="scrollUp" href="#top"><i class="fa fa-angle-up"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="copyright text-center">
                                <p><!-- Copyright © 2018. All rights reserved. Design by webstrot --></p>
                                <p><!-- Copyright © 2018. All rights reserved. Design by webstrot --></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Footer area end here-->



		<!-- all js here -->
		<!-- jquery latest version -->
        <script src="<?=BASE?>/js/vendor/jquery-3.2.1.min.js"></script>
		<!-- tether js -->
		<script src="<?=BASE?>/js/tether.min.js"></script>
		<!-- bootstrap js -->
        <script src="<?=BASE?>/js/bootstrap.min.js"></script>
        <!-- owl.carousel js -->
        <script src="<?=BASE?>/js/owl.carousel.min.js"></script>
        <!-- bxslider js -->
        <script src="<?=BASE?>/js/jquery.bxslider.min.js"></script>
		<!-- isotope js -->
        <script src="<?=BASE?>/js/isotope.pkgd.min.js"></script>
        <!-- magnific popup js -->
        <script src="<?=BASE?>/js/jquery.magnific-popup.min.js"></script>
		<!-- meanmenu js -->
        <script src="<?=BASE?>/js/jquery.meanmenu.js"></script>
        <!-- jarallax js -->
        <script src="<?=BASE?>/js/jarallax.min.js"></script>
		<!-- jquery-ui js -->
        <script src="<?=BASE?>/js/jquery-ui.min.js"></script>
        <!-- Bootstrap Touchspin JavaScript -->
        <script src="<?=BASE?>/js/jquery.bootstrap-touchspin.min.js"></script>
		<!-- wow js -->
        <script src="<?=BASE?>/js/wow.min.js"></script>
		<!-- plugins js -->
        <script src="<?=BASE?>/js/plugins.js"></script>
		<!-- main js -->
        <script src="<?=BASE?>/js/main.js"></script>

               
               
               


    </body>
</html>
