<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Game;
use App\Models\Game_question;
use App\Models\User_question;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{    
    private $users;
    private $categories;
    private $answers;
    private $questions;

    /**
     * Initialise les données à seeder
     */
    public function __construct()
    {
        // liste des utilisateurs 
        $this->users = [
            [
                'name' => 'Hugo',
                'email' => 'hugodev@user.com',
                'password' => 'vedoguh'
            ],
            [
                'name' => 'David',
                'email' => 'davidweb@user.com',
                'password' => 'bewdivad'
            ],
            [
                'name' => 'Alicia',
                'email' => 'aliciawebdev@user.com',
                'password' => 'vedbewaicila'
            ],
        ];

        // Liste des catégories
        // ne pas oublier l'ajout du logo pour chaque catégorie ds une colonne supplémentaire
        $this->categories = [
            
            [
                'name' => 'HTML',
                'color' => 'Blue',
                'type' => 'Langage',
                // ne pas oublier l'ajout du logo pour chaque catégorie ds une colonne supplémentaire
            ],
            [
                'name' => 'CSS',
                'color' => 'Red',
                'type' => 'Langage',
            ],
            [
                'name' => 'JAVASCRIPT',
                'color' => 'Yellow',
                'type' => 'Langage',
            ],
            [
                'name' => 'PHP',
                'color' => 'Green',
                'type' => 'Langage',
            ],
            [
                'name' => 'SQL',
                'color' => 'Pink',
                'type' => 'Langage',
            ],
            [
                'name' => 'LARAVEL',
                'color' => 'Orange',
                'type' => 'Framework',
            ],
        ];

        // // liste des questions
        $this->questions = [
            // question HTML
            [  
                'question' => 'Qu\'est-ce que HTML5 ?',
                'category_id' => '1',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la différence entre une balise de bloc et une balise en ligne ?',
                'category_id' => '1',
                'level' => '2',
            ],
            [  
                'question' => 'Comment inclure une image dans une page HTML ?',
                'category_id' => '1',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle balise HTML est utilisée pour définir un paragraphe ?',
                'category_id' => '1',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle balise HTML est utilisée pour créer un lien hypertexte ?',
                'category_id' => '1',
                'level' => '3',
            ],

            // question CSS
            [  
                'question' => 'Qu\'est-ce que CSS3 ?',
                'category_id' => '2',
                'level' => '1',
            ],
            [  
                'question' => 'Comment lier un fichier CSS externe à un document HTML ?',
                'category_id' => '2',
                'level' => '2',
            ],
            [  
                'question' => 'Qu\'est-ce qu\'un sélecteur CSS ?',
                'category_id' => '2',
                'level' => '1',
            ],
            [  
                'question' => 'Comment centrer un élément horizontalement avec CSS ?',
                'category_id' => '2',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle propriété CSS est utilisée pour changer la couleur du texte ?',
                'category_id' => '2',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle propriété CSS est utilisée pour ajouter de l\'espace à l\'intérieur d\'un élément, entre son contenu et sa bordure ?',
                'category_id' => '2',
                'level' => '3',
            ],

             // question JS
            [  
                'question' => 'Qu\'est-ce que JavaScript ?',
                'category_id' => '3',
                'level' => '1',
            ],
            [  
                'question' => 'Comment incorporer JavaScript dans une page HTML ?',
                'category_id' => '3',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la différence entre les méthodes == et === ?',
                'category_id' => '3',
                'level' => '3',
            ],
            [  
                'question' => 'Quelle méthode JavaScript est utilisée pour convertir une chaîne de caractères en un nombre entier ?',
                'category_id' => '3',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle est la méthode utilisée pour ajouter un élément à la fin d\'un tableau en JavaScript ?',
                'category_id' => '3',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM ?',
                'category_id' => '3',
                'level' => '3',
            ],

            // question PHP
            [  
                'question' => 'Qu\'est-ce que PHP ?',
                'category_id' => '4',
                'level' => '2',
            ],
            [  
                'question' => 'Comment déclarer une variable en PHP ?',
                'category_id' => '4',
                'level' => '1',
            ],
            [  
                'question' => 'Quelles sont les règles pour nommer une variable en PHP ?',
                'category_id' => '4',
                'level' => '3',
            ],
            [  
                'question' => 'Comment convertir une chaîne JSON en tableau PHP ?',
                'category_id' => '4',
                'level' => '3',
            ],
            [  
                'question' => 'Quelle est la fonction utilisée pour échapper les caractères spéciaux en PHP ? ',
                'category_id' => '4',
                'level' => '1',
            ],
            [  
                'question' => 'Comment afficher le contenu d\'un fichier texte en PHP ? ',
                'category_id' => '4',
                'level' => '3',
            ],

            // question SQL
            [  
                'question' => 'Qu\'est-ce que SQL ?',
                'category_id' => '5',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle est la différence entre SQL et MySQL ?',
                'category_id' => '5',
                'level' => '1',
            ],
            [  
                'question' => 'Qu\'est-ce qu\'une jointure (join) en SQL ?',
                'category_id' => '5',
                'level' => '3',
            ],
            [  
                'question' => 'Qu\'est-ce qu\'une clé primaire en SQL ? ',
                'category_id' => '5',
                'level' => '2',
            ],
            [  
                'question' => 'Comment insérer une nouvelle ligne dans une table en SQL ?',
                'category_id' => '5',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la différence entre GROUP BY et ORDER BY en SQL ',
                'category_id' => '5',
                'level' => '3',
            ],

            // question LARAVEL
            [  
                'question' => 'Qu\'est-ce que Laravel ?',
                'category_id' => '6',
                'level' => '1',
            ],
            [  
                'question' => 'Qu\'est-ce que Composer ?',
                'category_id' => '6',
                'level' => '3',
            ],
            [  
                'question' => 'Qu\'est-ce que l\'ORM Eloquent ?',
                'category_id' => '6',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle commande Laravel est utilisée pour créer un nouveau modèle ?',
                'category_id' => '6',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle méthode est utilisée pour définir une relation "many-to-many" dans Eloquent ? ',
                'category_id' => '6',
                'level' => '3',
            ],
            [  
                'question' => 'Quelle est la commande pour exécuter toutes les migrations en Laravel ? ',
                'category_id' => '6',
                'level' => '2',
            ],
          
        ];

         // Liste des réponses
         $this->answers = [

            // réponses true HTML
            [  // Qu'est-ce que HTML5 ?
                'description' => 'HTML5 est la dernière version du langage de balisage utilisé pour créer des pages Web. Il introduit de nouvelles fonctionnalités et améliorations par rapport aux versions précédentes.',
                'is_correct' => 'true',
            ],
            [  // Quelle est la différence entre une balise de bloc et une balise en ligne ?
                'description' => 'Les balises de bloc (<div>, <p>, <h1>, etc.) sont utilisées pour structurer le contenu et occupent toute la largeur disponible, tandis que les balises en ligne (<span>, <a>, <strong>, etc.) ne prennent que l\'espace nécessaire et peuvent être incluses dans une ligne de texte.',
                'is_correct' => 'true',
            ],
            [  // Comment inclure une image dans une page HTML ?
                'description' => 'Utilisez la balise <img> avec l\'attribut src pour spécifier l\'emplacement de l\'image. Par exemple : <img src="image.jpg" alt="Description de l\'image">',
                'is_correct' => 'true',
            ],

            // réponses true CSS
            [  // Qu'est-ce que CSS3 ?
                'description' => 'CSS3 est la dernière version des feuilles de style en cascade (Cascading Style Sheets) utilisée pour décrire la présentation d\'un document HTML ou XML.',
                'is_correct' => 'true',
            ],
            [  // Comment lier un fichier CSS externe à un document HTML ?
                'description' => 'Utilisez la balise <link> dans la section <head> de votre document HTML. Exemple : <link rel="stylesheet" href="styles.css">',
                'is_correct' => 'true',
            ],
            [  // Qu'est-ce qu'un sélecteur CSS ?
                'description' => 'Un sélecteur CSS est un motif utilisé pour sélectionner les éléments HTML que vous souhaitez styliser. Il peut être basé sur des noms de balises, des classes, des identifiants, des attributs, ou des pseudoclasses.',
                'is_correct' => 'true',
            ],
            
             // réponses true JS
             [  // Qu'est-ce que JavaScript ?
                'description' => 'JavaScript est un langage de programmation de haut niveau principalement utilisé pour ajouter des fonctionnalités interactives aux sites web.',
                'is_correct' => 'true',
            ],
            [  // Comment incorporer JavaScript dans une page HTML ?
                'description' => 'Pour incorporer JavaScript dans une page HTML il faut utiliser la balise <script>.',
                'is_correct' => 'true',
            ],
            [  // Quelle est la différence entre les méthodes == et === ?
                'description' => '== vérifie l\'égalité avec conversion de type, tandis que === vérifie l\'égalité sans conversion de type (strictement égal).',
                'is_correct' => 'true',
            ],
             
             // réponses true PHP
             [  // Qu'est-ce que PHP ?
                'description' => 'PHP (Hypertext Preprocessor) est un langage de script côté serveur conçu pour le développement web.',
                'is_correct' => 'true',
            ],
            [  // Comment déclarer une variable en PHP ?
                'description' => 'En PHP, une variable est déclarée en utilisant le symbole "$" suivi du nom de la variable. Par exemple : $nom_variable = valeur;',
                'is_correct' => 'true',
            ],
            [  // Quelles sont les règles pour nommer une variable en PHP ?
                'description' => 'Une variable en PHP doit commencer par une lettre ou un underscore, et elle ne peut contenir que des lettres, des chiffres et des underscores.',
                'is_correct' => 'true',
            ],
             
             // réponses true SQL
             [  // Qu'est-ce que SQL ?
                'description' => 'SQL (Structured Query Language) est un langage de programmation standardisé utilisé pour gérer et manipuler des bases de données relationnelles.',
                'is_correct' => 'true',
            ],
            [  // Quelle est la différence entre SQL et MySQL ?
                'description' => 'SQL est un langage de requête standard, tandis que MySQL est un système de gestion de base de données relationnelle qui utilise SQL comme langage de requête.',
                'is_correct' => 'true',
            ],
            [  // Qu'est-ce qu'une jointure (join) en SQL ?
                'description' => 'Une jointure est une opération qui combine les lignes de deux tables en fonction d\'une condition spécifiée.',
                'is_correct' => 'true',
            ],
              
             // réponses true LARAVEL
             [  // Qu'est-ce que Laravel ?
                'description' => 'Laravel est un framework PHP open-source destiné au développement web, offrant des outils et des fonctionnalités pour faciliter et accélérer le processus de développement.',
                'is_correct' => 'true',
            ],
            [  // Qu'est-ce que Composer ?
                'description' => 'Composer est un gestionnaire de dépendances pour PHP, largement utilisé dans le développement avec Laravel pour installer et gérer les bibliothèques et les dépendances.',
                'is_correct' => 'true',
            ],
            [  // Qu'est-ce que l'ORM Eloquent ?
                'description' => 'Eloquent est le système de mapping objet-relationnel (ORM) de Laravel, qui permet aux développeurs de travailler avec des bases de données relationnelles en utilisant des objets PHP plutôt que du SQL brut.',
                'is_correct' => 'true',
            ],

            // réponses false HTML
            [  // Quelle balise HTML est utilisée pour définir un paragraphe ? mauvaise réponse 1
                'description' => '<pg>',
                'is_correct' => 'false',
            ],
            [  // Quelle balise HTML est utilisée pour définir un paragraphe ? mauvaise réponse 2
                'description' => '<para>',
                'is_correct' => 'false',
            ],
            [  // Quelle balise HTML est utilisée pour définir un paragraphe ? mauvaise réponse 3
                'description' => '<paragraph>',
                'is_correct' => 'false',
            ],
            [  // Comment insérer une image dans une page HTML ? mauvaise réponse 1
                'description' => '<image src="image.jpg" alt="Description">',
                'is_correct' => 'false',
            ],
            [  // Comment insérer une image dans une page HTML ? mauvaise réponse 2
                'description' => '<img href="image.jpg" alt="Description">',
                'is_correct' => 'false',
            ],
            [  // Comment insérer une image dans une page HTML ? mauvaise réponse 3
                'description' => '<picture src="image.jpg" alt="Description">',
                'is_correct' => 'false',
            ],
            [  // Quelle balise HTML est utilisée pour créer un lien hypertexte ? mauvaise réponse 1
                'description' => '<link url="page.html">Cliquez ici</link>',
                'is_correct' => 'false',
            ],
            [  // Quelle balise HTML est utilisée pour créer un lien hypertexte ? mauvaise réponse 2
                'description' => '<hyperlink href="page.html">Cliquez ici</hyperlink>',
                'is_correct' => 'false',
            ],
            [  // Quelle balise HTML est utilisée pour créer un lien hypertexte ? mauvaise réponse 3
                'description' => '<a src="page.html">Cliquez ici</a>',
                'is_correct' => 'false',
            ],

            // réponses false CSS
            [  // Comment centrer un élément horizontalement avec CSS ? mauvaise réponse 1
                'description' => 'align: center',
                'is_correct' => 'false',
            ],
            [  // Comment centrer un élément horizontalement avec CSS ? mauvaise réponse 2
                'description' => 'center: horizontal',
                'is_correct' => 'false',
            ],
            [  // Comment centrer un élément horizontalement avec CSS ? mauvaise réponse 3
                'description' => 'margin-left-right: auto',
                'is_correct' => 'false',
            ],
            [  // Quelle propriété CSS est utilisée pour changer la couleur du texte ? mauvaise réponse 1
                'description' => 'font-color',
                'is_correct' => 'false',
            ],
            [  // Quelle propriété CSS est utilisée pour changer la couleur du texte ? mauvaise réponse 2
                'description' => 'text-color',
                'is_correct' => 'false',
            ],
            [  // Quelle propriété CSS est utilisée pour changer la couleur du texte ? mauvaise réponse 3
                'description' => 'color-text',
                'is_correct' => 'false',
            ],
            [  // Quelle propriété CSS est utilisée pour ajouter de l'espace à l'intérieur d'un élément, entre son contenu et sa bordure ? mauvaise réponse 1
                'description' => 'spacing',
                'is_correct' => 'false',
            ],
            [  // Quelle propriété CSS est utilisée pour ajouter de l'espace à l'intérieur d'un élément, entre son contenu et sa bordure ? mauvaise réponse 2
                'description' => 'border-spacing',
                'is_correct' => 'false',
            ],
            [  // Quelle propriété CSS est utilisée pour ajouter de l'espace à l'intérieur d'un élément, entre son contenu et sa bordure ? mauvaise réponse 3
                'description' => 'inner-margin',
                'is_correct' => 'false',
            ],
            
             // réponses false JS
             [  // Quelle méthode JavaScript est utilisée pour convertir une chaîne de caractères en un nombre entier ? mauvaise réponse 1
                'description' => 'parseChar()',
                'is_correct' => 'false',
            ],
            [  // Quelle méthode JavaScript est utilisée pour convertir une chaîne de caractères en un nombre entier ? mauvaise réponse 2
                'description' => 'convertToInt()',
                'is_correct' => 'false',
            ],
            [  // Quelle méthode JavaScript est utilisée pour convertir une chaîne de caractères en un nombre entier ? mauvaise réponse 3
                'description' => 'toString()',
                'is_correct' => 'false',
            ],
            [  // Quelle est la méthode utilisée pour ajouter un élément à la fin d'un tableau en JavaScript ? mauvaise réponse 1
                'description' => 'add()',
                'is_correct' => 'false',
            ],
            [  // Quelle est la méthode utilisée pour ajouter un élément à la fin d'un tableau en JavaScript ? mauvaise réponse 2
                'description' => 'append()',
                'is_correct' => 'false',
            ],
            [  // Quelle est la méthode utilisée pour ajouter un élément à la fin d'un tableau en JavaScript ? mauvaise réponse 3
                'description' => 'insert()',
                'is_correct' => 'false',
            ],
            [  // Quelle est la méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM ? mauvaise réponse 1
                'description' => 'getElementByTag()',
                'is_correct' => 'false',
            ],
            [  // QQuelle est la méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM ? mauvaise réponse 2
                'description' => 'querySelector()',
                'is_correct' => 'false',
            ],
            [  // Quelle est la méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM ? mauvaise réponse 3
                'description' => 'getElementByIdentifier()',
                'is_correct' => 'false',
            ],

             // réponses false PHP
             [  // Comment convertir une chaîne JSON en tableau PHP ? mauvaise réponse 1
                'description' => ' Utilisez json_decode($chaine_json, true) pour convertir une chaîne JSON en tableau PHP',
                'is_correct' => 'false',
            ],
            [  // Comment convertir une chaîne JSON en tableau PHP ? mauvaise réponse 2
                'description' => 'Utilisez json_encode($chaine_json) pour convertir une chaîne JSON en tableau PHP.',
                'is_correct' => 'false',
            ],
            [  // Comment convertir une chaîne JSON en tableau PHP ? mauvaise réponse 3
                'description' => 'Utilisez json_parse($chaine_json) pour convertir une chaîne JSON en tableau PHP.',
                'is_correct' => 'false',
            ],
            [  //  Quelle est la fonction utilisée pour échapper les caractères spéciaux en PHP ? mauvaise réponse 1
                'description' => 'escape_special_chars()',
                'is_correct' => 'false',
            ],
            [  //  Quelle est la fonction utilisée pour échapper les caractères spéciaux en PHP ? mauvaise réponse 2
                'description' => 'htmlspecialchars_decode()',
                'is_correct' => 'false',
            ],
            [  //  Quelle est la fonction utilisée pour échapper les caractères spéciaux en PHP ? mauvaise réponse 3
                'description' => 'sanitize_string()',
                'is_correct' => 'false',
            ],
            [  //  Comment afficher le contenu d'un fichier texte en PHP ? mauvaise réponse 1
                'description' => ' Utilisez la fonction readfile() pour afficher le contenu d\'un fichier texte en PHP.',
                'is_correct' => 'false',
            ],
            [  //  Comment afficher le contenu d'un fichier texte en PHP ? mauvaise réponse 2
                'description' => 'Utilisez file_get_contents() pour afficher le contenu d\'un fichier texte en PHP.',
                'is_correct' => 'false',
            ],
            [  //  Comment afficher le contenu d'un fichier texte en PHP ? mauvaise réponse 3
                'description' => 'Utilisez fwrite() pour afficher le contenu d\'un fichier texte en PHP.',
                'is_correct' => 'false',
            ],

            // réponses false SQL
            [  // Qu'est-ce qu'une clé primaire en SQL ? mauvaise réponse 1
                'description' => 'Une clé primaire peut contenir des valeurs NULL.',
                'is_correct' => 'false',
            ],
            [  // Qu'est-ce qu'une clé primaire en SQL ? mauvaise réponse 2
                'description' => 'Une clé primaire est une colonne qui peut être partagée entre plusieurs tables.',
                'is_correct' => 'false',
            ],
            [  // Qu'est-ce qu'une clé primaire en SQL ? mauvaise réponse 3
                'description' => 'Une clé primaire n\'est pas nécessaire pour identifier de manière unique chaque enregistrement dans une table.',
                'is_correct' => 'false',
            ],
            [  // Comment insérer une nouvelle ligne dans une table en SQL ? mauvaise réponse 1
                'description' => 'Utilisez la commande ADD ROW INTO table_name.',
                'is_correct' => 'false',
            ],
            [  // Comment insérer une nouvelle ligne dans une table en SQL ? mauvaise réponse 2
                'description' => 'Utilisez la commande INSERT table_name VALUES (new_row_data).',
                'is_correct' => 'false',
            ],
            [  // Comment insérer une nouvelle ligne dans une table en SQL ? mauvaise réponse 3
                'description' => 'Utilisez la commande UPDATE table_name SET new_row_data.',
                'is_correct' => 'false',
            ],
            [  // Quelle est la différence entre GROUP BY et ORDER BY en SQL ? mauvaise réponse 1
                'description' => 'GROUP BY est utilisé pour trier les résultats d\'une requête, tandis que ORDER BY est utilisé pour grouper les résultats.',
                'is_correct' => 'false',
            ],
            [  // Quelle est la différence entre GROUP BY et ORDER BY en SQL ? mauvaise réponse 2
                'description' => 'ORDER BY est utilisé pour appliquer une condition de filtrage sur un groupe de résultats, tandis que GROUP BY est utilisé pour trier les résultats.',
                'is_correct' => 'false',
            ],
            [  //Quelle est la différence entre GROUP BY et ORDER BY en SQL ? mauvaise réponse 3
                'description' => ' GROUP BY et ORDER BY sont interchangeables et peuvent être utilisés de la même manière dans une requête SQL.',
                'is_correct' => 'false',
            ],

            // réponses false LARAVEL
            [  // Quelle commande Laravel est utilisée pour créer un nouveau modèle ? mauvaise réponse 1
                'description' => 'php artisan make:model User',
                'is_correct' => 'false',
            ],
            [  // Quelle commande Laravel est utilisée pour créer un nouveau modèle ? mauvaise réponse 2
                'description' => 'php artisan generate:model User',
                'is_correct' => 'false',
            ],
            [  // Quelle commande Laravel est utilisée pour créer un nouveau modèle ? mauvaise réponse 3
                'description' => 'php artisan create:model User',
                'is_correct' => 'false',
            ],
            [  // Quelle méthode est utilisée pour définir une relation "many-to-many" dans Eloquent ? mauvaise réponse 1
                'description' => 'hasOneThrough()',
                'is_correct' => 'false',
            ],
            [  // Quelle méthode est utilisée pour définir une relation "many-to-many" dans Eloquent ? mauvaise réponse 2
                'description' => 'belongsToMany()',
                'is_correct' => 'false',
            ],
            [  // Quelle méthode est utilisée pour définir une relation "many-to-many" dans Eloquent ? mauvaise réponse 3
                'description' => 'hasManyThrough()',
                'is_correct' => 'false',
            ],
            [  //  Quelle est la commande pour exécuter toutes les migrations en Laravel ? mauvaise réponse 1
                'description' => 'php artisan migrate:all', 
                'is_correct' => 'false',
            ],
            [  //  Quelle est la commande pour exécuter toutes les migrations en Laravel ? mauvaise réponse 2
                'description' => 'php artisan migrate',
                'is_correct' => 'false',
            ],
            [  //  Quelle est la commande pour exécuter toutes les migrations en Laravel ? mauvaise réponse 3
                'description' => 'php artisan migrate:run',
                'is_correct' => 'false',
            ],
         ];

    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed la table 'users'
        $this->processUsers($this->users);

        // Seed la table 'categories'
        $this->processCategories($this->categories);

        // // Seed la table 'answers'
        // $this->processAnswers($this->answers);

        // Seed la table 'questions'
        $this->processQuestions($this->questions);

        // // Seed la table 'games'
        // $this->processGames($this->games);
    }

    private function processUsers($users)
    {
        // Insère les données dans la table 'users'
        DB::table('users')->insert($users);
    }

    private function processCategories($categories)
    {
        DB::table('categories')->insert($categories);
    }

    private function processQuestions($questions)
    {
        foreach ($questions as $question) {
            // dump($question);
            // Définit les données de la question à destination de la table 'questions'
            $data = 
            [
                'question'=> $question['question'],
                'level'=> $question['level'],
                'category_id' => $question['category_id'],
                'user_id' => '1' // celui qui créer les question 1er user est toujours l'admin
            ];

            // Insère les données dans la table 'questions'
            $question_id = DB::table('questions')->insertGetId($data);

            // Seed la catégorie de la question
            // $this->processQuestionCategory($question_id, $question['type']);

            // Seed la réponse correspondande à la question
            // $this->processAnswer($question_id, $question['question']);
        }
    }

    // private function processQuestionCategory($question_id, $category_name)
    // {
    //     $data = [
    //         'question_id' => $question,
    //         'name' => $category['name'],
    //         'color' => $category['color'],
    //         'type' => $category['type'],
    //         // ne pas oublier la colonne logo
    //     ];

    //     // Inssère les données dans la table 'categoriess'
    //     DB::table('categories')->insert($data);
    // }

    private function processAnswers($answers)
    {
        foreach ($answers as $answer) {
         // Définit les données de la réponse à destination de la table 'answers'
         $data = [
            'description'=> $answer['description'],
            'is_correct'=> $answer['is_correct'],
        ];
        // Insère les données dans la table 'answers'
        $answer_id = DB::table('answers')->insertGetId($data);
        }
    }

    private function processGames($games)
    {
        // Insère les données dans la table 'games'
       
    }

}

