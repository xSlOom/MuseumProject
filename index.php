<?php
include("classes/connection.class.php");
include("classes/functions.class.php");
$db = new Connection("localhost", "root", "", "musees");
$fl = new Functions();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Les musées de nos Régions</title>
        <link rel="stylesheet" href="css/materialize.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="js/materialize.min.js"></script>
        <style>
            .parallax-container {
                height: 500px;
            }

            .nav-wrapper {
                background: #36163F !important;
            }
            nav li a {
                color: #F5BA97;
            }
            #link {
                color: #36163F;
            }
            #cc {
                color: #36163F;
            }
            nav li a:hover {
                background: #71476E;
            }
        </style>
    </head>
    <body>
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">Logo</a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Liste des musées</a></li>
                    <li><a href="#">Ajouter un musée</a></li>
                    <li></li>
                </ul>
            </div>
        </nav>
        <div class="parallax-container" style="margin-bottom: 3%;">
            <div class="parallax"><img src="img/header.jpg"></div>
            <div class="caption center-align" style="margin-top: 5%;">
                <h3>Les musées de nos Régions</h3>
                <h5 id="cc" >Retrouvez nos beaux musées sur notre site</h5>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <h4 class="center header">Nos derniers ajouts ....</h4>
                <?php
                    $musee = $fl->getFourMusees();
                    for ($i = 0; $i < sizeof($musee); $i++):
                ?>
                        <div class="col s12 m6">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title"><?php echo $musee[$i]["nom_du_musee"]; ?></span>
                                    <p><?php echo $musee[$i]["adr"]; ?> <br /> <?php echo $musee[$i]["cp"]; ?> <?php echo $musee[$i]["ville"]; ?></p>
                                </div>
                                <div class="card-action">
                                    <a id="link" href="#modal<?php echo $i; ?>">En apprendre plus</a>
                                </div>
                            </div>
                        </div>
                        <div id="modal<?php echo $i; ?>" class="modal">
                            <div class="modal-content">
                                <h5><?php echo $musee[$i]["nom_du_musee"]; ?></h5>
                                <?php echo $fl->getImage($musee[$i]["nom_du_musee"] . " " . $musee[$i]["ville"]); ?>
                                <p><strong>Adresse:</strong> <?php echo $musee[$i]["adr"]; ?>, <?php echo $musee[$i]["cp"]; ?> <?php echo $musee[$i]["ville"]; ?></p>
                                <p><strong>Téléphone:</strong> 0<?php echo $musee[$i]["telephone"]; ?></p>
                                <p><strong>Ouverture:</strong> <?php echo $musee[$i]["periode_ouverture"]; ?></p>
                                <p><strong>Site web:</strong> <?php echo !empty($musee[$i]["site_web"]) ? $fl->text2Link($musee[$i]["site_web"]) : "Aucun site"; ?></p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fermer</a>
                            </div>
                        </div>
                <?php endfor; ?>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $('.modal').modal();
            $('.parallax').parallax();
        });
    </script>
    <footer></footer>
</html>
