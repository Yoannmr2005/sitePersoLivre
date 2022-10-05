<?php
include("vues/compte/modal.html")
?>
<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue qui affiche un tableau de tous les genres
-->
<div class="container text-center">
    <h1>Genres</h1>
    <button type="button" class="btn btn-success btn-rounded" style="float: right;">
        <a href="index.php?uc=admin&action=ajouterGenre" class="text-decoration-none text-white" >Ajouter un genre</a>
    </button>
    <br>
    <br>
    <div class="row">
        <table class="table table-success table-striped">
            <tr>
                <th>Id</th>
                <th>Nom du Genre</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($dataGenre as $genre) {
            ?>
                <tr>
                    <td><?= $genre->getIdgenre() ?></td>
                    <td><?= $genre->getGenre() ?></td>
                    <td>
                        <a href="index.php?uc=admin&action=modifierGenre&id=<?= $genre->getIdgenre() ?>">
                            <img src="img/crayon.png" alt="image de modification">
                        </a>

                        <button onclick="document.getElementById('id<?= $genre->getIdgenre() ?>').style.display='block'" class="delete">
                            <img src="img/suppression.png" alt="image de suppression">
                        </button>

                        <div id="id<?= $genre->getIdgenre() ?>" class="modal">
                            <span onclick="document.getElementById('id<?= $genre->getIdgenre() ?>').style.display='none'" class="close" title="Close Modal">×</span>
                            <form class="modal-content" method="POST" action="">
                                <div class="containerModal">
                                    <h1>Supprimer Genre</h1>
                                    <p>Es-tu sûr de vouloir supprimer ce genre ?</p>
                                    <p class="text-danger h4">ATTENTION ! Si le genre est utilisée par des livres, les livres liés seront supprimés</p>
                                    <div class="clearfix">
                                        <input type="hidden" name="idgenre" value="<?= $genre->getIdgenre() ?>">
                                        <button type="submit" onclick="document.getElementById('id<?= $genre->getIdgenre() ?>').style.display='none'" name="annuler" class="cancelbtn">Annuler</button>
                                        <button type="submit" onclick="document.getElementById('id<?= $genre->getIdgenre() ?>').style.display='none'" name="supprimer" value="supprimer" class="deletebtn">
                                            <a href="index.php?uc=admin&action=supprimerGenre&id=<?= $genre->getIdgenre() ?>" class="text-decoration-none text-black">Supprimer</a>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>

            <?php
            }
            ?>

        </table>
    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>