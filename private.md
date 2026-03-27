composer create-project symfony/skeleton TaskLinker --no-interaction    -creating project
composer require symfony/orm-pack                                       -mapping database
composer require symfony/maker-bundle --dev                             -generating controllers, forms, entities
composer require --dev doctrine/doctrine-fixtures-bundle                -fixture for database
composer require symfony/twig-bundle                                    -twig engine
composer require symfony/asset                                          -directory with CSS and JS

composer require --dev squizlabs/php_codesniffer                        -verification du code du style
composer require --dev friendsofphp/php-cs-fixer                        -correction du code general