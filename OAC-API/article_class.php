<?php

class Article_db {


    public function get_articles($start,$end){
        if(isset($start) && isset($end)){
            $query = "SELECT * FROM articles LIMIT $start, $end";
          //  echo $query;
        }
        else
        {

            $query = "SELECT * FROM articles LIMIT 20";
           // echo $query;
        }

        $result = mysql_query($query);


    if(!$result) die ("Please check the request and try again" );
    $out = [];
    $rows = mysql_num_rows($result);
    while($article_info = mysql_fetch_array( $result ))
        {
    //var_dump($info);


        $info['article_id']= $article_info['article_id'];
        $info['alternate_id']= $article_info['alternate_id'];
        $info['title']= $article_info['title'];
        $info['abstract']= $article_info['abstract'];
        $info['url']= stripcslashes($article_info['url']);
        $info['doi']= $article_info['doi'];
        $info['language']= $article_info['language'];
        $info['year']= $article_info['year'];
        $info['page']= $article_info['page'];
        $info['is_published']= $article_info['is_published'];
        $info['alts']= $article_info['alts'];

        $article_id =$article_info['article_id'];
        $info['authors']= self::get_authors($article_id);
        $info['journal']=self::get_journal($article_id);
        $info['tags']=self::get_tags($article_id);
        $info['publisher']=self::get_publisher($article_id);

        $out[]=$info;


        }
    return $out;
    }

    public function get_article_by_id($article_id){
        $query = "SELECT * FROM articles where article_id = $article_id LIMIT 1";
        $result = mysql_query($query);

    if(!$result) die ("Please check the request and try again" );
    $out = [];
    $rows = mysql_num_rows($result);
    while($article_info = mysql_fetch_array( $result ))
        {
    //var_dump($info);
        $info['article_id']= $article_info['article_id'];
        $info['alternate_id']= $article_info['alternate_id'];
        $info['title']= $article_info['title'];
        $info['abstract']= $article_info['abstract'];
        $info['url']= $article_info['url'];
        $info['doi']= $article_info['doi'];
        $info['language']= $article_info['language'];
        $info['year']= $article_info['year'];
        $info['page']= $article_info['page'];
        $info['is_published']= $article_info['is_published'];
        $info['alts']= $article_info['alts'];

        $article_id =$article_info['article_id'];
//        $info['author_ids']= self::get_author_ids($article_id);
        $info['authors']= self::get_authors($article_id);
        $info['journal']=self::get_journal($article_id);
        $info['tags']=self::get_tags($article_id);
        $info['publisher']=self::get_publisher($article_id);

        }
    return $info;

    }

public function get_article_by_alternate_id($alternate_id){

         $query = "SELECT * FROM articles where alternate_id like '$alternate_id' LIMIT 1";
        // echo $query;
                 $result = mysql_query($query);

    if(!$result) die ("Please check the request and try again" );
    $out = [];
    $rows = mysql_num_rows($result);
    while($article_info = mysql_fetch_array( $result ))
        {
    //var_dump($info);
         $info['article_id']= $article_info['article_id'];
        $info['alternate_id']= $article_info['alternate_id'];
        $info['title']= $article_info['title'];
        $info['abstract']= $article_info['abstract'];
        $info['url']= $article_info['url'];
        $info['doi']= $article_info['doi'];
        $info['language']= $article_info['language'];
        $info['year']= $article_info['year'];
        $info['page']= $article_info['page'];
        $info['is_published']= $article_info['is_published'];
        $info['alts']= $article_info['alts'];

        $article_id =$article_info['article_id'];
       // $info['author_ids']= self::get_author_ids($article_id);
        $info['authors']= self::get_authors($article_id);
        $info['journal']=self::get_journal($article_id);
        $info['tags']=self::get_tags($article_id);
        $info['publisher']=self::get_publisher($article_id);
         $out[]=$info;

        }
    return $out;

    }
public function get_article_by_author_id($author_id){
    $article_id = [];
    $article_id = self::get_article_id_by_author($author_id);
   // var_dump($article_id);
    $output = [];
foreach ($article_id as $value){
         $query = "SELECT article_id,title FROM articles where article_id like '$value' LIMIT 1 ";
        // echo $query;
    $result = mysql_query($query);

    if(!$result) die ("Please check the request and try again" );
    $rows = mysql_num_rows($result);
    $out = [];
    while($article_info = mysql_fetch_array( $result ))
        {
   // var_dump($article_info);
         $info['article_id']= $article_info['article_id'];

        $info['title']= $article_info['title'];

         $out[]=$info;

        }
        $output[]=$out;
    }
    return $output;

    }
    function get_author_ids($article_id){
        $q = "select author_id from author_article where article_id = $article_id;";
        $auth_ids = [];
        $auth_result = mysql_query($q);
        while($row = mysql_fetch_array($auth_result))
        {
    $auth_ids[] = $row['author_id'];
        }

        return $auth_ids;
    }

    public static function get_author_names($author_id) {
        $auth_names = [];
        if (is_array($author_id)){
                foreach ($author_id as $value){
                        $q = "select author_name from authors where author_id = $value;";
                        //echo $q;
                        $auth_result = mysql_query($q);
                        while($row = mysql_fetch_array($auth_result))
                        {
                        $auth_names[] = $row['author_name'];
                        }
                }

        }
        else {
                $q = "select author_name from authors where author_id = $author_id LIMIT 1;";
                $auth_result = mysql_query($q);
                        while($row = mysql_fetch_array($auth_result))
                        {
                        $auth_names = $row['author_name'];
                        }
        }
        //var_dump($auth_names);
        return $auth_names;
    }

    public static function get_authors($article_id){
        return (self::get_author_names(self::get_author_ids($article_id)));
    }

     public static function get_article_id_by_author($author_id){
        $query ="SELECT * from author_article where author_id = $author_id;";
        $auth_id = [];
        $auth_result = mysql_query($query);
            while($row = mysql_fetch_array($auth_result))
            {
            $auth_id[] = $row['article_id'];
            }
            return $auth_id;
    }


    public static function get_journal_id($article_id){
                $q = "select journal_id from article_journal where article_id = $article_id LIMIT 1;";
                //echo $q;
                $journal_id = '';
                $auth_result = mysql_query($q);
                while($row = mysql_fetch_array($auth_result))
                        {
                        $journal_id = $row['journal_id'];
                        }
                return $journal_id;
    }
    public static function get_journal_by_name($journal_name){
        $journal_name = str_replace('%20', ' ', $journal_name);
                $q = "select journal_id from journal where journal_name like '$journal_name' LIMIT 1;";

                #echo $q;
                $journal_id = '';
                $auth_result = mysql_query($q);
                while($row = mysql_fetch_array($auth_result))
                        {
                        $journal_id = $row['journal_id'];
                        }
                return $journal_id;
    }
    public static function get_journal_name($journal_id){
        $q = "select journal_name from journal where journal_id = $journal_id LIMIT 1;";
        $auth_result = mysql_query($q);
        $journal_name = '';
        while($row = mysql_fetch_array($auth_result))
                        {
                        $journal_name= $row['journal_name'];
                        }
                        return $journal_name;
    }

    public  function get_journal($article_id){
        $j_id = self::get_journal_id($article_id);
        if ($j_id != ''){
          return (self::get_journal_name($j_id));
        }
        else {
        return 'None';}
    }



    public static function get_publisher_id($article_id){
        $q = "select publisher_id from publisher_article where article_id = $article_id LIMIT 1;";
        //echo $q;
        $journal_id='';
        $auth_result = mysql_query($q);
        while($row = mysql_fetch_array($auth_result))
            {
            $journal_id = $row['publisher_id'];
                break ;
            }
        return $journal_id;
    }

    public static function get_publisher_name($publisher_id){
        $q = "select publisher_name from publisher where publisher_id = $publisher_id ;";
        $auth_result = mysql_query($q);
        while($row = mysql_fetch_array($auth_result))
            {
            $journal_name= $row['publisher_name'];
            }
            return $journal_name;
    }

    public  function get_publisher($article_id){
        $pub_id = self::get_publisher_id($article_id);
        if ($pub_id != ''){
          return (self::get_publisher_name($pub_id));
        }
        else return 'None';


    }

    public function get_tags_id($article_id){

        $q = "select * from article_tags where article_id = $article_id;";
       // echo $q;
    $tag_ids = [];
    $tag_result = mysql_query($q);
    while($row = mysql_fetch_array($tag_result))
    {
    $tag_ids[] = $row['tag_id'];
    }

    return $tag_ids;

    }

    public function get_tag_name($tags_id){
        $tag_names = [];
        if (is_array($tags_id)){
            foreach ($tags_id as $value){
            $q = "select tags_name from tags where tags_id = $value ;";
            //echo $q;
            $tag_result = mysql_query($q);
            while($row = mysql_fetch_array($tag_result))
            {
            $tag_names[] = $row['tags_name'];
            }
            }

        }
        else {
            $q = "select tags_name from tags where tags_id = $tags_id LIMIT 1;";
            $tag_result = mysql_query($q);
            while($row = mysql_fetch_array($tag_result))
            {
            $tag_names = $row['tags_name'];
            }
        }
        //var_dump($auth_names);
        return $tag_names;

    }

    public  function get_tags($article_id){
          return (self::get_tag_name(self::get_tags_id($article_id)));

    }
public function get_concepts_id($alternate_id){

    $q = "select * from article_concept where alternate_id = '$alternate_id' Order by Score desc;";
        #echo $q;
    $concept_ids = [];
    $tag_result = mysql_query($q);
    while($row = mysql_fetch_array($tag_result))
    {
    $concept_ids[$row['concept_id']] = $row['score'];
    }
    #var_dump($concept_ids);
    return $concept_ids;

    }

  public function get_concept_name($concept_ids){
        $concept_names = [];
        {
            foreach($concept_ids as $key=>$val){
                $q = "select * from concepts where concept_id = $key ;";
                //echo $q;
                $tag_result = mysql_query($q);
                while($row = mysql_fetch_array($tag_result))
                    {
                    $temp =[];
                    $temp[]= $row['concept_name'];
                    $temp[]= $val;
                   # $concept_names[] = $row['concept_name'];
                    array_push($concept_names,$temp);
                    }
            }


        }
        #var_dump($concept_names);
        return $concept_names;

    }

     public  function get_concepts($alternate_id){
          return (self::get_concept_name(self::get_concepts_id($alternate_id)));

    }
    public function get_article_id_by_tags_id($tag_id){
        $query = "SELECT article_id from article_tags where tag_id = $tag_id LIMIT 5;";
        //echo $query;
        $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );
            $out=[];
      while($info = mysql_fetch_array( $result ))
        {

        $out[]=$info[0];
        }
        return $out;

    }
    public function get_vote ($article_id){
        $query ="SELECT votes from votes where article_id = $article_id LIMIT 1;";
         $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );
            $vote=[];
      while($info = mysql_fetch_array( $result ))
        {
        $vote=$info[0];
        }
        return $vote;
    }

     public function total_articles (){

        $query = "SELECT count(*)  from articles;";
        $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $count=$info[0];
        }
        return $count;

     }

    public function total_authors (){
        $query = "SELECT count(*)  from authors;";
        $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $count=$info[0];
        }
        return $count;
    }

     public function total_journals (){
        $query = "SELECT count(*)  from journal;";
        $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $count=$info[0];
        }
        return $count;
     }

     public function total_publishers(){
        $query = "SELECT count(*)  from publisher;";
        $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $count=$info[0];
        }
        return $count;
     }

     public function total_tags(){
        $query = "SELECT count(*)  from tags;";
        $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $count=$info[0];
        }
        return $count;
     }
    public function total_dois(){
        $query = "SELECT count(*)  from articles where doi != 'None';";
        $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $count=$info[0];
        }
        return $count;
     }

public function best_authors(){
    $query = "SELECT author_id, COUNT(*) AS count FROM author_article GROUP BY author_id ORDER by count DESC LIMIT 10 ;";
    $best=[];
    $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $best[]=$info;
        }
        return $best;
    }



public function best_journals(){
    $query = "SELECT journal_id, COUNT(*) AS count FROM article_journal GROUP BY journal_id ORDER by count DESC LIMIT 10 ;";
    $best=[];
    $result = mysql_query($query);
        if(!$result) die ("Please check the request and try again" );

      while($info = mysql_fetch_array( $result ))
        {
        $best[]=$info;
        }
        return $best;
    }

}

?>
