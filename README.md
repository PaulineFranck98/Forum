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


<br/></br>

<h3 align="center">⚙️ Technologies utilisées</h3>

<p align="center">
  <a href="https://skillicons.dev">
    <img src="https://skillicons.dev/icons?i=html,css,php,mysql,vscode,github,git,figma" />
  </a
</p>
<br/>
<br/>
<br/>

🟣<strong> PHP :</strong> Langage de programmation utilisé pour le développement du backend.<br/><br/>
🟣<strong> MySQL :</strong> Système de gestion de base de données relationnelle **(SGBDR)** pour stocker et gérer les données.<br/><br/>
🟣<strong> HeidiSQL :</strong> Outil d'administration de base de données utilisé pour gérer et administrer **MySQL**.<br/><br/>
🟣<strong> Laragon :</strong> Environnement de développement utilisé pour héberger l'application en local.<br/><br/>
🟣<strong> Looping :</strong> Outil de modélisation conceptuelle de données utilisé pour créer  : <br/>
                              - le **Modèle Conceptuel de Données** (MCD)<br/>
                              - le **Modèle Logique de Données** (MLD).<br/><br/>

<br/>


<div align="center">
  <h4>👤 Espace profil utilisateur permettant de voir et de gérer les publications</h4>
  
  <img src="/user-profile0.png" width=700 />
  
  <br/>
  
  <h4>👨‍💼 Espace profil administrateur permettant de gérer les utilisateurs et les catégories</h4>
  
  <img src="/admin-profile0.png" width=700 />
</div>

<br/>

<h3 align="center">🛠️ Détails Techniques</h3>

<h4>☑️ MCD - MLD</h4>
Pour ce projet, un Modèle Conceptuel de Données (MCD) et un Modèle Logique de Données (MLD) ont été créés afin de définir la structure de la base de données et les relations entre les entités. L’outil Looping a été utilisé pour cette modélisation.

<br/><br/>

<h4>☑️ Faille XSS</h4>
L'interface utilisateur contenant des champs d'entrée, des mesures de sécurité contre les attaques XSS ont été implémentées en utilisant les fonctions PHP d'assainissement et de validation des données, telles que filter_input() avec FILTER_SANITIZE_FULL_SPECIAL_CHARS. 
<br/><br/>

```PHP
// retrieves username from the POST request, sanitize the input
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
```
<br/>

<h4>☑️ Regex</h4>
Une regex a été mise en place avec FILTER_VALIDATE_REGEXP pour s'assurer que les mots de passe respectent les recommandations de la CNIL. <br/><br/>

```PHP
// retrieves user's password created from the POST request, sanitizes the input
$createPassword = filter_input(INPUT_POST, 'createPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// retrieves user's password repeated from the POST request
// FILTER_VALIDATE_REGEXP : validates password against a regular expression to enforce password strenght requirement
$repeatPassword = filter_input(
    INPUT_POST,
    'repeatPassword',
    FILTER_VALIDATE_REGEXP,
    ["options" => ["regexp" => "/[A-Za-z0-9].{8,32}/"]] //required : uppercase, lowercase, digit, min 8, max 32 characters
);

```
<br/>
 
<h4>☑️ Injection SQL</h4>
Pour la gestion des données, des <strong>requêtes préparées</strong> ont été utilisées pour sécuriser les interactions avec la base de données, minimisant ainsi les risques d'injection SQL.<br/><br/>
Ces requêtes ont été définies dans la <strong>couche Modèle</strong> de l'application, structurée selon le <strong>design pattern MVP</strong> (Modèle-Vue-Présentateur), avec un <strong>routeur frontal (index) </strong> dirigeant les requêtes vers les contrôleurs appropriés.<br/>
Exemple ici dans 'PostManager.php' pour récupérer les posts correspondant à la recherche de l'utilisateur : <br/><br/>
 
 ```PHP
// method to retrieve posts when searched in search bar
public function searchPosts($search){

    // creation of variable $sql to store the SQL query
    $sql = "SELECT * FROM ".$this->tableName ." p
            WHERE p.textcontent
            LIKE :search";
    // prepare data
    $data = [
        'search' => '%' . $search . '%'
    ];
   
    return $this->getMultipleResults(
        // Use resolution operator(`::`)to access static properties and methods of DAO class
        DAO::select($sql, $data, true), 
        $this->className
    );
}
```
<br/>
Puis dans le contrôleur : 
<br/><br/>

 ```PHP
//use model layer to retrieve information from the database
$posts = $postManager->searchPosts($search);
```


<br/>

<h4>☑️ PDO - PHP Data Object</h4>
Les contrôleurs permettent de gérer la logique de récupération des données et les interactions avec la base de données MySQL, paramétrée avec PDO (PHP Data Objects) : création d'une instance de PDO, qui est une couche d‘accès, pour se connecter à la base de données.<br/><br/>

 ```PHP
public static function connect(){
            
    self::$bdd = new \PDO(
        self::$host.';dbname='.self::$dbname,
        self::$dbuser,
        self::$dbpass,
        array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        )   
    );
}
```
<br/><br/>
