# Post data validator class

[![Build Status](https://travis-ci.org/gnieark/PostDataValidator.svg?branch=master)](https://travis-ci.org/gnieark/PostDataValidator)


This  class generate the jquery validator code, and can be used to recheck the rules on PHP, server side, after the submission.

## dev status:

Writing the doc (this readme)

## Getting Started

Declarations are sames as as [Jquery-validation](https://jqueryvalidation.org).

Tested with PHP 5.6 , 7.0, 7.1,  7.2 
Does not work with 5.4.

### Installing
Install jquery and the plugin jquery-validate on your headers.

Open a new object:

    $rulesChecker = new Post_Rule_Manager();

Add a contrainst on a field:

    $rulesChecker-> add_constraint('FieldName', 'validation_method', parameters, 'string error sentence')

* field_name:
* validation_method:
* parameter:
* sentence:

Get Jquery validate Code:
In a header javascript script, in the usual  $().ready( ... put the result of get_jquery_validate_code($formId) method. like this:

    <script>
          $().ready(function() {
                <?php echo ($rulesChecker->get_jquery_validate_code('FormId')); ?>
            });    
    </script>
### Sample:


An old PHP style form with this class that can be tested there: 
[test PostDataValidator] (https://postdatavalidator-demo.tinad.fr/)


    <?php
    //Load the classes
    require("../autoload.php"); //change it

    //declare yor form rules:
    $rulesChecker = new Post_Rule_Manager();
    $rulesChecker
        -> add_constraint('sgbd', 'required', null, 'Le champs type base de données est requis')
        -> add_constraint('sgbd', 'in', array('mysql','pgsql'),  'Le type de base de donnée peut etre seulement mysql ou pgsql')
        -> add_constraint('host', 'required',null,'Le champs hôte est requis')
        -> add_constraint('dbname','required',null,'Le nom de la base de données est requis')
        -> add_constraint('login','required',null,'Le login est requis')
        -> add_constraint('local_user_display_name','minlength',2,'Le nom de l\'utilisateur doit contenir au moins 2 caractères')
        -> add_constraint('local_user_password','minlength',6,'6 caracteres sont requis our le mot de passe')
        -> add_constraint('local_user_password', 'equalTo', 'local_user_password_repeat','La confirmation du mot de passe n\'est pas identique.');

    if(isset($_POST["submit"])){

        //the form as been submitted.
        //check values on the server

        if(!$rulesChecker->check())
        {
            //doesnot pass server check
            echo "something wrong...\n";
            
            //if you want to know what rule returned false, 
            //use last_check_log property:
            echo $rulesChecker->last_check_log;
            
            //If there is an error here while the data has already been verified 
            //on the client side by jquery Validator:
            // there is a big bug on the site, 
            // or an attempt to hack. 
            //Better to stop the script.
            die();
        }else{
            echo "I's OK";
            //do submit code
            // ...
            
        }
        die();
    }
    // The form:
    ?>
    <html>
        <head>
            <title>Install</title>
            <!-- You have to install JQUERY , change src to your own jquery url -->
            <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
            <!-- You have to install JQUERY  validate plugin too-->
            <script src="/js/jquery.validate.min.js" type="text/javascript"></script>
            <script>
            $().ready(function() {
                <?php 
                    //Call the method to generate the jquery validator 's plugin snippet
                    echo ($rulesChecker->get_jquery_validate_code('FormId')); 
                ?>
            });    
                
            </script>
        </head>
        <body>
            <!-- A classic HTML form  -->
            <!-- just notice that "name" and "id" on input elements have the same value -->
            <h1>Installation de l'application</h1>
            <form method="POST" action="/index.php" id="FormId">
            <fieldset>
                <input type="hidden" name="action" value="initConfigure"/>
                <h2>Base de donnée:</h2>
                <p>
                    <label>Type de base:</label>
                    <select name="sgbd" id="sgdb">
                        <option value="mysql">MySQL</option>
                        <option value="pgsql">PostgreeSQL</option>
                    </select>
                </p>
                <p><label>Hote:</label><input type="text" name="host" value="localhost" id="host"></p>
                <p><label>Database:</label><input type="text" name="dbname" id="dbname"/></p>
                <p><label>login:</label><input type="login" name="login" id="login"/></p>
                <p><label>Mot de passe:</label><input type="password" name="password" id="password"/></p>
                <h2>Compte administrateur local:</h2>
                <p><label>Nom à afficher</label><input type="text" name="local_user_display_name" value="SYSTEM" id="local_user_display_name"/></p>
                <p><label>identifiant de connexion:</label><input type="text" name="local_user_loggin" id="local_user_loggin"/></p>
                <p><label>Son mot de passe:</label><input type="password" name="local_user_password" id="local_user_password"/></p>
                <p><label>Confirmez le mot de passe:</label><input type="password" name="local_user_password_repeat" id ="local_user_password_repeat"/>
                </p>
            <p><input type="submit" name="submit"/></p>
        </fieldset>
            </form>
        </body>
    </html>