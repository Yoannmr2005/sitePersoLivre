# Cahier des charges

## Titre :

YoBook

## Développeur

Yoann Meier - P3C

## Matériels et logiciels à disposition

- Visual Studio Code
- Dbeaver
- GitHub

## Prérequis

- PHP
- SQL
- HTML
- CSS
- Connaitre GitHub
- Connaitre et utiliser MVC
- Connaitre et utiliser Bootstrap

## Descriptif complet du projet

Explication :

Ce projet est un site de livre, il prévoit 2 types d'utilisateurs : les admins et les utilisateurs.
Il y a un compte utilisateur on peut voir tous les livres et les ajoutés dans une liste personnelle, on peut également gérer nos informations personnelles.
Il y a également un compte admin pour gérer (modifier, supprimer et ajouter) des livres, des genres et des comptes admin.

Le client a le droit de 
- Afficher une page d'accueil avec
  - Une liste des 5 livres les plus connus
  - une icône pour se connecter / se déconnecter
  - une icône pour accéder à la liste de tous les livres du site
- Afficher une page de connexion depuis l’icône de la page d’accueil
  - Si le client a déjà un compte
    - Son nom lui est demandé
    - Son mdp lui est demandé
  - Si le client n’a pas encore de compte, il peut s’en créer un en allant dans la page inscription depuis la page connexion
    - Un nom lui est demandé
    - Un email 
    - Son mot de passe
  - Contrainte pour l'inscription :
    - Le mot de passe doit être hasher et saler dans la base de données
    - Tous les champs doivent être remplis, sinon afficher un message
    - Le nom et l'e-mail ne doivent pas déjà être  utilisé par un autre compte, sinon afficher un message
- Si l'utilisateur est connecté
  -  une icône pour accéder à une liste personnelle de livre
  -  une icône pour gérer son compte (nom, email, mot de passe)
  -  La page déconnexion est alors affichée depuis la page d’accueil dans l’icône se connecter / se déconnecter
- Afficher une page de liste personnelle depuis la page d'accueil
  - Tous les livres que l'utilisateur aura ajoutés
  - Fonctionnalité de cette page :
    - L'utilisateur peut enlever un livre qui ne l'interesse plus
    - Il peut consulter des informations supplémentaires en cliquant sur un boutton
- Afficher une page pour voir les informations du livre (auteur, date, résumé...)
- Afficher une page de liste de tous les livres du site
  - Il peut consulter des informations supplémentaires en cliquant sur un boutton
- Afficher une page pour gérer son compte (modification, supression)
  
Les admins ont, en plus des droits au-dessus (sauf liste personnelle)
- D'ajouter, de modifier et de supprimer des livres
- D'ajouter, de modifier et de supprimer des genres
- D'ajouter, des comptes administrateurs

## Livrable

- Cahier des charges
- Git
- Projet 