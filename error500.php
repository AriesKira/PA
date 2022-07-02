<?php include "./stylesheet/template/header.php"; ?>
<div class="text-center">
    <h1>OH NON ! UN PROBLEME INTERNE EST SURVENU RETOURNE À L'ACCEUIL</h1>
    <p style="color: black;">Clique pour une vue spéctaculaire</p>
    <button id="500btn" type="button" class="btn btn-dark" onclick="display500()">
        <lord-icon src="https://cdn.lordicon.com/fetyzpiw.json"trigger="click"style="width:250px;height:250px;" colors="primary:#fff"></lord-icon>
    </button>
    <video controls loop="infinite" src="stylesheet/videos/error500.mp4" hidden id="error500"></video>
</div>