<?php include "stylesheet/template/header.php"; ?>
<?php 
   
    $conv = $_GET['conv'];
    $user1 = getUsersFromConv($conv);
    $user1 = $user1[0];

    $user2 = getUsersFromConv($conv);
    $user2 = $user2[1];

    
    $errors = [];

    if ($_SESSION['idUser'] != ($user1 || $user2)) {
        $errors[]= "Cette conversation est réservé à ses propriétaires";
        $_SESSION['errors'] = $errors;
        header("Location: ./index.php");
    }

    
?>
<div class="messageRoom container-fluid vh-100">
    <div class="row pt-5 pb-5 mx-auto">
        <section class="chat w-50 mx-auto mt-5">
            <div class="messages overflow-auto shadow text-wrap">
                <div class="message w-auto rounded-pill">
                    <span class="date">12:12</span>
                    <span class="author">gil</span>
                    <span class="content">Mon Message</span>
                </div>
                <div class="message w-auto rounded-pill">
                    <span class="date">12:12</span>
                    <span class="author">gil</span>
                    <span class="content">Mon Message</span>
                </div>
                <div class="message w-auto rounded-pill ">
                    <span class="date">12:12</span>
                    <span class="author">gil</span>
                    <span class="content">Mon Message</span>
                </div>
            </div>
            <div class="user-inputs shadow">
                <form method="POST" id="messageForm" action="./messagesHandler.php?conv=<?php echo $conv ?>">
                    <input type="text" name="content-text" id="content-text" placeholder="Écris ici...">
                    <button type="submit" class="btn btn-info " >Envoyer</button>
                </form>
            </div>
        </section>
    </div>
</div>
<div id="searchResults"></div>
<script src="./sendMessages.js"></script>
<?php include "stylesheet/template/footer.php"; ?>