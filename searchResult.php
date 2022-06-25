<?php
    include "./functions.php";

    $userSearch = htmlspecialchars( $_REQUEST['uSearch']);

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT pseudo FROM AROOTS_USERS WHERE pseudo LIKE '%$userSearch%'");
    $queryPrepared -> execute();
    $nb = $queryPrepared->rowcount();
    $users = $queryPrepared->fetchAll(PDO::FETCH_COLUMN, 0);
    
    
    $result ="";

    if ($nb >0) {
        if ($userSearch !=="") {
            foreach($users as $usernames) {
                if ($result ==="") {
                    $result = "<a href='./userProfile.php?pseudo=$usernames'><div class='card searchResult'>$usernames</div></a>";
                }else {
                    $result .= "<a href='./userProfile.php?pseudo=$usernames'><div class='card searchResult'>$usernames</div></a>";
                }
            }
        }
    }

    echo $result === "" ? "<div class='card searchResult'>no suggestion</div>" : $result;
