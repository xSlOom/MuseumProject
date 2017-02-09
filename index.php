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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Les musées de nos Régions</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSPF5q5m2uk0mcsHl48SFcCukZ7ksQY_E"></script>
    <script type="text/javascript" src="js/jquery.googlemap.js"></script>
    <script src="js/materialize.min.js"></script>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="search.php">Liste des musées</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="search.php">Liste des musées</a></li>
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
        <h4 class="center header">Quelques musées ...</h4>
        <?php
        $musee = $fl->getFourMusees();
        for ($i = 0; $i < sizeof($musee); $i++):
            ?>
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title"><?php echo $musee[$i]["nom_du_musee"]; ?></span>
                        <p><?php echo $musee[$i]["adresse"]; ?> <br /> <?php echo $musee[$i]["cp"]; ?> <?php echo $musee[$i]["ville"]; ?></p>
                    </div>
                    <div class="card-action">
                        <a id="link<?php echo $i; ?>" onClick="reply_click(this.id)" href="#modal<?php echo $i; ?>">En apprendre plus</a>
                    </div>
                </div>
            </div>
            <div id="modal<?php echo $i; ?>" class="modal">
                <div class="modal-content">
                    <h5 id="musee<?php echo $i; ?>"><?php echo $musee[$i]["nom_du_musee"]; ?></h5>
                    <img src="<?php echo $musee[$i]["lien_image"]; ?>" />
                    <p id="adress<?php echo $i ; ?>"><strong>Adresse:</strong> <?php echo !empty($musee[$i]["adresse"]) ? $musee[$i]["adresse"] . "," : ""; ?><?php echo $musee[$i]["cp"]; ?> <?php echo $musee[$i]["ville"]; ?></p>
                    <p><strong>Téléphone:</strong> <?php echo !empty($musee[$i]["telephone"]) ? $musee[$i]["telephone"] : "Pas de téléphone"; ?></p>
                    <p><strong>Ouverture:</strong> <?php echo !empty($musee[$i]["periode_ouverture"]) ? $musee[$i]["periode_ouverture"] : "Y'a rien"; ?></p>
                    <p><strong>Site web:</strong> <?php echo !empty($musee[$i]["site_web"]) ? $fl->text2Link($musee[$i]["site_web"]) : "Aucun site"; ?></p>
                    <div id="map<?php echo $i; ?>" style="width: 100%; height: 300px;"></div>
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
    function reply_click(id) {
        var nid= id.replace( /^\D+/g, '');
        $(function() {
            var adress = $("#adress" + nid + "").html().split('</strong>')[1].replace(/ /g, '+');
            var musee = $("#musee" + nid + "").html();
            console.log(musee);
            $.ajax({
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + adress + "&key=AIzaSyBSPF5q5m2uk0mcsHl48SFcCukZ7ksQY_E",
                success: function(result){
                    var localisation = result.results[0]["geometry"]["location"];
                    $("#map" + nid).googleMap();
                    $("#map" + nid).addMarker({
                        coords: [localisation["lat"], localisation["lng"]], // GPS coords
                        title: '<h5>' + musee + ' </h5>', // Title
                        text:  $("#adress" + nid + "").html().split('</strong>')[1] // HTML content
                    });
                }
            });
        })
    }
    $(document).ready(function(){
        $(".button-collapse").sideNav();
        $('.modal').modal();
        $('.parallax').parallax();
    });
</script>
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            © 2017 Musée
        </div>
    </div>
</footer>
</html>