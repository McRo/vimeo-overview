<html>


<script src="scripts/js/jquery-3.5.1.min.js" ></script>
<script src="scripts/js/overview.js" ></script>

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
    <a href="?refresh">Rafraichir les infos</a>

    <table>
        <thead>
        <tr class="">
            <td>id</td>
            <td>Nom</td>
            <td>Liens</td>
            <td>Password</td>
            <td>Privacy</td>
            <td>Manage</td>
        </tr>
        </thead>
        <tr class="baseline">
            <td class="id"></td>
            <td class="name"></td>
            <td class="links"></td>
            <td class="password"></td>
            <td class="privacy"></td>
            <td class="manage"></td>

        </tr>


</body>




</html>