<?php 

#include('./includes/local_db.php');

class Vote_class { 

    public function up_vote ( $article_id,$user_id){
          if (self::has_vote($article_id,$user_id)){
        $query=" SELECT vote from user_votes where article_id = $article_id and user_id = $user_id LIMIT 1;";
        $result = mysql_query( $query);

         while($info = mysql_fetch_array($result )) 
        { 
        $vote =$info[0];
        break;
        }
        if($vote == 0 ){
             $vote_value = 1;
            $query=" UPDATE user_votes SET `vote` = '1' where article_id= $article_id and user_id = $user_id ";
        }
        else {
             $vote_value = 0;
            $query=" UPDATE user_votes SET `vote` = '0' where article_id= $article_id and user_id = $user_id ";
        }

        }
        else {
             $vote_value = 1;
        $query=" INSERT into `user_votes` (`user_id`,`article_id`,`vote`) VALUES ('".$user_id."','".$article_id."','1');";
      #  echo $query;
        }
        

          $result = mysql_query($query);
      if(!$result) die ("Could not query: " . mysql_error());
      if ($vote == 0 || $vote == -1){
            $current = self::get_votes($article_id);
            $current++;
            
            self::set_votes($article_id,$current);
        }
        else {
             $current = self::get_votes($article_id);
            $current = $current - 1;
            self::set_votes($article_id,$current);
        }
      return $current;
         // var_dump($result);
       
     }
   public function down_vote ( $article_id,$user_id){
          if (self::has_vote($article_id,$user_id)){
        $query=" SELECT vote from user_votes where article_id = $article_id and user_id = $user_id LIMIT 1;";
        $result = mysql_query( $query);

         while($info = mysql_fetch_array($result )) 
        { 
        $vote =$info[0];
        break;
        }
        if($vote ==0){
            $vote_value = -1;
            $query=" UPDATE user_votes SET `vote` = '-1' where article_id= $article_id and user_id = $user_id ";}
        else {
             $vote_value = 0;
            $query=" UPDATE user_votes SET `vote` = '0' where article_id= $article_id and user_id = $user_id ";
        }

        }
        else {
             $vote_value = -1;
        $query=" INSERT into `user_votes` (`user_id`,`article_id`,`vote`) VALUES ('".$user_id."','".$article_id."','-1');";
      #  echo $query;
        }
          $result = mysql_query($query);
      if(!$result) die ("Could not query: " . mysql_error());
      if ($vote == 0 || $vote == 1){
            $current = self::get_votes($article_id);
            $current = $current - 1;    
            self::set_votes($article_id,$current);
        }
        else {
             $current = self::get_votes($article_id);
            $current = $current + 1;
            self::set_votes($article_id,$current);
        }
        return $current;

         // var_dump($result);
       
     }

    public function has_vote($article_id,$user_id){
        $query=" SELECT count(*),vote from user_votes where article_id = $article_id and user_id = $user_id ;";

        $result = mysql_query( $query);

         while($info = mysql_fetch_array($result )) 
        { 
        $count=$info[0];
        }
        if($count>0){return true;}
        else return false;
    }

    public function get_votes($article_id){
        $query=" SELECT votes from article_votes where article_id = $article_id ;";
        $count = 0;
        $result = mysql_query( $query);

         while($info = mysql_fetch_array($result )) 
        { 
        $count=$info[0];
        }
        
        
        return $count;
    }

    public function set_votes($article_id,$votes){

        $query=" SELECT count(*) from article_votes where article_id = $article_id ;";
        $result = mysql_query( $query);
        while($info = mysql_fetch_array($result )) 
        { 
        $count=$info[0];
        break;
        }
        if ($count == 0){
            $query=" INSERT INTO article_votes (`article_id`,`votes`) VALUES ($article_id,$votes);";

            }
        else {
             $query=" UPDATE article_votes SET `votes` = $votes where article_id = $article_id ;";
        }

       # echo $query;
        $result = mysql_query( $query);
        
    }
    
}






?>
