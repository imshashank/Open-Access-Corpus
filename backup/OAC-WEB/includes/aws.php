<?php 
//require_once = 'login.php';

$db_database = 'corpus';
$db_hostname = 'oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com:3306';
$db_username = 'corpus';
$db_password = 'OCLC_123';


$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if(!$db_server) die("Unable to connect to MYSQL: ". mysql_error());

mysql_select_db($db_database)
    or die("Unable to connect to database: " . mysql_error());
    '''
$query= "CREATE TABLE IF NOT EXISTS `votes` (
  `article_id` int(10) NOT NULL,
  `votes` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";
$result =mysql_query($query);
var_dump($result);
/*
$query = "DROP table authors;";

mysql_query($query);

$query = "CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(10) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(100) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;";
mysql_query($query);



$query = "TRUNCATE articles;";
$result = mysql_query($query);

var_dump($result);
echo "articles";

$query = "TRUNCATE article_journal;";
$result = mysql_query($query);
var_dump($result);
echo "article_journal";

$query = "TRUNCATE article_tags;";
$result = mysql_query($query);
var_dump($result);
echo "article_tags";


$query = "TRUNCATE issns;";
$result = mysql_query($query);
var_dump($result);
echo "issns";



$query = "TRUNCATE journal;";
$result = mysql_query($query);
var_dump($result);
echo "journal";



$query = "TRUNCATE pagerank;";
$result = mysql_query($query);
var_dump($result);


$query = "TRUNCATE publisher;";
$result = mysql_query($query);
var_dump($result);
echo "pagerank";


$query = "TRUNCATE publisher_article;";
$result = mysql_query($query);
var_dump($result);
echo "publisher_articles";


$query = "TRUNCATE tags;";
$result = mysql_query($query);
var_dump($result);
echo "tags";



$query = "TRUNCATE author_article;";
$result = mysql_query($query);
var_dump($result);
echo "author_articles";



$query = "DELETE from  authors;";
$result = mysql_query($query);
var_dump($result);
echo "authors";

$query = "ALTER TABLE articles AUTO_INCREMENT = 0;";
$result = mysql_query($query);
var_dump($result);
echo "reset articles";

$query = "ALTER TABLE authors AUTO_INCREMENT = 0;";
$result = mysql_query($query);
var_dump($result);
echo "reset authors";

$query = "ALTER TABLE journal AUTO_INCREMENT = 0;";
$result = mysql_query($query);
var_dump($result);
echo "reset journal";


$query = "ALTER TABLE publisher AUTO_INCREMENT = 0;";
$result = mysql_query($query);
var_dump($result);
echo "reset publisher";


$query = "ALTER TABLE tags AUTO_INCREMENT = 0;";
$result = mysql_query($query);
var_dump($result);
echo "reset tags";

$query = "ALTER TABLE `articles` ADD `alternate_id` VARCHAR(20) NOT NULL AFTER `article_id`;";
$result = mysql_query($query);
var_dump($result);

*/
'''
mysql_close($db_server);

?>

