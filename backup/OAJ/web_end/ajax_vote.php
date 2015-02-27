<?php


	include('./includes/local_db.php');
	include('./user_vote.php');

if( $_REQUEST["article_id"] && $_REQUEST["user_id"] && $_REQUEST["vote"] )
{
    $obj = new Vote_class();
    if ($_REQUEST["vote"] == 'up'){
        print $obj->up_vote($_REQUEST["article_id"],$_REQUEST["user_id"] );
    }
    else if ($_REQUEST["vote"] == 'down'){
       print $obj->down_vote($_REQUEST["article_id"] ,$_REQUEST["user_id"] );
    }
  
}

#$obj = new Vote_class();
#print $obj->get_votes(1);

#print $obj->set_votes(1,4);

?>