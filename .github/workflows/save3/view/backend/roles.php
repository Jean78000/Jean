<?php $title = 'Roles'; ?>


<?php ob_start();?>

<div id="myBody">        
    <a href="index.php?action=accueil" class="btn btn-outline-primary" id="rolesAccueilButton"><i class="fas fa-home"></i>Accueil</a>
    <div id="verticaleMiddle">
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col"><i class="fas fa-portrait"></i>ID</th>
                <th scope="col"><i class="fas fa-users"></i>Prenom</th>
                <th scope="col"><i class="fas fa-user-tag"></i>Rôle</th>
            </tr>
        </thead>
        <tbody>
        <?php
    while ($getRole = $roles->fetch()) {  
    ?>
                <tr>
                    <th scope="row"><?=$getRole['id']?></th>
                    <td><?=$getRole['pseudo']?></td>
                    <td>
                        <?php
                        if ($getRole['role'] == 1) {
                            ?> <a href="index.php?action=nommeAdmin&amp;id=<?=$getRole['id']?>" class="btn btn-primary" id="rolesButtons">Utilisateur</button>
                        <?php } 
                        else { ?> <a href="index.php?action=nommeUser&amp;id=<?=$getRole['id']?>" class="btn btn-success" id="rolesButtons">Admin</button>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="index.php?action=deleteUser&amp;id=<?=$getRole['id']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Supprimer</button>
                    </td>
                </tr>
    <?php 
    } 
    ?>
        </tbody>
    </table>

</div>

<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>
