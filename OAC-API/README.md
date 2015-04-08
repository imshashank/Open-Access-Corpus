#Open Access Corpus API code

To use the code just change the database settings in file "db.php".

The code uses ".htaccess" to rewrite the URL.

All requests are passed to the file "api.php". The URL is broken down into different variables. 

The variables are then used to determine the API call and the data is then passed to the "article_class.php". 

The article_class.php then connects with the database and return the output to the api.php file.

The api.php file then return the result as a json object.

To include analytics, google server analytics code was added to the api.php file.
