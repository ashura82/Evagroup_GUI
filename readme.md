# Interface de gestion du reverse proxy

Ce projet permet de gérer le reverse proxy via une interface web. Il a été réalisé sous Laravel 5.6 et se connecte à une API distante sur le reverse proxy.

# Lancement script installation automatique
Pour lancer l'automatisation de l'installation, un script d'installation `install.sh` est diponible à la racine du projet.
Ce script installe toutes les dépendances necessaires, clone ce projet et paramètre automatiquement apache.

Prérequis :

* être sous le compte root de la machine
* connection à internet fonctionnelle
* le script ne fonctionne que sur Debian. Le script a été testé sur Debian9

# Fonctionnalités

## Page d'accueil

Vous pourrez sur cette page retrouver les informations sur le système comme :
* L'utilisation du processeur en temps réel
* La mémoire RAM utilisé et la mémoire RAM totale 
* L'espace disque utilisé et l'espace disque total
* L'utilisation de la bande passante (montante et descendante).

Vous pourrez également consulter les fichiers de logs du reverse proxy :
* daemon.log
* lfd.log
* auth.log
* csf.allow
* csf.deny

## Page websites
Cette page permet de consulter les fichiers de configuration de Nging. Tous les fichiers sont consultables et éditables.
La page de consultation permet d'activer ou de désactiver le vhost.
Enfin cette page permet également de créer un nouveau Vhost.

## Page firewall

Cette page permet de gérer le pare-feu du reverse proxy. Le firewall pourra être activé ou désactivé et il est possible de redémarrer le cluster.

Sur le pare-feu vous pourrez:
* Ajouter une adresse IP ou un sous réseau CIDR dans la liste blanche du cluster.
* Supprimer une adresse IP ou un sous réseau CIDR de la liste blanche du cluster.
* Ajouter une adresse IP ou un sous réseau CIDR dans la liste noire du cluster.
* Supprimer une adresse IP ou un sous réseau CIDR de la liste noire du cluster.

Il est également possible de:
* Afficher le contenu de toutes les tables du pare-feu.
* Tester l'état des membres du cluster.
* rechercher une IP dans les tables du pare-feu.
