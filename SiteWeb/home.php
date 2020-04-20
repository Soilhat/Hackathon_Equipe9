<?php
include('db/config.php')
?>
<!DOCTYPE html>
<html lang="en">

    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        body {font-family: "Lato", sans-serif}
        .mySlides {display: none
        }
        a:link {
            text-decoration:none;
        }
    </style>

    <body>

    <?php
    include('Navbar.php')
    ?>

    <!--<div class="w3-content" style="max-width:2000px;margin-top:46px">
        <div class="mySlides w3-display-container w3-center">
            <img src="css/Jax.jpg" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
                <a href="https://universe.leagueoflegends.com/fr_FR/champion/jax/" target="_blank"><h3>God Staff Jax</h3></a>
                <p><b>Maître d'armes</b></p>
            </div>
        </div>

        <div class="mySlides w3-display-container w3-center">
            <img src="css/Kaisa.jpg" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
                <a href="https://universe.leagueoflegends.com/fr_FR/champion/kaisa/" target="_blank"><h3>Invictus Gaming Kai'sa</h3></a>
                <p><b>Fille du Néant</b></p>
            </div>
        </div>

        <div class="mySlides w3-display-container w3-center">
            <img src="css/Kayn.jpg" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
                <a href="https://universe.leagueoflegends.com/fr_FR/champion/kayn/" target="_blank"><h3>Odyssey Kayn</h3></a>
                <p><b>Faucheur de l'ombre</b></p>
            </div>
        </div>

        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
            <h2 class="w3-wide">E-Squad</h2>
            <p class="w3-opacity"><i>Description</i></p>
            <p class="w3-justify">Vous en avez assez de vous retrouver en game avec des random russes à l’autre bout de la Sibérie ? Essayez E-Squad !
                E-Squad est un site en ligne vous permettant de trouver des partenaires de jeux de votre niveau jouant aux mêmes horaires que vous.
                Avec E-Squad, vous découvrez de nouvelles personnes, communiquez avec elles et si le courant passe bien, ajoutez-les pour qu’elles puissent rejouer avec vous !
        </div>


        <div class="w3-black">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
                <h2 class="w3-wide w3-center">League of Legends</h2>
                <p class="w3-opacity w3-center"><i>World Championship</i></p><br>

                <ul class="w3-ul w3-border w3-white w3-text-grey">
                    <li class="w3-padding">2017 - Chine </li>
                    <li class="w3-padding">2018 - Corée du Sud  </li>
                    <li class="w3-padding">2019 - Europe Finale à Paris  </li>
                </ul>

                <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
                    <div class="w3-third w3-margin-bottom">
                        <img src="https://i.imgur.com/s7HVv6e.jpg" alt="New York" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Europe</b></p>
                            <p class="w3-opacity">2017</p>
                            <p>Vainqueur : Samsung Galaxy</p>
                            <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">More infos</button>
                        </div>
                    </div>
                    <div class="w3-third w3-margin-bottom">
                        <img src="http://cms.ggnetwork.tv/ggnetwork/wp-content/uploads/2018/10/lol-worlds-2018-01.jpg" alt="Paris" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Chine</b></p>
                            <p class="w3-opacity">2018</p>
                            <p>Vainqueur : Invictus Gaming</p>
                            <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">More infos</button>
                        </div>
                    </div>
                    <div class="w3-third w3-margin-bottom">
                        <img src="https://www.breakflip.com/uploads/LoL/Sting/R%C3%A9gions%20Worlds%202019-21/LoL-Worlds-Europe.jpg" alt="San Francisco" style="width:100%" class="w3-hover-opacity">
                        <div class="w3-container w3-white">
                            <p><b>Europe</b></p>
                            <p class="w3-opacity">Finale à Paris, 2019</p>
                            <p></p>
                            <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">More infos</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
            <h2 class="w3-wide w3-center">CONTACT</h2>
            <p class="w3-opacity w3-center"><i>Un commentaire ? Une question ? Nous sommes à l'écoute !</i></p>
            <div class="w3-row w3-padding-32">
                <div class="w3-col m6 w3-large w3-margin-bottom">
                    <i class="fa fa-map-marker" style="width:30px"></i> Freljord<br>
                    <i class="fa fa-phone" style="width:30px"></i> Phone: 0684429718<br>
                    <i class="fa fa-envelope" style="width:30px"> </i> Email: Calvin.pj@sfr.fr<br>
                </div>
                <div class="w3-col m6">
                    <form action="" target="_blank">
                        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
                            </div>
                        </div>
                        <input class="w3-input w3-border" type="text" placeholder="Message" required name="Message">
                        <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <img src="css/runetrra.PNG" class="w3-image w3-greyscale-min" style="width:100%">


    <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
        <p class="w3-medium">Powered by <a href="https://www.facebook.com/profile.php?id=100009243562580" target="_blank">Calvin Pierre-Joseph</a><br></p>
    </footer>

    <script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}
            x[myIndex-1].style.display = "block";
            setTimeout(carousel, 4000);
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('ticketModal');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>-->

    </body>
</html>