<?php 
include('./includes/db.php');
include('./article_class.php');

class Vote_class { 


    public function set_vote ($article_id, $vote){
        if (self::has_vote($article_id)){
         $query=" UPDATE votes SET `votes` = $vote where article_id= $article_id";
        // echo $query;
        }
        else {
        $query=" INSERT into `votes` (`article_id`,`votes`) VALUES ('$article_id','$vote');";
       // echo $query;
        }
          $result = mysql_query($query);
      if(!$result) die ("Could not query: " . mysql_error());

         // var_dump($result);
       
     }
   

    public function has_vote($article_id){
        $query=" SELECT count(*) from votes where article_id = $article_id ;";
        $result = mysql_query($query);
         while($info = mysql_fetch_array( $result )) 
        { 
        $count=$info[0];
        }
        if($count>0){return true;}
        else return false;
    }


    public function author_count($article_id, $condition, $count){
        //get count

        $auth_count = count(Article_db::get_author_ids($article_id));

        if ($condition == '0' && $auth_count <= $count){
                return true;
           }
           else if ($condition == '2' && $auth_count == $count){
            return true;
           }
           else if ($condition == '1' && $auth_count >= $count){
            return true;
           }
           else return false;
    }


     public function tag_count($article_id, $condition, $count){
        //get count
        $tag_count = count(Article_db::get_tags_id($article_id));

        if ($condition == '0' && $tag_count <= $count){
                return true;
           }
           else if ($condition == '2' && $tag_count == $count){
            return true;
           }
           else if ($condition == '1' && $tag_count >= $count){
            return true;
           }
           else return false;
    }

    public function is_published ($article_id){
        $info = Article_db::get_article_by_id($article_id);    
         if ($info['0']['is_published'] == '1') return true;
         else return false;
    }


    public function url_valid ($article_id){
        $info = Article_db::get_article_by_id($article_id);    
         if ($info['0']['url'] != '') return true;
         else return false;
    }


    public function doi_valid ($article_id){
        $info = Article_db::get_article_by_id($article_id);    
         if ($info['0']['doi'] != 'None') return true;
         else return false;
    }
}

?>