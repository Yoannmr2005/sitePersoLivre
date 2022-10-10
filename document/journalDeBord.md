# Journal de bord

## Jour 1 : Lundi 26 Septembre

### Objectif

- Faire le cahier des charges
- Faire le Trello
- Découvrir MVC
- Découvrir Bootstrap
- Faire le html du header
- Faire le contrôleur principal

### Déroulement

J'ai d'abord regarder le tuto udemy sur MVC https://www.udemy.com/course/creer-un-site-php-avec-bootstrappdo-et-mvc-pour-debutant/ (section 10 à 14).
En regardant le tuto, j'ai commencé mon site et j'ai fait le contrôleur principal, les classes dans le modèle et le bootstrap du header.
J'ai également fait le Trello et le cahier des charges.
L'après-midi, j'ai fait la page d'accueil (contrôleur et vue boostrap).

### Bilan 

J'ai bien commencé mon projet en apprenant boostrap et MVC ce qui me permet de m'améliorer en tant que développeur.

## Jour 2 : Mercredi 28 Septembre

### Objectif

- Page qui liste tous les livres du site
- Page qui permet de voir les détails du livre sélectionnez
- Page de connexion / déconnexion

### Déroulement

Le matin, j'ai fait le contrôleur et la vue de la liste de tous les livres.
J'ai eu quelques problèmes car je ne connais pas bien bootstrap et aussi dans le contrôleur car je n'ai jamais utilisé le MVC.

L'après-midi, j'ai fait la page de détail du livre (contrôleur et vue) ainsi que la connexion et la déconnexion.
L'après-midi a été plus simple car j'ai mieux compris comment utiliser MVC et j'ai également l'habitude de faire un login.

### Bilan

Cette journée a été fructueuse malgré des problèmes que j'ai résolus en regardant sur Internet (surtout bootstrap) ou en revoyant le tuto MVC.
Malheureusement, je n'ai pas proprement terminé le login.<br>À finir demain.

## Jour 3 : Jeudi 29 Septembre

### Objectif

- Finir le login
- Inscription au site
- page qui affiche la liste personnelle
- Bouton pour supprimer un livre de la liste personnelle
- Bouton pour ajouter un livre dans la liste personnelle (depuis la page de détail du livre)
- Commencer le CRUD du compte

### Déroulement

Le matin, j'ai fini le login et j'ai ensuite fait l'inscription au site.
J'ai eu quelques bugs de base de données avec les fonctions que j'ai faites lundi mais j'ai corrigé les fonctions et j'en ai ajouté également.<br>
Ensuite, j'ai fait le bouton pour ajouter un livre dans la liste personnelle et j'ai eu quelques problèmes pour savoir si le livre est déjà dans la liste mais j'ai finalement réussi.

L'après-midi, j'ai fait la page d'affichage de la liste personnelle (vue et contrôleur) ainsi que le bouton pour enlever un livre de la liste.
J'ai eu quelques problèmes que j'ai finis par résoudre en regardant les messages erreurs. 
Après la pause de l'après-midi, j'ai fait la page pour gérer le compte et la page de modification.

### Bilan

Aujourd'hui, j'ai été productif malgré les problèmes et les erreurs mais je n'ai pas réussi à finir le CRUD du compte puisqu'il me reste la suppression.

## Jour 4 : Lundi 03 Octobre

### Objectif

- Ajout de la suppression
- Ajout page admin pour gérer les livres et les genres
- Liste des genres et listes des livres
- Modification livre

### Déroulement

Aujourd'hui, j'ai continué le projet. Je n'ai pas eu de problème jusqu'à ce que je modifie un livre.
En effet, j'ai une erreur de droit qui fait que je ne peux pas supprimer l'image pour mettre la nouvelle.
J'ai cherché comment faire sur internet et j'ai regardé les droits des dossiers (chmod) et les droits de l'utilisateur de la DB mais sans succès.
Au bout d'une heure et demie, j'ai décidé de passer à autre chose et de faire la liste et la modification de genre.

### Bilan

Bonne journée malgré un bug non résolu qui m'a ralenti dans l'avancement du projet

## Jour 5 : Mercredi 05 Octobre

### Objectif

- Suppression de genre
- Ajout compte admin
- résoudre le problème de droit
- installer AMP sur WSL

### Déroulement

Ce matin, tout ce passe bien, j'ai fait la supression du genre et des livres liés à ce genre ainsi que l'ajout de compte admin.
L'après, j'ai essayé de nouveau de corriger le problème de droit mais sans succèes puis j'ai installé AMP sur WSL car avant j'utilisais Debian AMP de Monsieur Wanner.
Ensuite, j'ai optimisé mon code (fonction, commentaire) et j'ai fait les droits d'accès.
Finalement, j'ai réussi à supprimer une image en donnant les droits au dossier img. (sudo chmod 777 img/)

### Bilan

Bonne journée car j'ai réussi à bien avancer et à corriger le gros bug en plus d'avoir installé et configurer AMP

## Jour 6 : Jeudi 06 Octobre

### Objectif

- Ajout de livre
- Suppression de livre

### Déroulement

Ce matin, en arrivant j'ai ouvert dbeaver et j'ai eu une erreur. J'ai passé la matiné à faire marcher Dbeaver en réinstallant WSL et AMP car je n'avais pas de droit.
Cet après-midi, j'ai fait comme prévu l'ajout de véhicule ainsi que la suppression sans trop de problèmes.

### Bilan

Matinée cauchemardesque où je n'ai pas peut travailler mais un après-midi efficace qui me permet de finir les dernières fonctionnalités prévues dans le cahier des charges.

## Jour 7 : Lundi 10 Octobre

### Objectif

- finaliser la modification de livre (oublie du genre et vérification de l'image-> extension et déjà utilisée par un autre livre)
- optimiser le code
- faire de la documentation
- faire une présentation
- faire un scénario de l'utilisation de mon site

### Déroulement

Aujourd'hui, j'ai finaliser la modification du livre en regardant si il y a un image, si oui je supprime l'ancienne et en met un nouvelle, sinon je modifie tous sauf l'image. J'ai également optimser le code en redirigant sur l'index si l'utilisateur modifie l'url etc.

### Bilan

Bonne journée ou je suis arrivé à la fin du projet néanmois, il me reste la documentation et la présentation à faire.

### Jour 8 : Mercredi 12 Octobre

### Objectif

- optimiser le code si je vois des choses à faire
- documentation (procédure pour faire marcher le site)
- présentation PowerPoint