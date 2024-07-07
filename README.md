![](diveindesign-banner.png)

<h1 align="center">DiveIn Design - Forum</h1>

<br/>

<h3>📃 Description</h3>
<br/>
<strong>DiveIn Design</strong> est un projet de <strong>forum</strong> qui permet aux utilisateurs de publier des topics et des posts.
<br/> 
L'administrateur peut créer des catégories et bannir des utilisateurs, les empêchant de créer des posts et de répondre aux posts des autres.
<br/>
<br/>
Le projet contient notamment :
<br/>

<h4>👤 Un espace profil utilisateur permettant de voir et de gérer les publications</h4>

<img src="/user-profile0.png" width=700 />

<br/>

<h4>👨‍💼 Un espace profil administrateur permettant de gérer les utilisateurs et les catégories</h4>

<img src="/admin-profile0.png" width=700 />

<br/>
<br/>

<h3>⚙️ Technologies utilisées</h3>

<br/>

🟣<strong> PHP :</strong> Langage de programmation utilisé pour le développement du backend.<br/><br/>
🟣<strong> Symfony :</strong> Framework PHP utilisé pour structurer l'application selon le design pattern MVP.<br/><br/>
🟣<strong> MySQL :</strong> Système de gestion de base de données relationnelle (SGBDR) pour stocker et gérer les données.<br/><br/>
🟣<strong> HeidiSQL :</strong> Outil d'administration de base de données utilisé pour gérer et administrer MySQL.<br/><br/>
🟣<strong> Laragon :</strong> Environnement de développement utilisé pour héberger l'application en local.<br/><br/>
🟣<strong> Looping :</strong> Outil de modélisation conceptuelle de données utilisé pour créer le Modèle Conceptuel de Données (MCD) et le Modèle Logique de Données (MLD).<br/><br/>

<h3>Détails Techniques</h3>

<br/>

Pour ce projet, un Modèle Conceptuel de Données (MCD) et un Modèle Logique de Données (MLD) ont été créés afin de définir la structure de la base de données et les relations entre les entités. L’outil Looping a été utilisé pour cette modélisation.
<br/>

L'interface utilisateur contenant des champs d'entrée, des mesures de sécurité contre les attaques XSS ont été implémentées en utilisant les fonctions PHP d'assainissement et de validation des données, telles que filter_input() avec FILTER_SANITIZE_FULL_SPECIAL_CHARS. 
<br/>

Une regex a été mise en place avec FILTER_VALIDATE_REGEXP pour s'assurer que les mots de passe respectent les recommandations de la CNIL. 
<br/>
 
Pour la gestion des données, des requêtes préparées ont été utilisées pour sécuriser les interactions avec la base de données, minimisant ainsi les risques d'injection SQL. Ces requêtes ont été définies dans la couche Modèle de l'application, structurée selon le design pattern MVP (Modèle-Vue-Présentateur), avec un routeur frontal (index) dirigeant les requêtes vers les contrôleurs appropriés.
<br/>

Ces contrôleurs permettent de gérer la logique de récupération des données et les interactions avec la base de données MySQL, paramétrée avec PDO (PHP Data Objects) : création d'une instance de PDO, qui est une couche d‘accès, pour se connecter à la base de données.

