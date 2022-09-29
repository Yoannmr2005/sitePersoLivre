<div class="container text-center">
    <h1>Mon compte</h1>
    <div class="row">
        <table class="table table-success table-striped">

            <tr>
                <th>Nom</th>
                <th>E-mail</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><?= $infoCompte->getNom() ?></td>
                <td><?= $infoCompte->getEmail() ?></td>
                <td>
                    <a href="index.php?uc=compte&action=modifier">
                        <img src="img/crayon.png" alt="image de modification">
                    </a>
                    <a href="index.php?uc=compte&action=suppprimer">
                        <img src="img/suppression.png" alt="image de suppression">
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>