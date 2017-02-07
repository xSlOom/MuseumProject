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
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/materialize.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSPF5q5m2uk0mcsHl48SFcCukZ7ksQY_E"></script>
        <script type="text/javascript" src="js/jquery.googlemap.js"></script>
        <script src="js/materialize.min.js"></script>
    </head>
    <body>
        <nav>
            <div class="nav-wrapper">
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="search.php">Liste des musées</a></li>
                    <li><a href="#">Ajouter un musée</a></li>
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
                <h4 class="center header">Rechercher un ou des musées...</h4>
                <form class="col s12" method="post">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="icon_prefix" type="text" id="nom" name="nom" class="validate">
                            <label for="icon_prefix">Rechercher ..</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="radio" class="filled-in" id="dep" name="dep" />
                            <label for="dep">Rechercher par département</label>
                            <input type="radio" class="filled-in" id="dep1" name="cdp" />
                            <label for="dep1">Rechercher par code postal</label>
                            <input type="radio" class="filled-in" id="dep2" name="vl" />
                            <label for="dep2">Rechercher par ville</label>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST)):
                    if (!empty($_POST["nom"])):
                        if (isset($_POST["dep"])):
                            $data   = $fl->searchByDep($_POST["nom"]);
                        elseif (isset($_POST["cdp"])):
                            $data   = $fl->searchByCdp($_POST["nom"]);
                        elseif (isset($_POST["vl"])):
                            $data   = $fl->searchByCity($_POST["nom"]);
                        else:
                            $data   = $fl->searchAll($_POST["nom"]);
                        endif;
                        if (sizeof($data) < 1):
                            print "Nothing found..";
                        else:
                            print "<h4 class=\"center header\">". sizeof($data) . " resultat(s) trouvé(s): </h4>";
                            for ($i = 0; $i < sizeof($data); $i++):
                ?>
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-content">
                            <h5 class="card-title"><?php echo $data[$i]["nom_du_musee"]; ?></h5>
                            <p><?php echo $data[$i]["cp"]; ?> <?php echo $data[$i]["ville"]; ?></p>
                        </div>
                        <div class="card-action">
                            <a id="link<?php echo $i; ?>" onClick="reply_click(this.id)" href="#modal<?php echo $i; ?>">En apprendre plus</a>
                        </div>
                    </div>
                </div>
                <div id="modal<?php echo $i; ?>" class="modal">
                    <div class="modal-content">
                        <h5 id="musee<?php echo $i ; ?>"><?php echo $data[$i]["nom_du_musee"]; ?></h5>
                        <img src="<?php echo $data[$i]["lien_image"]; ?>" />
                        <p id="adress<?php echo $i ; ?>"><strong>Adresse:</strong> <?php echo !empty($data[$i]["adresse"]) ? $data[$i]["adresse"] . "," : ""; ?><?php echo $data[$i]["cp"]; ?> <?php echo $data[$i]["ville"]; ?></p>
                        <p><strong>Téléphone:</strong> <?php echo $data[$i]["telephone"]; ?></p>
                        <p><strong>Ouverture:</strong> <?php echo $data[$i]["periode_ouverture"]; ?></p>
                        <p><strong>Site web:</strong> <?php echo !empty($data[$i]["site_web"]) ? $fl->text2Link($data[$i]["site_web"]) : "Aucun site"; ?></p>
                        <div id="map<?php echo $i; ?>" style="width: 100%; height: 300px;"></div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Fermer</a>
                    </div>
                </div>
                <?php endfor; ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
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

            $('.modal').modal();
            $('.parallax').parallax();
        });
    </script>
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                © 2017
            </div>
        </div>
    </footer>
</html>
