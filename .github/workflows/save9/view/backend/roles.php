<?php $title = 'Roles'; ?>


<?php ob_start();?>

    <a href="index.php?action=accueil" class="btn btn-outline-primary" id="rolesAccueilButton"><i class="fas fa-home"></i>Accueil</a>
    <table class="table table-striped" class="col-10">
                <thead>
                    <tr>
                        <th><i class="fas fa-portrait"></i>ID</th>
                        <th><i class="fas fa-users"></i>Prenom</th>
                        <th class="mail"><i class="fas fa-envelope-open"></i>Email</th>
                        <th><i class="fas fa-user-tag"></i>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($getRole = $roles->fetch()) {  
                ?>
                    <tr>
                        <th scope="row"><?=$getRole['id']?></th>
                        <th><?=$getRole['pseudo']?></th>
                        <th class="mail"><?=$getRole['email']?></th>

                        <th>
                            <?php
                            if ($getRole['role'] == 1) {
                                ?> <a href="index.php?action=nommeAdmin&amp;id=<?=$getRole['id']?>" class="btn btn-primary" id="rolesButtons">Utilisateur</button>
                            <?php } 
                            else { ?> <a href="index.php?action=nommeUser&amp;id=<?=$getRole['id']?>" class="btn btn-success" id="rolesButtons">Admin</button>
                            <?php } ?>
                        </th>
                        <th>
                            <a href="index.php?action=deleteUser&amp;id=<?=$getRole['id']?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i><span id="spanRoles">Supprimer</span></button>
                        </th>
                    </tr>
                <?php 
                } 
                ?>
                </tbody>
            </table>


<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>