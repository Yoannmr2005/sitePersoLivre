<?php
include("vues/compte/modal.html")
?>
<!--
  Auteur : Yoann Meier
  Site de livre
  Version : 3.0
  Page : Page de vue qui affiche un tableau de tous les livres
-->
<div class="container text-center">
    <h1>Livres</h1>
    <div class="row">
        <table class="table table-success table-striped">
            <tr>
                <th>Nom</th>
                <th>Annee</th>
                <th>Auteur</th>
                <th>Vente</th>
                <th>Genre</th>
                <th>Action</th>
            </tr>

            <?php
            foreach ($dataLivre as $livre) {
            ?>
                <tr>
                    <td><?= $livre->getNom() ?></td>
                    <td><?= $livre->getAnnee() ?></td>
                    <td><?= $livre->getAuteur() ?></td>
                    <td><?= Livre::ChangeNumberFormat($livre->getVente()) ?></td>
                    <td><?php 
                    $genre = Genre::findById($livre->getIdgenre());
                    echo $genre->genre;
                    ?>
                    </td>
                    <td>
                        <a href="index.php?uc=admin&action=modifierLivre&id=<?= $livre->getIdlivre() ?>">
                            <img src="img/crayon.png" alt="image de modification">
                        </a>

                        <button onclick="document.getElementById('id01').style.display='block'" class="delete">
                            <img src="img/suppression.png" alt="image de suppression">
                        </button>

                        <div id="id01" class="modal">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
                            <form class="modal-content" method="POST" action="">
                                <div class="containerModal">
                                    <h1>Supprimer Livre</h1>
                                    <p>Es-tu sûr de vouloir supprimer ce livre ?</p>
                                    <div class="clearfix">
                                        <button type="submit" onclick="document.getElementById('id01').style.display='none'" name="annuler" class="cancelbtn">Annuler</button>
                                        <button type="submit" onclick="document.getElementById('id01').style.display='none'" name="supprimer" value="supprimer" class="deletebtn">Supprimer</button>
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