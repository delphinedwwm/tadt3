<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Game;
use App\Models\GameQuestion;
use App\Models\UserQuestion;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{    
    private $users;
    private $categories;
    private $questions;
    private $answers;
    private $games;
    private $user_question;
    private $game_question;
    /**
     * Initialise les données à seeder
     */
    public function __construct()
    {
    // liste des utilisateurs 
        $this->users = [
            [
                'name' => 'Célia',
                'email' => 'celiadev@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Nathan',
                'email' => 'nathanweb@user.com',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Jérémie',
                'email' => 'jeremiedev@user.com',
                'password' => bcrypt('123456')
            ],
        ];

    // Liste des catégories
        $this->categories = [
            [
                'name' => 'HTML',
                'type' => 'Langage',
                'logo' => 'logos/html_32.png',
            ],
            [
                'name' => 'CSS',
                'type' => 'Langage',
                'logo' => 'logos/css_32.png',
            ],
            [
                'name' => 'JAVASCRIPT',
                'type' => 'Langage',
                'logo' => 'logos/js_32.png',
            ],
            [
                'name' => 'PHP',
                'type' => 'Langage',
                'logo' => 'logos/php_32.png',
            ],
            [
                'name' => 'SQL',
                'type' => 'Langage',
                'logo' => 'logos/sql_32.png',
            ],
            [
                'name' => 'LARAVEL',
                'type' => 'Framework',
                'logo' => 'logos/laravel_32.png',
            ],
 
        ];

    // liste des questions
        $this->questions = [
            // question HTML
            [  
                'question' => 'Qu\'est-ce que HTML5 ?',
                'category_id' => '1',
                'category_name' => 'HTML',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la différence entre une balise de bloc et une balise en ligne ?',
                'category_id' => '1',
                'category_name' => 'HTML',
                'level' => '2',
            ],
            [  
                'question' => 'Comment inclure une image dans une page HTML ?',
                'category_id' => '1',
                'category_name' => 'HTML',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle balise HTML est utilisée pour définir un paragraphe ?',
                'category_id' => '1',
                'category_name' => 'HTML',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle balise HTML est utilisée pour créer un lien hypertexte ?',
                'category_id' => '1',
                'category_name' => 'HTML',
                'level' => '1',  
            ],

            // question CSS
            [  
                'question' => 'Qu\'est-ce que CSS3 ?',
                'category_id' => '2',
                'category_name' => 'CSS',
                'level' => '1',
            ],
            [  
                'question' => 'Comment lier un fichier CSS externe à un document HTML ?',
                'category_id' => '2',
                'category_name' => 'CSS',
                'level' => '2',
            ],
            [  
                'question' => 'Qu\'est-ce qu\'un sélecteur CSS ?',
                'category_id' => '2',
                'category_name' => 'CSS',
                'level' => '1',
            ],
            [  
                'question' => 'Comment centrer un élément horizontalement avec CSS ?',
                'category_id' => '2',
                'category_name' => 'CSS',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle propriété CSS est utilisée pour changer la couleur du texte ?',
                'category_id' => '2',
                'category_name' => 'CSS',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle propriété CSS est utilisée pour ajouter de l\'espace à l\'intérieur d\'un élément, entre son contenu et sa bordure ?',
                'category_id' => '2',
                'category_name' => 'CSS',
                'level' => '3',
            ],

            // question JS
            [  
                'question' => 'Qu\'est-ce que JavaScript ?',
                'category_id' => '3',
                'category_name' => 'JAVASCRIPT',
                'level' => '1',
            ],
            [  
                'question' => 'Comment incorporer JavaScript dans une page HTML ?',
                'category_id' => '3',
                'category_name' => 'JAVASCRIPT',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la différence entre les méthodes == et === ?',
                'category_id' => '3',
                'category_name' => 'JAVASCRIPT',
                'level' => '3',
            ],
            [  
                'question' => 'Quelle méthode JavaScript est utilisée pour convertir une chaîne de caractères en un nombre entier ?',
                'category_id' => '3',
                'category_name' => 'JAVASCRIPT',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle est la méthode utilisée pour ajouter un élément à la fin d\'un tableau en JavaScript ?',
                'category_id' => '3',
                'category_name' => 'JAVASCRIPT',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM ?',
                'category_id' => '3',
                'category_name' => 'JAVASCRIPT',
                'level' => '2',  // Corrigé de niveau 3 à niveau 2
            ],

            // question PHP
            [  
                'question' => 'Qu\'est-ce que PHP ?',
                'category_id' => '4',
                'category_name' => 'PHP',
                'level' => '2',
            ],
            [  
                'question' => 'Comment déclarer une variable en PHP ?',
                'category_id' => '4',
                'category_name' => 'PHP',
                'level' => '1',
            ],
            [  
                'question' => 'Quelles sont les règles pour nommer une variable en PHP ?',
                'category_id' => '4',
                'category_name' => 'PHP',
                'level' => '3',
            ],
            [  
                'question' => 'Comment convertir une chaîne JSON en tableau PHP ?',
                'category_id' => '4',
                'category_name' => 'PHP',
                'level' => '3',
            ],
            [  
                'question' => 'Quelle est la fonction utilisée pour échapper les caractères spéciaux en PHP ?',
                'category_id' => '4',
                'category_name' => 'PHP',
                'level' => '1',
            ],
            [  
                'question' => 'Comment afficher le contenu d\'un fichier texte en PHP ?',
                'category_id' => '4',
                'category_name' => 'PHP',
                'level' => '3',
            ],

            // question SQL
            [  
                'question' => 'Qu\'est-ce que SQL ?',
                'category_id' => '5',
                'category_name' => 'SQL',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle est la différence entre SQL et MySQL ?',
                'category_id' => '5',
                'category_name' => 'SQL',
                'level' => '1',
            ],
            [  
                'question' => 'Qu\'est-ce qu\'une jointure (join) en SQL ?',
                'category_id' => '5',
                'category_name' => 'SQL',
                'level' => '3',
            ],
            [  
                'question' => 'Qu\'est-ce qu\'une clé primaire en SQL ?',
                'category_id' => '5',
                'category_name' => 'SQL',
                'level' => '2',
            ],
            [  
                'question' => 'Comment insérer une nouvelle ligne dans une table en SQL ?',
                'category_id' => '5',
                'category_name' => 'SQL',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle est la différence entre GROUP BY et ORDER BY en SQL ?',
                'category_id' => '5',
                'category_name' => 'SQL',
                'level' => '3',
            ],

            // question LARAVEL
            [  
                'question' => 'Qu\'est-ce que Laravel ?',
                'category_id' => '6',
                'category_name' => 'LARAVEL',
                'level' => '1',
            ],
            [  
                'question' => 'Qu\'est-ce que Composer ?',
                'category_id' => '6',
                'category_name' => 'LARAVEL',
                'level' => '3',
            ],
            [  
                'question' => 'Qu\'est-ce que l\'ORM Eloquent ?',
                'category_id' => '6',
                'category_name' => 'LARAVEL',
                'level' => '2',
            ],
            [  
                'question' => 'Quelle commande Laravel est utilisée pour créer un nouveau modèle ?',
                'category_id' => '6',
                'category_name' => 'LARAVEL',
                'level' => '1',
            ],
            [  
                'question' => 'Quelle méthode est utilisée pour définir une relation "many-to-many" dans Eloquent ?',
                'category_id' => '6',
                'category_name' => 'LARAVEL',
                'level' => '3',
            ],
            [  
                'question' => 'Quelle est la commande pour exécuter toutes les migrations en Laravel ?',
                'category_id' => '6',
                'category_name' => 'LARAVEL',
                'level' => '2',
            ],
        ];
    
    // Listes des réponses nouvelles organisation
        $this->answers = [
        // Réponses HTML5
            [
                'question_id' => '1',
                'description' => 'HTML5 est la dernière version du langage de balisage utilisé pour créer des pages Web. Il introduit de nouvelles fonctionnalités et améliorations par rapport aux versions précédentes.',
                'is_correct' => true,
            ],
            [
                'question_id' => '1',
                'description' => 'HTML5 est un langage de programmation utilisé pour créer des applications mobiles.',
                'is_correct' => false,
            ],
            [
                'question_id' => '1',
                'description' => 'HTML5 est un framework JavaScript pour le développement front-end.',
                'is_correct' => false,
            ],
            [
                'question_id' => '1',
                'description' => 'HTML5 est un système de gestion de base de données.',
                'is_correct' => false,
            ],

            // Réponses pour la question différence entre une balise de bloc et une balise en ligne
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise qui crée un bloc distinct sur la page, occupant toute la largeur disponible. Une balise en ligne, quant à elle, est une balise qui n\'occupe que l\'espace nécessaire autour de son contenu.',
                'is_correct' => true,
            ],
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise qui n\'a pas de contenu visible sur la page, contrairement à une balise en ligne qui affiche du contenu.',
                'is_correct' => false,
            ],
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise utilisée pour styliser du texte, tandis qu\'une balise en ligne est utilisée pour structurer une page.',
                'is_correct' => false,
            ],
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise utilisée pour ajouter des images, tandis qu\'une balise en ligne est utilisée pour du texte uniquement.',
                'is_correct' => false,
            ],

            // Réponses pour la question inclure une image dans une page HTML
            [
                'question_id' => '3',
                'description' => 'Utilisez la balise <img> avec l\'attribut src pour spécifier l\'emplacement de l\'image.',
                'is_correct' => true,
            ],
            [
                'question_id' => '3',
                'description' => 'Utilisez la balise <image> avec l\'attribut source pour spécifier l\'emplacement de l\'image.',
                'is_correct' => false,
            ],
            [
                'question_id' => '3',
                'description' => 'Utilisez la balise <img> avec l\'attribut link pour spécifier l\'emplacement de l\'image.',
                'is_correct' => false,
            ],
            [
                'question_id' => '3',
                'description' => 'Utilisez la balise <img> avec l\'attribut href pour spécifier l\'emplacement de l\'image.',
                'is_correct' => false,
            ],

            // Réponses pour la question balise HTML pour définir un paragraphe
            [
                'question_id' => '4',
                'description' => 'La balise <p> ',
                'is_correct' => true,
            ],
            [
                'question_id' => '4',
                'description' => 'La balise <paragraph> ',
                'is_correct' => false,
            ],
            [
                'question_id' => '4',
                'description' => 'La balise <para>',
                'is_correct' => false,
            ],
            [
                'question_id' => '4',
                'description' => 'La balise <text>',
                'is_correct' => false,
            ],

            // Réponses pour la question balise HTML pour créer un lien hypertexte
            [
                'question_id' => '5',
                'description' => 'La balise <a> ',
                'is_correct' => true,
            ],
            [
                'question_id' => '5',
                'description' => 'La balise <link> ',
                'is_correct' => false,
            ],
            [
                'question_id' => '5',
                'description' => 'La balise <href> ',
                'is_correct' => false,
            ],
            [
                'question_id' => '5',
                'description' => 'La balise <hyperlink> ',
                'is_correct' => false,
            ],

        // Réponses CSS3
            // Qu'est-ce que CSS3 ?
            [
                'question_id' => '6',
                'description' => 'CSS3 est la dernière version du langage de feuilles de style utilisé pour styliser les éléments HTML sur une page Web.',
                'is_correct' => true,
            ],
            [
                'question_id' => '6',
                'description' => 'CSS3 est un langage de programmation utilisé pour créer des animations dans les pages Web.',
                'is_correct' => false,
            ],
            [
                'question_id' => '6',
                'description' => 'CSS3 est un framework JavaScript pour la création d\'interfaces utilisateur.',
                'is_correct' => false,
            ],
            [
                'question_id' => '6',
                'description' => 'CSS3 est un système de gestion de bases de données pour les applications Web.',
                'is_correct' => false,
            ],
            [// Comment lier un fichier CSS externe à un document HTML ?
                'question_id' => '7',
                'description' => 'utilisez la balise <link> avec l\'attribut href spécifiant le chemin vers le fichier CSS.',
                'is_correct' => true,
            ],
            [
                'question_id' => '7',
                'description' => 'utilisez la balise <style> avec l\'attribut src spécifiant le chemin vers le fichier CSS.',
                'is_correct' => false,
            ],
            [
                'question_id' => '7',
                'description' => 'utilisez la balise <script> avec l\'attribut href spécifiant le chemin vers le fichier CSS.',
                'is_correct' => false,
            ],
            [
                'question_id' => '7',
                'description' => 'utilisez la balise <css> avec l\'attribut href spécifiant le chemin vers le fichier CSS.',
                'is_correct' => false,
            ],

            // Qu'est-ce qu'un sélecteur CSS ?
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une expression utilisée pour cibler les éléments HTML sur une page Web afin de leur appliquer des styles spécifiques.',
                'is_correct' => true,
            ],
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une balise utilisée pour structurer le contenu d\'une page Web.',
                'is_correct' => false,
            ],
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une fonction JavaScript utilisée pour manipuler le DOM.',
                'is_correct' => false,
            ],
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une méthode PHP utilisée pour interroger une base de données.',
                'is_correct' => false,
            ],

            // Comment centrer un élément horizontalement avec CSS ?
            [
                'question_id' => '9',
                'description' => 'utilisez la propriété CSS "margin: 0 auto;" sur l\'élément que vous souhaitez centrer.',
                'is_correct' => true,
            ],
            [
                'question_id' => '9',
                'description' => 'utilisez la propriété CSS "text-align: center;" sur l\'élément parent.',
                'is_correct' => false,
            ],
            [
                'question_id' => '9',
                'description' => 'utilisez la propriété CSS "align: center;" sur l\'élément que vous souhaitez centrer.',
                'is_correct' => false,
            ],
            [
                'question_id' => '9',
                'description' => 'utilisez la propriété CSS "padding: 0 auto;" sur l\'élément que vous souhaitez centrer.',
                'is_correct' => false,
            ],

            // Quelle propriété CSS est utilisée pour changer la couleur du texte ?
            [
                'question_id' => '10',
                'description' => '"color"',
                'is_correct' => true,
            ],
            [
                'question_id' => '10',
                'description' => '"text-color"',
                'is_correct' => false,
            ],
            [
                'question_id' => '10',
                'description' => '"font-color"',
                'is_correct' => false,
            ],
            [
                'question_id' => '10',
                'description' => '"background-color"',
                'is_correct' => false,
            ],

            // Quelle propriété CSS est utilisée pour ajouter de l'espace à l'intérieur d'un élément, entre son contenu et sa bordure ?
            [
                'question_id' => '11',
                'description' => '"padding"',
                'is_correct' => true,
            ],
            [
                'question_id' => '11',
                'description' => '"margin"',
                'is_correct' => false,
            ],
            [
                'question_id' => '11',
                'description' => '"border-spacing"',
                'is_correct' => false,
            ],
            [
                'question_id' => '11',
                'description' => '"spacing"',
                'is_correct' => false,
            ],

        // Réponses JAVASCRIPT
            // Qu'est-ce que JavaScript ?
            [
                'question_id' => '12',
                'description' => 'JavaScript est un langage de programmation utilisé principalement pour rendre les pages Web interactives et dynamiques.',
                'is_correct' => true,
            ],
            [
                'question_id' => '12',
                'description' => 'JavaScript est un moteur de base de données utilisé pour stocker des informations sur le client.',
                'is_correct' => false,
            ],
            [
                'question_id' => '12',
                'description' => 'JavaScript est un système d\'exploitation pour les serveurs Web.',
                'is_correct' => false,
            ],
            [
                'question_id' => '12',
                'description' => 'JavaScript est un format de fichier pour l\'échange de données.',
                'is_correct' => false,
            ],

            // Comment incorporer JavaScript dans une page HTML ?
            [
                'question_id' => '13',
                'description' => 'utilisez la balise <script> avec l\'attribut src pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <script> et </script>.',
                'is_correct' => true,
            ],
            [
                'question_id' => '13',
                'description' => 'utilisez la balise <js> avec l\'attribut src pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <js> et </js>.',
                'is_correct' => false,
            ],
            [
                'question_id' => '13',
                'description' => 'utilisez la balise <script> avec l\'attribut href pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <script> et </script>.',
                'is_correct' => false,
            ],
            [
                'question_id' => '13',
                'description' => 'utilisez la balise <javascript> avec l\'attribut src pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <javascript> et </javascript>.',
                'is_correct' => false,
            ],

            // Quelle est la différence entre les méthodes == et === ?
            [
                'question_id' => '14',
                'description' => '== est un opérateur d\'égalité qui compare les valeurs après conversion de type, tandis que === est un opérateur d\'égalité strict qui compare à la fois les valeurs et les types de données sans conversion.',
                'is_correct' => true,
            ],
            [
                'question_id' => '14',
                'description' => '== est un opérateur d\'égalité strict qui compare à la fois les valeurs et les types de données sans conversion, tandis que === est un opérateur d\'égalité qui compare les valeurs après conversion de type.',
                'is_correct' => false,
            ],
            [
                'question_id' => '14',
                'description' => '== est un opérateur d\'affectation simple, tandis que === est un opérateur d\'égalité qui compare les valeurs après conversion de type.',
                'is_correct' => false,
            ],
            [
                'question_id' => '14',
                'description' => '== et === sont deux opérateurs d\'affectation utilisés pour attribuer des valeurs aux variables.',
                'is_correct' => false,
            ],

            // Quelle méthode JavaScript est utilisée pour convertir une chaîne de caractères en un nombre entier ?
            [
                'question_id' => '15',
                'description' => 'parseInt()',
                'is_correct' => true,
            ],
            [
                'question_id' => '15',
                'description' => 'toInt()',
                'is_correct' => false,
            ],
            [
                'question_id' => '15',
                'description' => 'parseNumber()',
                'is_correct' => false,
            ],
            [
                'question_id' => '15',
                'description' => 'toInteger()',
                'is_correct' => false,
            ],

            // Quelle est la méthode utilisée pour ajouter un élément à la fin d'un tableau en JavaScript ?
            [
                'question_id' => '16',
                'description' => 'push()',
                'is_correct' => true,
            ],
            [
                'question_id' => '16',
                'description' => 'append()',
                'is_correct' => false,
            ],
            [
                'question_id' => '16',
                'description' => 'add()',
                'is_correct' => false,
            ],
            [
                'question_id' => '16',
                'description' => 'insert()',
                'is_correct' => false,
            ],

            // Quelle est la méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM ?
            [
                'question_id' => '17',
                'description' => 'document.getElementById().',
                'is_correct' => true,
            ],
            [
                'question_id' => '17',
                'description' => 'getElementById().',
                'is_correct' => false,
            ],
            [
                'question_id' => '17',
                'description' => 'selectElementById().',
                'is_correct' => false,
            ],
            [
                'question_id' => '17',
                'description' => 'findElementById().',
                'is_correct' => false,
            ],

        // Réponses PHP
            // Qu'est-ce que PHP ?
            [
                'question_id' => '18',
                'description' => 'PHP est un langage de script côté serveur utilisé principalement pour le développement Web.',
                'is_correct' => true,
            ],
            [
                'question_id' => '18',
                'description' => 'PHP est un langage de programmation utilisé pour créer des applications mobiles.',
                'is_correct' => false,
            ],
            [
                'question_id' => '18',
                'description' => 'PHP est une base de données relationnelle souvent utilisée avec MySQL.',
                'is_correct' => false,
            ],
            [
                'question_id' => '18',
                'description' => 'PHP est un framework JavaScript pour le développement back-end.',
                'is_correct' => false,
            ],

            // Comment déclarer une variable en PHP ?
            [
                'question_id' => '19',
                'description' => 'utilisez le symbole $ suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => true,
            ],
            [
                'question_id' => '19',
                'description' => 'utilisez le mot-clé var suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => false,
            ],
            [
                'question_id' => '19',
                'description' => 'utilisez le mot-clé let suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => false,
            ],
            [
                'question_id' => '19',
                'description' => 'utilisez le symbole # suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => false,
            ],

            // Quelles sont les règles pour nommer une variable en PHP ?
            [
                'question_id' => '20',
                'description' => 'commencer par un caractère alphabétique ou underscore (_), suivis de caractères alphanumériques ou underscores (_), sans utiliser de caractères spéciaux ni d\'espaces.',
                'is_correct' => true,
            ],
            [
                'question_id' => '20',
                'description' => 'commencer par un chiffre, suivis de caractères alphanumériques ou underscores (_), sans utiliser de caractères spéciaux ni d\'espaces.',
                'is_correct' => false,
            ],
            [
                'question_id' => '20',
                'description' => 'utiliser uniquement des majuscules et des chiffres, sans espaces ni caractères spéciaux.',
                'is_correct' => false,
            ],
            [
                'question_id' => '20',
                'description' => 'commencer par un signe $, suivis de caractères alphanumériques ou underscores (_), sans utiliser de caractères spéciaux ni d\'espaces.',
                'is_correct' => false,
            ],

            // Comment convertir une chaîne JSON en tableau PHP ?
            [
                'question_id' => '21',
                'description' => 'utilisez la fonction json_decode().',
                'is_correct' => true,
            ],
            [
                'question_id' => '21',
                'description' => 'utilisez la fonction json_encode().',
                'is_correct' => false,
            ],
            [
                'question_id' => '21',
                'description' => 'utilisez la fonction array_parse().',
                'is_correct' => false,
            ],
            [
                'question_id' => '21',
                'description' => 'utilisez la fonction array_json().',
                'is_correct' => false,
            ],

            // Quelle est la fonction utilisée pour échapper les caractères spéciaux en PHP ?
            [
                'question_id' => '22',
                'description' => 'addslashes()',
                'is_correct' => true,
            ],
            [
                'question_id' => '22',
                'description' => 'htmlspecialchars()',
                'is_correct' => false,
            ],
            [
                'question_id' => '22',
                'description' => 'escape()',
                'is_correct' => false,
            ],
            [
                'question_id' => '22',
                'description' => 'secure()',
                'is_correct' => false,
            ],

            // Comment afficher le contenu d'un fichier texte en PHP ?
            [
                'question_id' => '23',
                'description' => 'utilisez la fonction file_get_contents() avec le chemin complet du fichier.',
                'is_correct' => true,
            ],
            [
                'question_id' => '23',
                'description' => 'utilisez la fonction read_file() avec le chemin complet du fichier.',
                'is_correct' => false,
            ],
            [
                'question_id' => '23',
                'description' => 'utilisez la fonction get_file_contents() avec le chemin complet du fichier.',
                'is_correct' => false,
            ],
            [
                'question_id' => '23',
                'description' => 'utilisez la fonction read_text_file() avec le chemin complet du fichier.',
                'is_correct' => false,
            ],


        // Réponses SQL
            // Qu'est-ce que SQL ?
            [
                'question_id' => '24',
                'description' => 'SQL (Structured Query Language) est un langage de programmation standardisé utilisé pour gérer et manipuler des bases de données relationnelles.',
                'is_correct' => true,
            ],
            [
                'question_id' => '24',
                'description' => 'SQL est un système de gestion de base de données relationnelles développé par Microsoft.',
                'is_correct' => false,
            ],
            [
                'question_id' => '24',
                'description' => 'SQL est un langage de programmation utilisé pour créer des applications Web dynamiques.',
                'is_correct' => false,
            ],
            [
                'question_id' => '24',
                'description' => 'SQL est un framework JavaScript pour le développement front-end.',
                'is_correct' => false,
            ],

            // Quelle est la différence entre SQL et MySQL ?
            [
                'question_id' => '25',
                'description' => 'SQL est un langage de requête utilisé pour interagir avec des bases de données, tandis que MySQL est un système de gestion de bases de données relationnelles (SGBDR) utilisant SQL comme langage de requête.',
                'is_correct' => true,
            ],
            [
                'question_id' => '25',
                'description' => 'SQL est une version de MySQL optimisée pour les grandes entreprises, tandis que MySQL est conçu pour les petites et moyennes entreprises.',
                'is_correct' => false,
            ],
            [
                'question_id' => '25',
                'description' => 'SQL est un logiciel open-source développé par Oracle, tandis que MySQL est développé par Microsoft.',
                'is_correct' => false,
            ],
            [
                'question_id' => '25',
                'description' => 'SQL est un langage de programmation, tandis que MySQL est un système d\'exploitation de base de données.',
                'is_correct' => false,
            ],

            // Qu'est-ce qu'une jointure (join) en SQL ?
            [
                'question_id' => '26',
                'description' => 'une clause qui combine des enregistrements de deux ou plusieurs tables basées sur une condition liée à une colonne commune entre elles.',
                'is_correct' => true,
            ],
            [
                'question_id' => '26',
                'description' => 'utilisée pour trier les résultats d\'une requête selon un ordre spécifique.',
                'is_correct' => false,
            ],
            [
                'question_id' => '26',
                'description' => 'une méthode pour insérer des données dans une table à partir d\'une autre table.',
                'is_correct' => false,
            ],
            [
                'question_id' => '26',
                'description' => 'une fonction pour rechercher des informations spécifiques dans une base de données.',
                'is_correct' => false,
            ],

            // Qu'est-ce qu'une clé primaire en SQL ?
            [
                'question_id' => '27',
                'description' => 'une colonne (ou un groupe de colonnes) qui identifie de manière unique chaque ligne d\'une table. Elle garantit l\'unicité des données et est utilisée pour les relations entre tables.',
                'is_correct' => true,
            ],
            [
                'question_id' => '27',
                'description' => 'utilisée pour trier les données d\'une table selon un ordre spécifique.',
                'is_correct' => false,
            ],
            [
                'question_id' => '27',
                'description' => 'une fonction pour insérer des données dans une table à partir d\'une autre table.',
                'is_correct' => false,
            ],
            [
                'question_id' => '27',
                'description' => 'une méthode pour rechercher des informations spécifiques dans une base de données.',
                'is_correct' => false,
            ],

            // Comment insérer une nouvelle ligne dans une table en SQL ?
            [
                'question_id' => '28',
                'description' => 'utilisez la commande INSERT INTO suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => true,
            ],
            [
                'question_id' => '28',
                'description' => 'utilisez la commande ADD suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => false,
            ],
            [
                'question_id' => '28',
                'description' => 'utilisez la commande UPDATE suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => false,
            ],
            [
                'question_id' => '28',
                'description' => 'utilisez la commande CREATE suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => false,
            ],

            // Quelle est la différence entre GROUP BY et ORDER BY en SQL ?
            [
                'question_id' => '29',
                'description' => 'GROUP BY et ORDER BY sont utilisés dans SQL pour organiser les résultats d\'une requête. GROUP BY est utilisé pour regrouper les résultats basés sur une colonne spécifique, tandis que ORDER BY est utilisé pour trier les résultats selon une ou plusieurs colonnes spécifiques.',
                'is_correct' => true,
            ],
            [
                'question_id' => '29',
                'description' => 'GROUP BY est utilisé pour trier les résultats d\'une requête selon un ordre spécifique, tandis que ORDER BY est utilisé pour regrouper les résultats basés sur une colonne spécifique.',
                'is_correct' => false,
            ],
            [
                'question_id' => '29',
                'description' => 'GROUP BY est utilisé pour regrouper les résultats basés sur une colonne spécifique, tandis que ORDER BY est utilisé pour filtrer les résultats selon un critère spécifique.',
                'is_correct' => false,
            ],
            [
                'question_id' => '29',
                'description' => 'GROUP BY est utilisé pour agréger les résultats d\'une requête, tandis que ORDER BY est utilisé pour limiter le nombre de résultats renvoyés.',
                'is_correct' => false,
            ],


        // Réponses Laravel
            // Qu'est-ce que Laravel ?
            [
                'question_id' => '30',
                'description' => 'Laravel est un framework PHP open-source utilisé pour le développement d\'applications web. Il offre une structure robuste et des fonctionnalités puissantes, facilitant la création d\'applications sécurisées et évolutives.',
                'is_correct' => true,
            ],
            [
                'question_id' => '30',
                'description' => 'Laravel est un gestionnaire de base de données relationnelles pour PHP.',
                'is_correct' => false,
            ],
            [
                'question_id' => '30',
                'description' => 'Laravel est un système de gestion de contenu (CMS) pour la création de sites web.',
                'is_correct' => false,
            ],
            [
                'question_id' => '30',
                'description' => 'Laravel est un langage de programmation pour le développement d\'applications mobiles.',
                'is_correct' => false,
            ],

            // Qu'est-ce que Composer ?
            [
                'question_id' => '31',
                'description' => 'Composer est un gestionnaire de dépendances pour PHP, permettant l\'installation, la mise à jour et la gestion des bibliothèques et des packages PHP nécessaires dans un projet.',
                'is_correct' => true,
            ],
            [
                'question_id' => '31',
                'description' => 'Composer est un framework PHP utilisé pour créer des applications web.',
                'is_correct' => false,
            ],
            [
                'question_id' => '31',
                'description' => 'Composer est un éditeur de texte populaire utilisé par les développeurs PHP.',
                'is_correct' => false,
            ],
            [
                'question_id' => '31',
                'description' => 'Composer est une base de données NoSQL utilisée pour le stockage de données non structurées.',
                'is_correct' => false,
            ],

            // Qu'est-ce que l'ORM Eloquent ?
            [
                'question_id' => '32',
                'description' => 'Eloquent est un ORM (Object-Relational Mapping) inclus dans Laravel. Il simplifie la gestion des bases de données en permettant d\'interagir avec celles-ci en utilisant des modèles PHP plutôt que des requêtes SQL directes.',
                'is_correct' => true,
            ],
            [
                'question_id' => '32',
                'description' => 'Eloquent est un moteur de recherche intégré dans Laravel pour trouver des fichiers dans un projet.',
                'is_correct' => false,
            ],
            [
                'question_id' => '32',
                'description' => 'Eloquent est un outil de test unitaire pour PHP inclus dans Laravel.',
                'is_correct' => false,
            ],
            [
                'question_id' => '32',
                'description' => 'Eloquent est un système de cache pour améliorer les performances des applications web.',
                'is_correct' => false,
            ],

            // Quelle commande Laravel est utilisée pour créer un nouveau modèle ?
            [
                'question_id' => '33',
                'description' => 'make:model',
                'is_correct' => true,
            ],
            [
                'question_id' => '33',
                'description' => 'create:model',
                'is_correct' => false,
            ],
            [
                'question_id' => '33',
                'description' => 'new:model',
                'is_correct' => false,
            ],
            [
                'question_id' => '33',
                'description' => 'generate:model',
                'is_correct' => false,
            ],

            // Quelle méthode est utilisée pour définir une relation "many-to-many" dans Eloquent ?
            [
                'question_id' => '34',
                'description' => 'La méthode belongsToMany()',
                'is_correct' => true,
            ],
            [
                'question_id' => '34',
                'description' => 'La méthode hasManyToMany()',
                'is_correct' => false,
            ],
            [
                'question_id' => '34',
                'description' => 'La méthode manyToMany()',
                'is_correct' => false,
            ],
            [
                'question_id' => '34',
                'description' => 'La méthode relateManyToMany()',
                'is_correct' => false,
            ],

            // Quelle est la commande pour exécuter toutes les migrations en Laravel ?
            [
                'question_id' => '35',
                'description' => 'La commande artisan migrate',
                'is_correct' => true,
            ],
            [
                'question_id' => '35',
                'description' => 'La commande artisan migrate:all',
                'is_correct' => false,
            ],
            [
                'question_id' => '35',
                'description' => 'La commande artisan migrate:run',
                'is_correct' => false,
            ],
            [
                'question_id' => '35',
                'description' => 'La commande artisan run:migrations',
                'is_correct' => false,
            ],

        ];

        // Liste des jeux
        $this->games = [
            [
                'user_id' => '1',
                'points' => '22',
            ],
            [
                'user_id' => '2',
                'points' => '27',
            ],
            [
                'user_id' => '3',
                'points' => '35',
            ],
            // [
            //     'user_id' => '4',
            //     'points' => '19',
            // ],
            // [
            //     'user_id' => '5',
            //     'points' => '0',
            // ],
        ];

      
        $this->user_question = [
        // user 1
            [
                'user_id' => '1',
                'question_id' => '17',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3', 
            ],
            [
                'user_id' => '1',
                'question_id' => '25',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '8',
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '19',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '6',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '14',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '20',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '5',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '1', 
            ],
            [
                'user_id' => '1',
                'question_id' => '13',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '4',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '1',
                'question_id' => '24',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '1',
                'question_id' => '15',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '7',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '1',
                'question_id' => '21',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '1',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '1',
                'question_id' => '23',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '12',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '2',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '10',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '9',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '16',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '1',
                'question_id' => '18',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '22',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '26',
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '29',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '1',
                'question_id' => '30',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '1',
                'question_id' => '31',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '32',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '1',
                'question_id' => '33',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '1',
                'question_id' => '34',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '1',
                'question_id' => '35',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],

        // user 2
            [
                'user_id' => '2',
                'question_id' => '10',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '5',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '18',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '14',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '7',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '22',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '2',
                'question_id' => '3',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '26',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '11',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '2',
                'question_id' => '9',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '15',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '17',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '20',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '6',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '8',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '13',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '2',
                'question_id' => '4',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '2',
                'question_id' => '25',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '12',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '23',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '2',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '27',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '19',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '1',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '2',
                'question_id' => '28',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '16',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '2',
                'question_id' => '21',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '2',
                'question_id' => '29',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '30',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '31',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '2',
                'question_id' => '24',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '2',
                'question_id' => '32',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '33',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '2',
                'question_id' => '34',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],

        // user 3

            [
                'user_id' => '3',
                'question_id' => '4',  // Quelle balise HTML est utilisée pour définir un paragraphe ?
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '3',
                'question_id' => '17', // Qu'est-ce que Composer ?
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '10', // Comment centrer un élément horizontalement avec CSS ?
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '1',  // Réduit à 1 bonne réponse
            ],
            [
                'user_id' => '3',
                'question_id' => '25', // Qu'est-ce qu'un middleware en Laravel ?
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '29', // Qu'est-ce qu'une transaction dans une base de données ?
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '7',  // Comment lier un fichier CSS externe à un document HTML ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '15', // Quelle est la méthode utilisée pour ajouter un élément à la fin d'un tableau en JS ?
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '1',  // Réduit à 1 bonne réponse
            ],
            [
                'user_id' => '3',
                'question_id' => '22', // Qu'est-ce que l'ORM Eloquent ?
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '1',  // Réduit à 1 bonne réponse
            ],
            [
                'user_id' => '3',
                'question_id' => '9',  // Qu'est-ce qu'un sélecteur CSS ?
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '12', // Quelle méthode JS est utilisée pour convertir une chaîne en nombre entier ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '1',  // Qu'est-ce que HTML5 ?
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '3',  // Comment inclure une image dans une page HTML ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '24', // Quelle est la différence entre GROUP BY et ORDER BY en SQL ?
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '1',  // Réduit à 1 bonne réponse
            ],
            [
                'user_id' => '3',
                'question_id' => '19', // Quelle est la différence entre une base de données relationnelle et non-relationnelle ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '31', // Quelle est la différence entre DELETE et TRUNCATE en SQL ?
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '21', // Comment afficher le contenu d'un fichier texte en PHP ?
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '28', // Qu'est-ce qu'un service provider en Laravel ?
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '5',  // Quelle balise HTML est utilisée pour créer un lien hypertexte ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '14', // Quelles sont les règles pour nommer une variable en PHP ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '27', // Qu'est-ce qu'un événement en JS ?
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '1',  // Réduit à 1 bonne réponse
            ],
            [
                'user_id' => '3',
                'question_id' => '11', // Quelle propriété CSS est utilisée pour ajouter de l'espace à l'intérieur d'un élément ?
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '1',  // Réduit à 1 bonne réponse
            ],
            [
                'user_id' => '3',
                'question_id' => '13', // Quelle est la différence entre les méthodes == et === ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '30', // Qu'est-ce qu'une jointure en SQL ?
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',  // Réduit à 1 bonne réponse
            ],
            [
                'user_id' => '3',
                'question_id' => '8',  // Comment ajouter un commentaire dans CSS ?
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '6',  // Qu'est-ce que l'API Fetch en JS ?
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            
        ];
            
        // Liste des game_question
        $this->game_question = [
        // game 1 (user 1)
            [
                'game_id' => '1',
                'question_id' => '5',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '13',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '4',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'game_id' => '1',
                'question_id' => '24',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'game_id' => '1',
                'question_id' => '15',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '7',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '21',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '1',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'game_id' => '1',
                'question_id' => '23',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '12',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'game_id' => '1',
                'question_id' => '2',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '10',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '9',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '16',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'game_id' => '1',
                'question_id' => '18',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '1',
                'question_id' => '22',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],

        // game 2 (user 2)
            [
                'game_id' => '2',
                'question_id' => '10',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'game_id' => '2',
                'question_id' => '5',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '2',
                'question_id' => '18',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'game_id' => '2',
                'question_id' => '14',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '2',
                'question_id' => '7',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '2',
                'question_id' => '22',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
            ],
            [
                'game_id' => '2',
                'question_id' => '3',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '2',
                'question_id' => '26',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '2',
                'question_id' => '11',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'game_id' => '2',
                'question_id' => '9',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '2',
                'question_id' => '15',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '2',
                'question_id' => '17',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],

        // game 3 (user 3)
            [
                'game_id' => '3',
                'question_id' => '4',
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '0',
            ],
            [
                'game_id' => '3',
                'question_id' => '17',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '3',
                'question_id' => '10',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'game_id' => '3',
                'question_id' => '25',
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '3',
                'question_id' => '29',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'game_id' => '3',
                'question_id' => '7',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'game_id' => '3',
                'question_id' => '15',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'game_id' => '3',
                'question_id' => '22',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'game_id' => '3',
                'question_id' => '9',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
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

        // Seed la table 'questions'
        $this->processQuestions($this->questions);

        // Seed la table 'answers'
        $this->processAnswers($this->answers);

        // Seed la table 'games'
        $this->processGames($this->games);

        // Seed la table 'user_question'
        $this->processUserQuestion($this->user_question);

        // Seed la table 'game_question'
        $this->processGameQuestion($this->game_question);

         // Appel des autres seeders
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
        ]);
    }

     /**
     * Seed la table 'users'
     */
    private function processUsers($users)
    {
        // Insère les données dans la table 'users'
        DB::table('users')->insert($users);
    }

     /**
     * Seed la table 'categories'
     */
    private function processCategories($categories)
    {
        DB::table('categories')->insert($categories);
    }

     /**
     * Seed la table 'questions'
     */
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
            DB::table('questions')->insertGetId($data); // je n'ai pas besoin de '$question_id = ' car je ne m'en ressers pas après dans la fonction. je n'ai pas besoin de sotcker la valeur ds une variable.

            // ---- code suivants inutile -----
            // Seed la catégorie de la question
            // $this->processQuestionCategory($question_id, $question['type']);

            // Seed la réponse correspondande à la question
            // $this->processAnswer($question_id, $question['question']);
        }
    }

     /**
     * Seed la table 'answers'
     */
    private function processAnswers($answers)
    {
        foreach ($answers as $answer) {
            // dump($answer);
            // Définit les données de la réponse à destination de la table 'answers'
            $data = [
                'question_id' => $answer['question_id'],
                'description'=> $answer['description'],
                'is_correct'=> $answer['is_correct'],
            ];
            // Insère les données dans la table 'answers'
            $answer_id = DB::table('answers')->insertGetId($data);
        }
    }

     /**
     * Seed la table 'games'
     */
    private function processGames($games)
    {
        foreach ($games as $game) {
            // dump($game);
            // Définit les données de la réponse à destination de la table 'games'
            $data = [
                'user_id' => $game['user_id'],
                'points' => $game['points'],
            ];
            // Insère les données dans la table 'games'
            DB::table('games')->insertGetId($data);
        }
    }
    /**
     * Seed la table 'user_question'
     */
    private function processUserQuestion($user_question)
    {
        foreach ($user_question as $data) {
            $insertData = [
                'user_id' => $data['user_id'],
                'question_id' => $data['question_id'],
                'asked_count' => $data['asked_count'],
                'stars' => $data['stars'],
                'answers_trues_count' => $data['answers_trues_count'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('user_question')->insert($insertData);
        }
    }

     
     /**
     * Seed la table 'game_question'
     */
    
    private function processGameQuestion($game_question)
    {
        foreach ($game_question as $data) {
            // Définit les données à destination de la table 'game_question'
            $insertData = [
                'game_id' => $data['game_id'],
                'question_id' => $data['question_id'],
                'asked_count' => $data['asked_count'],
                'stars' => $data['stars'],
                'answers_trues_count' => $data['answers_trues_count'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            // Insère les données dans la table 'game_question'
            DB::table('game_question')->insert($insertData);
        }
    }
}
