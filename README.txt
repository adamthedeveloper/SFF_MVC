SFF_MVC is an acronym for "Simple Foundation Framework_Model View Controller"

The purpose of this framework is to have a fully exposed framework that gives you complete control over how you want to do things.  It is an MVC and nothing else really - which is sometimes nice for small projects that you want to
quickly throw together or if you have a large project and you want to leave all the bloat out that other frameworks come with.

Doctrine is included and ready to go - it also has the Doctrine CLI in place and ready.  You will find it in the system/application folder.  Here are the commands:

users-macbook-pro-5:application user$ php doctrine.php 
Doctrine Command Line Interface

doctrine.php build-all
doctrine.php build-all-load
doctrine.php build-all-reload
doctrine.php compile
doctrine.php create-db
doctrine.php create-tables
doctrine.php dql
doctrine.php drop-db
doctrine.php dump-data
doctrine.php generate-migration
doctrine.php generate-migrations-db
doctrine.php generate-migrations-diff
doctrine.php generate-migrations-models
doctrine.php generate-models-db
doctrine.php generate-models-yaml
doctrine.php generate-sql
doctrine.php generate-yaml-db
doctrine.php generate-yaml-models
doctrine.php load-data
doctrine.php migrate
doctrine.php rebuild-db

SFF_MVC also contains jQuery and Robert Fischer's JQuery-PeriodicUpdater (http://github.com/RobertFischer/JQuery-PeriodicalUpdater) - Thanks Robert!

Because Doctrine is loaded in here, you will need to be running PHP >= 5.2.3, PDO and PDO_MySQL if you plan on running with mysql. Otherwise, take a look at Doctrine's documentation: http://www.doctrine-project.org/
Since this relies on .htaccess, you will need apache - but feel free to change this to your needs on your environment.

Doctrine was installed into this application via Subversion.  You may be able to just do svn update to get the latest stuff from them - though - do so at your own risk.

There are some example controllers and actions with this installation so that you can see how things work. Also,
you will find that partials can be rendered by calling renderPartial() in your view scripts like so 
<?php echo $this->renderPartial('employees/_pagination'); ?>  You will see an example of this in app/views/scripts/employees/show.phtml - you can also specify layouts in app/views/layouts and set which one to use in your controller actions.

Thanks for trying it! Adam Medeiros (aka: adamthedeveloper)
 