<?php


        /*
                This is an example class script proceeding secured API
                To use this class you should keep same as query string and function name
                Ex: If the query string value rquest=delete_user Access modifiers doesn't matter but function should be
                     function delete_user(){
                                 You code goes here
                         }
                Class will execute the function dynamically;

                usage :

                    $object->response(output_data, status_code);
                        $object->_request       - to get santinized input

                        output_data : JSON (I am using)
                        status_code : Send status message for headers

                Add This extension for localhost checking :
                        Chrome Extension : Advanced REST client Application
                        URL : https://chrome.google.com/webstore/detail/hgmloofddffdnphfgcellkdfbfbjeloo

                I used the below table for demo purpose.

        */

        require_once("Rest.inc.php");
        include('article_class.php');
        include('db.php');
        include('search_class.php');

	include('analytics.php');

        class API extends REST {

                public $data = "";
                public $params=[];

                public function __construct(){
                        parent::__construct();                          // Init parent contructor
                }


                public function processApi(){
                //$func = strtolower(trim(str_replace("/","",$query)));
                #remove the directory path we don't want
                #$request  = str_replace("", "", $_SERVER['REQUEST_URI']);
                $request  = str_replace("", "", $_SERVER['REQUEST_URI']);
//               $request  = $_SERVER['REQUEST_URI'];
                #split the path by '/'
//echo $_SERVER['REMOTE_ADDR'];
//echo $_SERVER['HTTP_USER_AGENT'];
                $this->params     = split("/", $request);
                $func = $params['1'];
//var_dump($params);

 //                var_dump($this->params);
                $func = strtolower(trim(str_replace("/","",$this->params['1'])));
$d = array(
  'title' => $func,
  'slug' => $request,
);
gaBuildHit( 'pageview', $d);

                $this->params['1'] = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9 ]/", '', $this->params['2']));
                $this->params['2'] = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9 ]/", '', $this->params['3']));

                
                        if((int)method_exists($this,$func) > 0){
                                $this->$func();
                                        }
                        else
                //             var_dump($func);
                            echo "Illegal Request";
                      #  $this->response('',404);                                // If the method not exist with in this class, response would be "Page not found".
                }




                private function get_articles(){
                        if($this->get_request_method() == "GET"){
                        $obj = new Article_db();

                        if($this->params['1'] != ''){
                                $start= $this->params['1'];

                        }
                        if( $this->params['2'] != ''){
                                $end= $this->params['2'];
				if ($end>20){
				$end = 20;}
                        }
                        else $end = 20;
//			echo "start" .$start."End ".$end;
                        $result = $obj->get_articles($start,$end);
                        $this->response($this->json($result), 200);
                        }else if ($this->get_request_method() == "POST")
                        {
                        $obj = new Article_db();
                        $start= $this->_request['start'];
                        $result = $obj->get_articles($start,$end);
                        $this->response($this->json($result), 200);
                        }
                        else {$this->response('',406);}
                }

                private function get_article_by_id(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $article_id = $this->params['1'];
                        $result = $obj->get_article_by_id($article_id);
                        $this->response($this->json($result), 200);

                        }
                        else if ($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_article_by_id($article_id);
                        $this->response($this->json($result), 200);
                        }else { $this->response('',406);}
                }



                private function get_article_by_alternate_id(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $alternate_id = $this->params['1'];
                        $result = $obj->get_article_by_alternate_id($alternate_id);
                        $this->response($this->json($result), 200);

                        }
                        else if ($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_article_by_alternate_id($article_id);
                        $this->response($this->json($result), 200);
                        }else { $this->response('',406);}
                }



                private function get_author_ids(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $article_id = $this->params['1'];
                        $result = $obj->get_author_ids($article_id);
                        $this->response($this->json($result), 200);

                        }
                        else if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_author_ids($article_id);
                        $this->response($this->json($result), 200);
                        }else {$this->response('',406);
                        }
                }


                private function get_author_names(){

                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $author_id = $this->params['1'];
                        $result = $obj->get_author_names($author_id);
                        $this->response($this->json($result), 200);

                        }
                        if($this->get_request_method() == "POST"){

                        $obj = new Article_db();
                        $author_id= $this->_request['author_id'];
                        $result = $obj->get_author_names($author_id);
                        //var_dump($result);
                        $this->response($this->json($result), 200);
                }else { $this->response('',406);}
                }



                private function get_authors(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $author_id = $this->params['1'];
                        $result = $obj->get_authors($author_id);
                        $this->response($this->json($result), 200);

                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_authors($article_id);
                        $this->response($this->json($result), 200);}
                        else {                          $this->response('',406);}
                }

                private function get_articles_by_author(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $author_id = $this->params['1'];
                        $result = $obj->get_articles_by_author($author_id);
                        $this->response($this->json($result), 200);

                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $author_id= $this->_request['author_id'];
                        $result = $obj->get_articles_by_author($author_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }

                private function get_journal_id(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $article_id = $this->params['1'];
                        $result = $obj->get_journal_id($article_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_journal_id($article_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }
             private function get_journal_by_name(){
                        if($this->get_request_method() == "GET"){
                        $obj = new Article_db();
                        $journal_name = $this->params['1'];
            #echo $journal_name;
                        $result = $obj->get_journal_by_name($journal_name);
                        $this->response($this->json($result), 200);
                        }
                        else {$this->response('',406);}
                }
                private function get_journal_name(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $journal_id = $this->params['1'];
                        $result = $obj->get_journal_name($journal_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $journal_id= $this->_request['journal_id'];
                        $result = $obj->get_journal_name($journal_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }

                private function get_journal(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $article_id = $this->params['1'];
                        $result = $obj->get_journal($article_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_journal($article_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }


                private function get_concepts_by_alternate_id(){
                        if($this->get_request_method() == "GET"){
                        $obj = new Article_db();
                        $alternate_id = $this->params['1'];
                        $result = $obj->get_concepts($alternate_id);
                        $this->response($this->json($result), 200);
                        }
                        

                }

                private function get_tags_id(){
                        if($this->get_request_method() == "GET"){
                        $obj = new Article_db();
                        $article_id = $this->params['1'];
                        $result = $obj->get_tags_id($article_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_tags_id($article_id);
                        $this->response($this->json($result), 200);
                        }else {$this->response('',406);}

                }


                private function get_tag_name(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Article_db();
                        $tags_id = $this->params['1'];
                        $result = $obj->get_tag_name($tags_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Article_db();
                        $tags_id= $this->_request['tags_id'];
                        $result = $obj->get_tag_name($tags_id);
                        $this->response($this->json($result), 200);
                        }else {$this->response('',406);}
                }



                private function get_tags(){
                        if($this->get_request_method() != "POST"){
                                $this->response('',406);
                        }
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_tags($article_id);
                        $this->response($this->json($result), 200);
                }


                private function get_vote(){
                        if($this->get_request_method() != "POST"){
                                $this->response('',406);
                        }
                        $obj = new Article_db();
                        $article_id= $this->_request['article_id'];
                        $result = $obj->get_vote($article_id);
                        $this->response($this->json($result), 200);
                }

                //search methods:

                private function get_articles_search_title(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Search_class();
                        $journal_id = $this->params['1'];
                        $result = $obj->get_articles_search_title($journal_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Search_class();
                        $journal_id= $this->_request['journal_id'];
                        $result = $obj->get_articles_search_title($journal_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }

                private function get_alternate_id_search_title(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Search_class();
                        $journal_id = $this->params['1'];
                        $result = $obj->get_alternate_id_search_title($journal_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Search_class();
                        $journal_id= $this->_request['journal_id'];
                        $result = $obj->get_alternate_id_search_title($journal_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }

                private function get_alternate_id_search_tags(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Search_class();
                        $journal_id = $this->params['1'];
                        $result = $obj->get_alternate_id_search_tags($journal_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Search_class();
                        $journal_id= $this->_request['journal_id'];
                        $result = $obj->get_alternate_id_search_tags($journal_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }

                private function get_articles_search_tags(){
                        if($this->get_request_method() == "GET"){
                                $obj = new Search_class();
                        $journal_id = $this->params['1'];
                        $result = $obj->get_articles_search_tags($journal_id);
                        $this->response($this->json($result), 200);
                        }
                        if($this->get_request_method() == "POST"){
                        $obj = new Search_class();
                        $journal_id= $this->_request['journal_id'];
                        $result = $obj->get_articles_search_tags($journal_id);
                        $this->response($this->json($result), 200);}
                        else {$this->response('',406);}
                }
                /*
                 *      Encode array into JSON
                */
                private function json($data){
                        if(is_array($data)){
                                return json_encode($data);
                        }
                        else return json_encode($data);
                }
        }

        // Initiiate Library

        $api = new API;
        $api->processApi();

?>
