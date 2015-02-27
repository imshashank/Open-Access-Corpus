<?php


	include('./includes/local_db.php');
	include('./user_vote.php');

if( $_GET["article_id"]  )
{
    $obj = new Vote_class();
    print $obj->get_votes($_REQUEST["article_id"] );
   
  
}

#$obj = new Vote_class();
#print $obj->get_votes(1);

#print $obj->set_votes(1,4);

?>