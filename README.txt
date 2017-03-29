[NOTE]
This project is remade from "DineRoulette" project ("DineRoulette" project repo: 0000DineRoulette0000).

[ABOUT]
Folder contains source code for DineRoulette web-based application.

[DECLAIMER]
This application is for learning purposes only. 
Please contact me at: tamkylet@sfu.ca if any legal issues that exist.

[DATABASE]
-DB called "dine" created  //2016-09-04 5:41pm
-User: tamkylet  Password: password    granted privileges to dine DB  //2016-09-04 5:44pm
-user table created in dine DB  //2016-09-04 5:47pm
-restaurant table created in dine DB  //2016-09-04 5:47pm
-dines table created in dine DB  //2016-09-04 5:48pm

[IMAGE REFERENCE]
/DineRoulette-tamkylet/app/images/gastown.png
source: http://www.hellovancity.com/lifestyle/beautiful-night-shot-of-gastown-downtown-vancouver-photo/

[ADMINISTRATOR ACCESS]
-Username: masteruser    Password: dinerouletteA1

[REGULAR USER]
-Username: abc123abc        Password: abc123abcA1

[PROBLEMS]
Despite upgrading to PHP 5.6.27 there is a problem inserting php variables into html text
Needed for home.php by inserting variable into <img></img> html tag
Possible solution: Sessions/Cookies and jQuery to write into <img> tag