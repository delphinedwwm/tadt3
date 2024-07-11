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
                'password' => 'vedailec'
            ],
            [
                'name' => 'Nathan',
                'email' => 'nathanweb@user.com',
                'password' => 'bewnahtan'
            ],
            [
                'name' => 'Jérémie',
                'email' => 'jeremiedev@user.com',
                'password' => 'vedeimerej'
            ],
            // [
            //     'name' => 'David',
            //     'email' => 'davidweb@user.com',
            //     'password' => 'bewdivad'
            // ],
            // [
            //     'name' => 'Alicia',
            //     'email' => 'aliciawebdev@user.com',
            //     'password' => 'vedbewaicila'
            // ],
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

        // liste des questions
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


    
        // Listes des réponses nouvelles organisation
        $this->answers = [
        // Réponses HTML5
            [
                'question_id' => '1',
                'description' => 'HTML5 est la dernière version du langage de balisage utilisé pour créer des pages Web. Il introduit de nouvelles fonctionnalités et améliorations par rapport aux versions précédentes.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '1',
                'description' => 'HTML5 est un langage de programmation utilisé pour créer des applications mobiles.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '1',
                'description' => 'HTML5 est un framework JavaScript pour le développement front-end.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '1',
                'description' => 'HTML5 est un système de gestion de base de données.',
                'is_correct' => 'false',
            ],

            // Réponses pour la question différence entre une balise de bloc et une balise en ligne
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise qui crée un bloc distinct sur la page, occupant toute la largeur disponible. Une balise en ligne, quant à elle, est une balise qui n\'occupe que l\'espace nécessaire autour de son contenu.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise qui n\'a pas de contenu visible sur la page, contrairement à une balise en ligne qui affiche du contenu.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise utilisée pour styliser du texte, tandis qu\'une balise en ligne est utilisée pour structurer une page.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '2',
                'description' => 'Une balise de bloc est une balise utilisée pour ajouter des images, tandis qu\'une balise en ligne est utilisée pour du texte uniquement.',
                'is_correct' => 'false',
            ],

            // Réponses pour la question inclure une image dans une page HTML
            [
                'question_id' => '3',
                'description' => 'Pour inclure une image dans une page HTML, utilisez la balise <img> avec l\'attribut src pour spécifier l\'emplacement de l\'image.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '3',
                'description' => 'Pour inclure une image dans une page HTML, utilisez la balise <image> avec l\'attribut source pour spécifier l\'emplacement de l\'image.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '3',
                'description' => 'Pour inclure une image dans une page HTML, utilisez la balise <img> avec l\'attribut link pour spécifier l\'emplacement de l\'image.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '3',
                'description' => 'Pour inclure une image dans une page HTML, utilisez la balise <img> avec l\'attribut href pour spécifier l\'emplacement de l\'image.',
                'is_correct' => 'false',
            ],

            // Réponses pour la question balise HTML pour définir un paragraphe
            [
                'question_id' => '4',
                'description' => 'La balise HTML <p> est utilisée pour définir un paragraphe dans une page Web.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '4',
                'description' => 'La balise HTML <paragraph> est utilisée pour définir un paragraphe dans une page Web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '4',
                'description' => 'La balise HTML <para> est utilisée pour définir un paragraphe dans une page Web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '4',
                'description' => 'La balise HTML <text> est utilisée pour définir un paragraphe dans une page Web.',
                'is_correct' => 'false',
            ],

            // Réponses pour la question balise HTML pour créer un lien hypertexte
            [
                'question_id' => '5',
                'description' => 'La balise HTML <a> est utilisée pour créer un lien hypertexte dans une page Web.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '5',
                'description' => 'La balise HTML <link> est utilisée pour créer un lien hypertexte dans une page Web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '5',
                'description' => 'La balise HTML <href> est utilisée pour créer un lien hypertexte dans une page Web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '5',
                'description' => 'La balise HTML <hyperlink> est utilisée pour créer un lien hypertexte dans une page Web.',
                'is_correct' => 'false',
            ],

        // Réponses CSS3
            // Qu'est-ce que CSS3 ?
            [
                'question_id' => '6',
                'description' => 'CSS3 est la dernière version du langage de feuilles de style utilisé pour styliser les éléments HTML sur une page Web.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '6',
                'description' => 'CSS3 est un langage de programmation utilisé pour créer des animations dans les pages Web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '6',
                'description' => 'CSS3 est un framework JavaScript pour la création d\'interfaces utilisateur.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '6',
                'description' => 'CSS3 est un système de gestion de bases de données pour les applications Web.',
                'is_correct' => 'false',
            ],
            [// Comment lier un fichier CSS externe à un document HTML ?
                'question_id' => '7',
                'description' => 'Pour lier un fichier CSS externe à un document HTML, utilisez la balise <link> avec l\'attribut href spécifiant le chemin vers le fichier CSS.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '7',
                'description' => 'Pour lier un fichier CSS externe à un document HTML, utilisez la balise <style> avec l\'attribut src spécifiant le chemin vers le fichier CSS.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '7',
                'description' => 'Pour lier un fichier CSS externe à un document HTML, utilisez la balise <script> avec l\'attribut href spécifiant le chemin vers le fichier CSS.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '7',
                'description' => 'Pour lier un fichier CSS externe à un document HTML, utilisez la balise <css> avec l\'attribut href spécifiant le chemin vers le fichier CSS.',
                'is_correct' => 'false',
            ],

            // Qu'est-ce qu'un sélecteur CSS ?
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une expression utilisée pour cibler les éléments HTML sur une page Web afin de leur appliquer des styles spécifiques.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une balise utilisée pour structurer le contenu d\'une page Web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une fonction JavaScript utilisée pour manipuler le DOM.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '8',
                'description' => 'Un sélecteur CSS est une méthode PHP utilisée pour interroger une base de données.',
                'is_correct' => 'false',
            ],

            // Comment centrer un élément horizontalement avec CSS ?
            [
                'question_id' => '9',
                'description' => 'Pour centrer un élément horizontalement avec CSS, utilisez la propriété CSS "margin: 0 auto;" sur l\'élément que vous souhaitez centrer.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '9',
                'description' => 'Pour centrer un élément horizontalement avec CSS, utilisez la propriété CSS "text-align: center;" sur l\'élément parent.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '9',
                'description' => 'Pour centrer un élément horizontalement avec CSS, utilisez la propriété CSS "align: center;" sur l\'élément que vous souhaitez centrer.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '9',
                'description' => 'Pour centrer un élément horizontalement avec CSS, utilisez la propriété CSS "padding: 0 auto;" sur l\'élément que vous souhaitez centrer.',
                'is_correct' => 'false',
            ],

            // Quelle propriété CSS est utilisée pour changer la couleur du texte ?
            [
                'question_id' => '10',
                'description' => 'La propriété CSS utilisée pour changer la couleur du texte est "color".',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '10',
                'description' => 'La propriété CSS utilisée pour changer la couleur du texte est "text-color".',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '10',
                'description' => 'La propriété CSS utilisée pour changer la couleur du texte est "font-color".',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '10',
                'description' => 'La propriété CSS utilisée pour changer la couleur du texte est "background-color".',
                'is_correct' => 'false',
            ],

            // Quelle propriété CSS est utilisée pour ajouter de l'espace à l'intérieur d'un élément, entre son contenu et sa bordure ?
            [
                'question_id' => '11',
                'description' => 'La propriété CSS utilisée pour ajouter de l\'espace à l\'intérieur d\'un élément est "padding".',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '11',
                'description' => 'La propriété CSS utilisée pour ajouter de l\'espace à l\'intérieur d\'un élément est "margin".',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '11',
                'description' => 'La propriété CSS utilisée pour ajouter de l\'espace à l\'intérieur d\'un élément est "border-spacing".',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '11',
                'description' => 'La propriété CSS utilisée pour ajouter de l\'espace à l\'intérieur d\'un élément est "spacing".',
                'is_correct' => 'false',
            ],

        // Réponses JAVASCRIPT
            // Qu'est-ce que JavaScript ?
            [
                'question_id' => '12',
                'description' => 'JavaScript est un langage de programmation utilisé principalement pour rendre les pages Web interactives et dynamiques.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '12',
                'description' => 'JavaScript est un moteur de base de données utilisé pour stocker des informations sur le client.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '12',
                'description' => 'JavaScript est un système d\'exploitation pour les serveurs Web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '12',
                'description' => 'JavaScript est un format de fichier pour l\'échange de données.',
                'is_correct' => 'false',
            ],

            // Comment incorporer JavaScript dans une page HTML ?
            [
                'question_id' => '13',
                'description' => 'Pour incorporer JavaScript dans une page HTML, utilisez la balise <script> avec l\'attribut src pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <script> et </script>.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '13',
                'description' => 'Pour incorporer JavaScript dans une page HTML, utilisez la balise <js> avec l\'attribut src pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <js> et </js>.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '13',
                'description' => 'Pour incorporer JavaScript dans une page HTML, utilisez la balise <script> avec l\'attribut href pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <script> et </script>.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '13',
                'description' => 'Pour incorporer JavaScript dans une page HTML, utilisez la balise <javascript> avec l\'attribut src pour inclure un fichier externe ou placez le code JavaScript directement entre les balises <javascript> et </javascript>.',
                'is_correct' => 'false',
            ],

            // Quelle est la différence entre les méthodes == et === ?
            [
                'question_id' => '14',
                'description' => 'En JavaScript, == est un opérateur d\'égalité qui compare les valeurs après conversion de type, tandis que === est un opérateur d\'égalité strict qui compare à la fois les valeurs et les types de données sans conversion.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '14',
                'description' => 'En JavaScript, == est un opérateur d\'égalité strict qui compare à la fois les valeurs et les types de données sans conversion, tandis que === est un opérateur d\'égalité qui compare les valeurs après conversion de type.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '14',
                'description' => 'En JavaScript, == est un opérateur d\'affectation simple, tandis que === est un opérateur d\'égalité qui compare les valeurs après conversion de type.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '14',
                'description' => 'En JavaScript, == et === sont deux opérateurs d\'affectation utilisés pour attribuer des valeurs aux variables.',
                'is_correct' => 'false',
            ],

            // Quelle méthode JavaScript est utilisée pour convertir une chaîne de caractères en un nombre entier ?
            [
                'question_id' => '15',
                'description' => 'La méthode JavaScript utilisée pour convertir une chaîne de caractères en un nombre entier est parseInt().',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '15',
                'description' => 'La méthode JavaScript utilisée pour convertir une chaîne de caractères en un nombre entier est toInt().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '15',
                'description' => 'La méthode JavaScript utilisée pour convertir une chaîne de caractères en un nombre entier est parseNumber().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '15',
                'description' => 'La méthode JavaScript utilisée pour convertir une chaîne de caractères en un nombre entier est toInteger().',
                'is_correct' => 'false',
            ],

            // Quelle est la méthode utilisée pour ajouter un élément à la fin d'un tableau en JavaScript ?
            [
                'question_id' => '16',
                'description' => 'La méthode JavaScript utilisée pour ajouter un élément à la fin d\'un tableau est push().',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '16',
                'description' => 'La méthode JavaScript utilisée pour ajouter un élément à la fin d\'un tableau est append().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '16',
                'description' => 'La méthode JavaScript utilisée pour ajouter un élément à la fin d\'un tableau est add().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '16',
                'description' => 'La méthode JavaScript utilisée pour ajouter un élément à la fin d\'un tableau est insert().',
                'is_correct' => 'false',
            ],

            // Quelle est la méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM ?
            [
                'question_id' => '17',
                'description' => 'La méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM est document.getElementById().',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '17',
                'description' => 'La méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM est getElementById().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '17',
                'description' => 'La méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM est selectElementById().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '17',
                'description' => 'La méthode JavaScript utilisée pour sélectionner un élément par son ID dans le DOM est findElementById().',
                'is_correct' => 'false',
            ],

        // Réponses PHP
            // Qu'est-ce que PHP ?
            [
                'question_id' => '18',
                'description' => 'PHP est un langage de script côté serveur utilisé principalement pour le développement Web.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '18',
                'description' => 'PHP est un langage de programmation utilisé pour créer des applications mobiles.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '18',
                'description' => 'PHP est une base de données relationnelle souvent utilisée avec MySQL.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '18',
                'description' => 'PHP est un framework JavaScript pour le développement back-end.',
                'is_correct' => 'false',
            ],

            // Comment déclarer une variable en PHP ?
            [
                'question_id' => '19',
                'description' => 'Pour déclarer une variable en PHP, utilisez le symbole $ suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '19',
                'description' => 'Pour déclarer une variable en PHP, utilisez le mot-clé var suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '19',
                'description' => 'Pour déclarer une variable en PHP, utilisez le mot-clé let suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '19',
                'description' => 'Pour déclarer une variable en PHP, utilisez le symbole # suivi du nom de la variable et attribuez-lui une valeur avec l\'opérateur =.',
                'is_correct' => 'false',
            ],

            // Quelles sont les règles pour nommer une variable en PHP ?
            [
                'question_id' => '20',
                'description' => 'Les règles pour nommer une variable en PHP sont : commencer par un caractère alphabétique ou underscore (_), suivis de caractères alphanumériques ou underscores (_), sans utiliser de caractères spéciaux ni d\'espaces.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '20',
                'description' => 'Les règles pour nommer une variable en PHP sont : commencer par un chiffre, suivis de caractères alphanumériques ou underscores (_), sans utiliser de caractères spéciaux ni d\'espaces.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '20',
                'description' => 'Les règles pour nommer une variable en PHP sont : utiliser uniquement des majuscules et des chiffres, sans espaces ni caractères spéciaux.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '20',
                'description' => 'Les règles pour nommer une variable en PHP sont : commencer par un signe $, suivis de caractères alphanumériques ou underscores (_), sans utiliser de caractères spéciaux ni d\'espaces.',
                'is_correct' => 'false',
            ],

            // Comment convertir une chaîne JSON en tableau PHP ?
            [
                'question_id' => '21',
                'description' => 'Pour convertir une chaîne JSON en tableau PHP, utilisez la fonction json_decode().',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '21',
                'description' => 'Pour convertir une chaîne JSON en tableau PHP, utilisez la fonction json_encode().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '21',
                'description' => 'Pour convertir une chaîne JSON en tableau PHP, utilisez la fonction array_parse().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '21',
                'description' => 'Pour convertir une chaîne JSON en tableau PHP, utilisez la fonction array_json().',
                'is_correct' => 'false',
            ],

            // Quelle est la fonction utilisée pour échapper les caractères spéciaux en PHP ?
            [
                'question_id' => '22',
                'description' => 'La fonction utilisée pour échapper les caractères spéciaux en PHP est addslashes().',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '22',
                'description' => 'La fonction utilisée pour échapper les caractères spéciaux en PHP est htmlspecialchars().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '22',
                'description' => 'La fonction utilisée pour échapper les caractères spéciaux en PHP est escape().',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '22',
                'description' => 'La fonction utilisée pour échapper les caractères spéciaux en PHP est secure().',
                'is_correct' => 'false',
            ],

            // Comment afficher le contenu d'un fichier texte en PHP ?
            [
                'question_id' => '23',
                'description' => 'Pour afficher le contenu d\'un fichier texte en PHP, utilisez la fonction file_get_contents() avec le chemin complet du fichier.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '23',
                'description' => 'Pour afficher le contenu d\'un fichier texte en PHP, utilisez la fonction read_file() avec le chemin complet du fichier.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '23',
                'description' => 'Pour afficher le contenu d\'un fichier texte en PHP, utilisez la fonction get_file_contents() avec le chemin complet du fichier.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '23',
                'description' => 'Pour afficher le contenu d\'un fichier texte en PHP, utilisez la fonction read_text_file() avec le chemin complet du fichier.',
                'is_correct' => 'false',
            ],


        // Réponses SQL
            // Qu'est-ce que SQL ?
            [
                'question_id' => '24',
                'description' => 'SQL (Structured Query Language) est un langage de programmation standardisé utilisé pour gérer et manipuler des bases de données relationnelles.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '24',
                'description' => 'SQL est un système de gestion de base de données relationnelles développé par Microsoft.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '24',
                'description' => 'SQL est un langage de programmation utilisé pour créer des applications Web dynamiques.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '24',
                'description' => 'SQL est un framework JavaScript pour le développement front-end.',
                'is_correct' => 'false',
            ],

            // Quelle est la différence entre SQL et MySQL ?
            [
                'question_id' => '25',
                'description' => 'SQL est un langage de requête utilisé pour interagir avec des bases de données, tandis que MySQL est un système de gestion de bases de données relationnelles (SGBDR) utilisant SQL comme langage de requête.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '25',
                'description' => 'SQL est une version de MySQL optimisée pour les grandes entreprises, tandis que MySQL est conçu pour les petites et moyennes entreprises.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '25',
                'description' => 'SQL est un logiciel open-source développé par Oracle, tandis que MySQL est développé par Microsoft.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '25',
                'description' => 'SQL est un langage de programmation, tandis que MySQL est un système d\'exploitation de base de données.',
                'is_correct' => 'false',
            ],

            // Qu'est-ce qu'une jointure (join) en SQL ?
            [
                'question_id' => '26',
                'description' => 'Une jointure (join) en SQL est une clause qui combine des enregistrements de deux ou plusieurs tables basées sur une condition liée à une colonne commune entre elles.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '26',
                'description' => 'Une jointure (join) en SQL est utilisée pour trier les résultats d\'une requête selon un ordre spécifique.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '26',
                'description' => 'Une jointure (join) en SQL est une méthode pour insérer des données dans une table à partir d\'une autre table.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '26',
                'description' => 'Une jointure (join) en SQL est une fonction pour rechercher des informations spécifiques dans une base de données.',
                'is_correct' => 'false',
            ],

            // Qu'est-ce qu'une clé primaire en SQL ?
            [
                'question_id' => '27',
                'description' => 'Une clé primaire en SQL est une colonne (ou un groupe de colonnes) qui identifie de manière unique chaque ligne d\'une table. Elle garantit l\'unicité des données et est utilisée pour les relations entre tables.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '27',
                'description' => 'Une clé primaire en SQL est utilisée pour trier les données d\'une table selon un ordre spécifique.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '27',
                'description' => 'Une clé primaire en SQL est une fonction pour insérer des données dans une table à partir d\'une autre table.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '27',
                'description' => 'Une clé primaire en SQL est une méthode pour rechercher des informations spécifiques dans une base de données.',
                'is_correct' => 'false',
            ],

            // Comment insérer une nouvelle ligne dans une table en SQL ?
            [
                'question_id' => '28',
                'description' => 'Pour insérer une nouvelle ligne dans une table en SQL, utilisez la commande INSERT INTO suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '28',
                'description' => 'Pour insérer une nouvelle ligne dans une table en SQL, utilisez la commande ADD suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '28',
                'description' => 'Pour insérer une nouvelle ligne dans une table en SQL, utilisez la commande UPDATE suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '28',
                'description' => 'Pour insérer une nouvelle ligne dans une table en SQL, utilisez la commande CREATE suivie du nom de la table et des valeurs à insérer dans les colonnes correspondantes.',
                'is_correct' => 'false',
            ],

            // Quelle est la différence entre GROUP BY et ORDER BY en SQL ?
            [
                'question_id' => '29',
                'description' => 'GROUP BY et ORDER BY sont utilisés dans SQL pour organiser les résultats d\'une requête. GROUP BY est utilisé pour regrouper les résultats basés sur une colonne spécifique, tandis que ORDER BY est utilisé pour trier les résultats selon une ou plusieurs colonnes spécifiques.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '29',
                'description' => 'GROUP BY est utilisé pour trier les résultats d\'une requête selon un ordre spécifique, tandis que ORDER BY est utilisé pour regrouper les résultats basés sur une colonne spécifique.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '29',
                'description' => 'GROUP BY est utilisé pour regrouper les résultats basés sur une colonne spécifique, tandis que ORDER BY est utilisé pour filtrer les résultats selon un critère spécifique.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '29',
                'description' => 'GROUP BY est utilisé pour agréger les résultats d\'une requête, tandis que ORDER BY est utilisé pour limiter le nombre de résultats renvoyés.',
                'is_correct' => 'false',
            ],


        // Réponses Laravel
            // Qu'est-ce que Laravel ?
            [
                'question_id' => '30',
                'description' => 'Laravel est un framework PHP open-source utilisé pour le développement d\'applications web. Il offre une structure robuste et des fonctionnalités puissantes, facilitant la création d\'applications sécurisées et évolutives.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '30',
                'description' => 'Laravel est un gestionnaire de base de données relationnelles pour PHP.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '30',
                'description' => 'Laravel est un système de gestion de contenu (CMS) pour la création de sites web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '30',
                'description' => 'Laravel est un langage de programmation pour le développement d\'applications mobiles.',
                'is_correct' => 'false',
            ],

            // Qu'est-ce que Composer ?
            [
                'question_id' => '31',
                'description' => 'Composer est un gestionnaire de dépendances pour PHP, permettant l\'installation, la mise à jour et la gestion des bibliothèques et des packages PHP nécessaires dans un projet.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '31',
                'description' => 'Composer est un framework PHP utilisé pour créer des applications web.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '31',
                'description' => 'Composer est un éditeur de texte populaire utilisé par les développeurs PHP.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '31',
                'description' => 'Composer est une base de données NoSQL utilisée pour le stockage de données non structurées.',
                'is_correct' => 'false',
            ],

            // Qu'est-ce que l'ORM Eloquent ?
            [
                'question_id' => '32',
                'description' => 'Eloquent est un ORM (Object-Relational Mapping) inclus dans Laravel. Il simplifie la gestion des bases de données en permettant d\'interagir avec celles-ci en utilisant des modèles PHP plutôt que des requêtes SQL directes.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '32',
                'description' => 'Eloquent est un moteur de recherche intégré dans Laravel pour trouver des fichiers dans un projet.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '32',
                'description' => 'Eloquent est un outil de test unitaire pour PHP inclus dans Laravel.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '32',
                'description' => 'Eloquent est un système de cache pour améliorer les performances des applications web.',
                'is_correct' => 'false',
            ],

            // Quelle commande Laravel est utilisée pour créer un nouveau modèle ?
            [
                'question_id' => '33',
                'description' => 'La commande artisan make:model est utilisée pour créer un nouveau modèle dans Laravel.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '33',
                'description' => 'La commande artisan create:model est utilisée pour créer un nouveau modèle dans Laravel.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '33',
                'description' => 'La commande artisan new:model est utilisée pour créer un nouveau modèle dans Laravel.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '33',
                'description' => 'La commande artisan generate:model est utilisée pour créer un nouveau modèle dans Laravel.',
                'is_correct' => 'false',
            ],

            // Quelle méthode est utilisée pour définir une relation "many-to-many" dans Eloquent ?
            [
                'question_id' => '34',
                'description' => 'La méthode belongsToMany() est utilisée dans Eloquent pour définir une relation "many-to-many" entre deux modèles.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '34',
                'description' => 'La méthode hasManyToMany() est utilisée dans Eloquent pour définir une relation "many-to-many" entre deux modèles.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '34',
                'description' => 'La méthode manyToMany() est utilisée dans Eloquent pour définir une relation "many-to-many" entre deux modèles.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '34',
                'description' => 'La méthode relateManyToMany() est utilisée dans Eloquent pour définir une relation "many-to-many" entre deux modèles.',
                'is_correct' => 'false',
            ],

            // Quelle est la commande pour exécuter toutes les migrations en Laravel ?
            [
                'question_id' => '35',
                'description' => 'La commande artisan migrate est utilisée pour exécuter toutes les migrations en Laravel.',
                'is_correct' => 'true',
            ],
            [
                'question_id' => '35',
                'description' => 'La commande artisan migrate:all est utilisée pour exécuter toutes les migrations en Laravel.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '35',
                'description' => 'La commande artisan migrate:run est utilisée pour exécuter toutes les migrations en Laravel.',
                'is_correct' => 'false',
            ],
            [
                'question_id' => '35',
                'description' => 'La commande artisan run:migrations est utilisée pour exécuter toutes les migrations en Laravel.',
                'is_correct' => 'false',
            ],

        ];

        // Liste des jeux
        $this->games = [
            [
                'user_id' => '1',
                'points' => '27',
            ],
            [
                'user_id' => '2',
                'points' => '27',
            ],
            [
                'user_id' => '3',
                'points' => '6',
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

      
        
        $this->users_questions = [
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
                'question_id' => '29',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '18',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '20',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '26',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '32',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '3',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '15',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '34',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '31',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '5',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '23',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '11',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '7',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '16',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '19',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '13',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '1',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '14',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '17',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '8',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '30',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '25',
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '12',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '10',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '22',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '6',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '24',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '2',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '9',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '28',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '35',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ]
        ];
            
        // Liste des games_questions
        $this->games_questions = [
        // user 1
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
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '1',
                'question_id' => '7',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
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
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '0',
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

        // user 3
            [
                'user_id' => '3',
                'question_id' => '4',
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '0',
            ],
            [
                'user_id' => '3',
                'question_id' => '17',
                'asked_count' => '1',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '10',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '25',
                'asked_count' => '2',
                'stars' => '1',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '29',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '7',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '15',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '22',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '9',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '12',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '1',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '3',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '24',
                'asked_count' => '4',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '19',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '31',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '21',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '28',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '5',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '14',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '27',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '11',
                'asked_count' => '4',
                'stars' => '0',
                'answers_trues_count' => '3',
            ],
            [
                'user_id' => '3',
                'question_id' => '13',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '30',
                'asked_count' => '3',
                'stars' => '0',
                'answers_trues_count' => '2',
            ],
            [
                'user_id' => '3',
                'question_id' => '8',
                'asked_count' => '2',
                'stars' => '0',
                'answers_trues_count' => '1',
            ],
            [
                'user_id' => '3',
                'question_id' => '6',
                'asked_count' => '3',
                'stars' => '1',
                'answers_trues_count' => '2',
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

        // Seed la table 'users_questions'
        $this->processUsers_Questions($this->users_questions);

        // Seed la table 'games'
        $this->processGames($this->games);

        // Seed la table 'games_questions'
        $this->processGames_Questions($this->games_questions);
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
     * Seed la table 'users_questions' pour un user
     */

    private function processUsers_Questions($users_questions)
    {
        foreach ($users_questions as $user_question) {
            // dump($users_question);
            // Définit les données de la réponse à destination de la table 'users_questions'
            $data = [
                'question_id' => $user_question['question_id'],
                'user_id'=> $user_question['user_id'],
                'asked_count'=> $user_question['asked_count'],
                'stars' => $user_question['stars'],
                'answers_trues_count' => $user_question['answers_trues_count'],
                
            ];
            // Insère les données dans la table 'answers'
            DB::table('users_questions')->insertGetId($data);
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
     * Seed la table 'games_questions'
     */
    private function processGames_Questions($games_questions)
    {
        foreach ($games_questions as $game_question) {
            // dump($game_question);
            // Définit les données de la réponse à destination de la table 'games_questions'
            $data = [
                'question_id' => $game_question['question_id'],
                'user_id'=> $game_question['user_id'],
                'asked_count'=> $game_question['asked_count'],
                'stars' => $game_question['stars'],
                'answers_trues_count' => $game_question['answers_trues_count'],
            ];
            // Insère les données dans la table 'answers'
            DB::table('games_questions')->insertGetId($data);
        }
    }

}
