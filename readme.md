This is Market Reality System (mrs).

#1st Part :

Migration Sequence ::
User Module

    php artisan migrate --path="modules/user/database/migrations/"
    
Admin Module

    php artisan migrate --path="modules/admin/database/migrations/"


#2nd Part :
Migration 

    php artisan migrate --path="modules/mktg/database/migrations/"

Seed ( For the tables of - mktg_material, mktg_artwork):
    php artisan db:seed

