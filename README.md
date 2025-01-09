# README - Dev.to Content Management System
Objectif du projet
Le projet Dev.to vise à créer un système complet de gestion de contenu (CMS) qui permettra aux développeurs et passionnés de technologie de partager des articles, de collaborer efficacement et d'explorer du contenu pertinent sur une plateforme interactive. Ce système comprendra à la fois une interface pour les utilisateurs (front office) et un tableau de bord pour les administrateurs (back office).

# Technologies utilisées
Langage : PHP 8 (Programmation Orientée Objet)
Base de données : PDO pour l'interaction avec la base de données.
Framework : A définir selon les besoins du projet (par exemple, Symfony, Laravel ou Vanilla PHP).
Frontend : HTML, CSS, JavaScript (et potentiellement un framework comme Vue.js ou React pour la partie dynamique).
Structure du projet
Le projet est divisé en deux parties principales :

Back Office (Administrateurs) : Gère les utilisateurs, catégories, tags, articles et visualisation des statistiques.
Front Office (Utilisateurs) : Permet aux utilisateurs de s'inscrire, se connecter, lire des articles, écrire et gérer leurs propres articles.
Fonctionnalités clés
Back Office (Administrateurs)
Gestion des Catégories : Créer, modifier, supprimer des catégories, associer des articles à des catégories, visualiser des statistiques sous forme de graphiques.
Gestion des Tags : Créer, modifier, supprimer des tags, associer des tags aux articles, afficher des statistiques sur les tags.
Gestion des Utilisateurs : Gérer les profils, attribuer des permissions, suspendre ou supprimer des utilisateurs.
Gestion des Articles : Accepter, refuser ou archiver des articles, consulter les articles les plus lus, etc.
Tableau de Bord : Afficher les utilisateurs, articles, catégories, tags, et les 3 meilleurs auteurs avec des graphiques interactifs.
Front Office (Utilisateurs)
Inscription et Connexion : Création de compte, connexion sécurisée, redirection selon le rôle (admin ou utilisateur).
Navigation et Recherche : Barre de recherche pour trouver des articles, catégories et tags.
Affichage des Contenus : Affichage des derniers articles et catégories, redirection vers des pages détaillées.
Espace Auteur : Création, modification, suppression d'articles, gestion des articles publiés.
Planification du projet
Le projet sera divisé en 2 sprints :

Sprint 1 : Back Office (Administrateurs)
Ticket 1 : Gestion des Catégories
Description : Permet aux administrateurs de créer, modifier et supprimer des catégories.
User Story : En tant qu'administrateur, je souhaite gérer les catégories pour organiser les articles.
Subtasks :
Créer une page de gestion des catégories.
Implémenter la création et modification de catégories.
Implémenter la suppression de catégories.
Associer des articles aux catégories.
Ticket 2 : Gestion des Tags
Description : Permet aux administrateurs de gérer les tags, associer des tags aux articles, et visualiser les statistiques des tags.
User Story : En tant qu'administrateur, je souhaite gérer les tags pour organiser les articles et améliorer la recherche.
Subtasks :
Créer une page de gestion des tags.
Ajouter la fonctionnalité de création et modification de tags.
Implémenter la suppression de tags.
Associer des tags aux articles.
Ticket 3 : Gestion des Utilisateurs
Description : Permet aux administrateurs de gérer les profils utilisateurs, attribuer des rôles et suspendre/supprimer des utilisateurs.
User Story : En tant qu'administrateur, je souhaite gérer les utilisateurs, attribuer des rôles et suspendre des utilisateurs si nécessaire.
Subtasks :
Créer une page de gestion des utilisateurs.
Implémenter l'attribution de rôles d'auteurs.
Implémenter la suspension et suppression des utilisateurs.
Créer des tests pour la gestion des utilisateurs.
Ticket 4 : Gestion des Articles
Description : Permet à l’administrateur de gérer les articles : acceptation, rejet, archivage.
User Story : En tant qu'administrateur, je souhaite accepter ou rejeter les articles soumis et archiver ceux inappropriés.
Subtasks :
Créer une page de gestion des articles.
Implémenter la fonctionnalité d'acceptation et de rejet des articles.
Ajouter la fonctionnalité d'archivage des articles.
Ajouter des tests pour la gestion des articles.
Ticket 5 : Tableau de Bord et Statistiques
Description : Créer le tableau de bord avec des graphiques interactifs et afficher les statistiques des catégories, des tags et des meilleurs auteurs.
User Story : En tant qu'administrateur, je souhaite un tableau de bord avec des graphiques interactifs pour visualiser les données importantes.
Subtasks :
Créer la structure du tableau de bord.
Implémenter les graphiques des catégories et tags.
Afficher les 3 meilleurs auteurs.
Tester les statistiques et les graphiques.
Sprint 2 : Front Office (Utilisateurs)
Ticket 1 : Inscription et Connexion
Description : Créer les pages d'inscription et de connexion, avec une gestion des rôles pour la redirection après connexion.
User Story : En tant qu'utilisateur, je souhaite m'inscrire, me connecter et être redirigé en fonction de mon rôle (utilisateur ou administrateur).
Subtasks :
Créer la page d'inscription.
Ajouter la validation des informations saisies.
Créer la page de connexion.
Implémenter la redirection après connexion selon le rôle.
Ticket 2 : Navigation et Recherche
Description : Implémenter la barre de recherche pour trouver des articles, des catégories, et des tags.
User Story : En tant qu'utilisateur, je souhaite pouvoir rechercher des articles, catégories, et tags pour trouver du contenu pertinent.
Subtasks :
Créer la barre de recherche.
Implémenter la recherche des articles.
Ajouter la recherche par catégories et tags.
Ticket 3 : Affichage des Contenus
Description : Afficher les derniers articles et catégories sur la page d'accueil.
User Story : En tant qu'utilisateur, je veux voir les derniers articles et catégories sur la page d'accueil.
Subtasks :
Créer la section "Derniers articles".
Créer la section "Dernières catégories".
Lier les articles et les catégories à leurs pages de détail.
Ticket 4 : Espace Auteur
Description : Créer un espace pour les auteurs permettant la gestion de leurs articles.
User Story : En tant qu'auteur, je souhaite créer, modifier et supprimer mes articles dans mon espace personnel.
Subtasks :
Créer l'interface de l'espace auteur.
Ajouter la fonctionnalité de création d’articles.
Ajouter la possibilité de modifier et supprimer des articles.
Tester l'interface de l'espace auteur.
Installation
Cloner le dépôt :
bash
Copier le code
git clone <URL-du-dépôt>
Configurer l'environnement :
Assurez-vous d’avoir PHP 8 et Composer installés sur votre machine.
Configurez les informations de connexion à la base de données dans le fichier .env ou dans le fichier de configuration spécifique à la base de données.
Installer les dépendances :
Copier le code
composer install
Copier le code
Lancer le serveur local :
Copier le code
php -S localhost:8000
Contribution
Forkez le projet
Commitez vos changements (git commit -am 'Ajout de [fonctionnalité/bugfix]').
Poussez la branche (git push origin feature/nom-fonctionnalité).
Soumettez une Pull Request.