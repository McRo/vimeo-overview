<!DOCTYPE html>
<html>


<script src="scripts/js/jquery-3.5.1.min.js" ></script>
<script src="scripts/js/overview.js?n=<?=rand(0,27)?>" ></script>

<style>
    thead{
        position: sticky;
        top:0;
        background:white;
    }
    .baseline{
        display:none;
    }

</style>
<?php

    if(isset($_GET['refresh'])){
        array_map( 'unlink', array_filter((array) glob("./data/*") ) );
    };

?>


<body>
    <span class="loader"></span>
    <a class="refresh" href="?refresh">Rafraichir les infos</a>
    <button onclick="javaScript:getCSV()">Télécharger</button>
    <input id="find" type="text" placeholder="Rechercher" />

    <table id="coucou">
        <thead>
        <tr class="">
            <!-- <td>id</td> -->
            <td>Thumnail</td>
            <td>Mise en ligne</td>
            <td>Album</td>
            <td>Nom</td>
            <td>Durée</td>
            <td>Liens</td>
            <td>Password</td>
            <td>Privacy</td>
            <td>Manage</td>
        </tr>
        </thead>
        <tr class="baseline">
            <!-- <td class="id"></td> -->
            <td class="picture"></td>
            <td class="upload_date"></td>
            <td class="album"></td>
            <td class="name"></td>
            <td class="duration"></td>
            <td class="links"></td>
            <td class="password"></td>
            <td class="privacy"></td>
            <td class="manage"></td>

        </tr>


</body>




</html>
