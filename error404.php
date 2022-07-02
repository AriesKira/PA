<?php include "./stylesheet/template/header.php"; ?>
<div class="text-center">
    <h1>OH NON ! LA PAGE N'A PAS ÉTÉ TROUVÉ RETOURNE À L'ACCEUIL</h1>
    <p style="color: black;">Clique pour une vue spéctaculaire</p>
    <button id="404btn" type="button" class="btn btn-dark" onclick="display404()">
        <lord-icon src="https://cdn.lordicon.com/fetyzpiw.json"trigger="click"style="width:250px;height:250px;" colors="primary:#fff"></lord-icon>
    </button>
    <video controls loop="infinite" src="stylesheet/videos/error404.mp4" hidden id="error404"></video>
</div>