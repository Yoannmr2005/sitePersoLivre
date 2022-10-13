# Manuel d'installation du site 'YoBook'

### Etape 1 : 
- Exécuter le script sql 'ScriptDBlivre.sql' dans votre client sql

### Etape 2 : 
- Modifier les données des variables du fichier 'monPdo.php' dans le dossier 'modeles' avec un compte avec les droits CRUD

### Etape 3 :
- Ouvrez le terminal et aller dans le dossier www.<br>
- Ensuite, donner les droits aux images avec la commande :<br>
'sudo chmod 777 img/'

### Etape 4 :
- Changer le 'upload_max_filesize' à 10M.
- Vérifier si file_uploads est 'On'

### Informations :
Il existe déjà 3 comptes :
- Yoann (mot de passe 'Super2022', compte utilisateur)
- Jean (mot de passe 'Super2022', compte utilisateur)
- Admin (mot de passe 'Super2022', compte administrateur)