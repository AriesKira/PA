<?php include "./stylesheet/template/header.php"; ?>
<?php

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = intval($_GET['page']);
    }else{
        $currentPage = 1;
    };

    $errors = [];

    if (!isConnected()) {
        $errors[] = "Vous devez êtres connecté";
        $_SESSION['errors'] = $errors;
        header("Location: ./index.php");
    }
    if (!isAdmin($userID)) {
        $errors[] = "Seul les administrateurs peuvent accéder à cette endroit !";
        $_SESSION['errors'] = $errors;
        header("Location: ./index.php");
    }

    $pdo = connectDB();

    $countUsers = $pdo->prepare("SELECT count(pseudo) FROM AROOTS_USERS");
    $countUsers->execute();
    $userCount = $countUsers->fetch();

    $nbUsers = intval($userCount[0]);
    $offset = 10;
    $limit = ($currentPage * $offset)-$offset;
    $pages = ceil($nbUsers/$offset);
    
    

    $queryPrepared = $pdo -> prepare("SELECT * FROM AROOTS_USERS LIMIT :limite, :offset");
    $queryPrepared->bindValue(':limite',intval(trim($limit)),PDO::PARAM_INT);
    $queryPrepared->bindValue(':offset',intval(trim($offset)),PDO::PARAM_INT);
    $queryPrepared -> execute();
    $users = $queryPrepared->fetchALL();


   
?>

<div class="adminPage">
    <?php
        echo '<div>';
    if (isset($_SESSION['success'])) {
            $nbSuccess = intval($_SESSION['success']);
            echo '<div class="alert alert-success pb-1" role="alert">';
            echo '<h5 class="fw-bold">'.$nbSuccess.' changements appliqué avec succès</h5>';
            echo '</div>';
            unset($_SESSION['success']);
        }
        echo '</div>';
        echo '<div>';
        if (!empty($_SESSION['errors']) && isset($_SESSION['errors'])) {
            echo '<div class="alert alert-danger pb-1" role="alert">';
    
            for ($i = 0; $i < count($_SESSION['errors']); $i++) {
            $element = $_SESSION['errors'][$i];
            echo '<h5 class="fw-bold">- ' . $element . '</h5>';
            }
            echo '</div>';
            unset($_SESSION['errors']);
        }
        echo '</div>';
    ?>

    <div class="row pt-5">
        <div class="col"></div>
        <div class="col text-center">
            <h1 id="adminPageTitle">Administration</h1>
        </div>
        <div class="col"></div>
    </div>
    <div class="row pt-5">
        <div class="col-2"></div>
        <div class="col-8 usersTable overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id de l'utilisateur</th>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Inscrit depuis</th>
                        <th>Dernière connéxion</th>
                        <th>Validation</th>
                        <th>Administrer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($users as $user) {
                            echo '
                            <tr>
                                <td>'.$user['idUser'].'</td>
                                <td>'.$user['pseudo'].'</td>
                                <td>'.$user['email'].'</td>
                                <td>'.$user['signUpDate'].'</td>
                                <td>'.$user['lastConnection'].'</td>
                                <td>';if (isValidated($user['idUser'])) {
                                    echo '<p style="color: green">Validé</p>';
                                }else {
                                    echo '<p style="color: red">Pas validé</p>';
                                }
                                echo '</td>
                                <td>
                                    <div class="btn-group" role="group">
                                            <a type="button" class="btn btn-primary" href="./adminModUser.php?user='.$user['idUser'].'" >Modifier</a>
                                        ';if (!isValidated($user['idUser'])) {
                                            echo'<button type="button" class="btn btn-warning" onclick="validate('.$user['idUser'].')">Validé</button>';
                                        }
                                        echo'
                                        <button type="button" class="btn btn-danger" onclick="deleteUser('.$user['idUser'].')">supprimer</button>
                                        ';if (!isAdmin($user['idUser'])) {
                                            if (isWebmaster($user['idUser'])){
                                                echo '<button id="setRoleButton_'.$user['idUser'].'" type="button" class="btn btn-outline-warning" value="'.$user['idUser'].'" onclick="displayRoleChoice('.$user['idUser'].')">Rôle</button>';
                                            }else{
                                                echo '<button id="setRoleButton_'.$user['idUser'].'" type="button" class="btn btn-info" value="'.$user['idUser'].'" onclick="displayRoleChoice('.$user['idUser'].')">Rôle</button>';
                                            }
                                        }
                                        echo'   
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row pt-4 ">
        <div class="col"></div>
        <div class="col">
            <ul class="pagination">
                <li class="page-item <?php  if ($currentPage == 1) { echo "disabled";} ?>">
                    <a href="./admin.php?page=<?php echo $currentPage-1 ?>" class="page-link">Précedent</a>
                </li>
                <?php for($page = 1 ; $page <= $pages ; $page++ ) { ?>
                <li class="page-item <?php if ($currentPage == $page) { echo "active";} ?>">
                   <a href="./admin.php?page=<?php echo $page ?>" class="page-link"><?php echo $page ?></a>
                </li>
                <?php } ?>
                <li class="page-item <?php if ($currentPage == $pages){echo 'disabled';} ?>">
                    <a href="./admin.php?page=<?php echo $currentPage+1 ?>" class="page-link">Suivant</a>
                </li>
            </ul>
        </div>
        <div class="col"></div>
    </div>
    <div class="row pt-3">
        <div class="col"></div>
        <div class="col">
            <img class="img-fluid" src="./stylesheet/images/threadImages/noPostYet.gif">
        </div>
        <div class="col"></div>
    </div>
</div>

<div id="searchResults"></div>
<div hidden id="roleChoice">
   <?php include "./roleChoice.php" ?>
</div>
<?php include "./stylesheet/template/footer.php"; ?>