# Spring21-POS
Retail Store POS System

This github project is in development by 5 college students. The end product should be a fully functional Point of Sale system.

# Installation

### Getting the webserver setup

You'll want to install [XXAMP](https://www.apachefriends.org/download.html), we recommend build 7.4.15 as that is what this project has been built with. Once installed you're going to want to start the apache and MySQL server. Once the server is running and you're able to confirm that [localhost/dashboard](http://localhost/dashboard) successfully returns the XAMPP dashboard you're good to go for the next step. 

### Prepping the MySQL database

We provide a .sql file in the backend folder. You're going to want to import this into the MySQL server through phpMyAdmin, if you're using the local XAMPP server you can do so through [this](http://localhost/phpmyadmin/server_import.php) link. You just want to choose the .sql file and click `Go` at the bottom right. This will import all the needed database and tables for it. This should then populate the server and direct to a page with `Import has been successfully finished` at the top. 

### Extra steps

Once we add the ability to create users and such there will be steps to setup the starter administrator user. 


# Contributing

### Frontend

Put steps to contribute to the frontend. 

### Backend

Steps here but for database changes it's already *done*.

#### Making database changes

After making changes to the database itself you'll most likely need to create a new .sql file(unless we decide to automatically create tables/databases on startup). You can do that from [here](http://localhost/phpmyadmin/server_export.php). You're going to want to name the template SecurePOS, and click the circle next to `Custom - display all possible options`. Some new options should show up. Under the databases list you want **only** `securepos` selected. This will export only that needed database. You can leave everything else the same and click on `Go` at the bottom right(need to scroll down). This should then export the file and automatically download it to your computer. Then replace the currently .sql file in the `backend` folder with the one downloaded. You'll want to rename it to securepos.sql as well for organization. 
