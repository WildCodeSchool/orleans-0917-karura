<?php
require "../vendor/autoload.php";
require '../connect.php';

include 'header.php';
?>

    <body>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="http://via.placeholder.com/1907x680" alt="...">
                <div class="carousel-caption">
                    <div>
                        <p class="premierParaSlider">KARURA EST SPÉCIALISÉE</p>
                        <p class="secondeParaSlider">DANS LES TENUES DE SPORT ARTISTIQUE</p>
                    </div>
                    <p class="troisiemeParaSlider">maillot de bain, justaucorps, jupette, léotard...</p>
                </div>
            </div>
            <div class="item">
                <img src="http://via.placeholder.com/1907x680" alt="...">
                <div class="carousel-caption">
                    <div>
                        <p class="premierParaSlider">Natation synchronisée, twirling, GR,</p>
                        <p class="secondeParaSlider">patinage, gym, cirque, majorette...</p>
                    </div>
                    <p class="troisiemeParaSlider">...NOUS CRÉONS VOTRE MODÈLE ADAPTÉ À VOTRE ENVIES</p>
                </div>
            </div>
            <div class="item">
                <img src="http://via.placeholder.com/1907x680" alt="...">
                <div class="carousel-caption">
                    <div>
                        <p class="premierParaSlider">KARURA EST SPÉCIALISÉE</p>
                        <p class="secondeParaSlider">DANS LES TENUES DE SPORT ARTISTIQUE</p>
                    </div>
                    <p class="troisiemeParaSlider">maillot de bain, justaucorps, jupette, léotard...</p>
                </div>
            </div>
            <div class="item">
                <img src="http://via.placeholder.com/1907x680" alt="...">
                <div class="carousel-caption">
                    <div class="premierePartieCaption">
                        <p class="premierParaSlider">Natation synchronisée, twirling, GR,</p>
                        <p class="secondeParaSlider">patinage, gym, cirque, majorette...</p>
                    </div>
                    <p class="troisiemeParaSlider">...NOUS CRÉONS VOTRE MODÈLE ADAPTÉ À VOTRE ENVIES</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


<!-- TEST affichage -->
    <?php
    $categoryController = new \Karura\Controller\CategoryController();
    echo  $categoryController->showAllAction();
    ?>


<?php
include 'footer.php';
?>