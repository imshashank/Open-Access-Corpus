
<div id="content" class="col-xs-12 col-sm-10">
	<br>
	<div class="col-md-1" style="width: 29px;">
		<?php
		$article_id=$article['article_id'];
	$vote_link= 'http://localhost/oclc/OAJ/web_end/get_vote.php?article_id='.$article_id.'';


#$variablee = fopen($vote_link, "rb");  
#$votes_count =stream_get_contents($variablee); 
 
 $votes_count ='0'; 
	echo '<td><div class="vote_up fa fa-arrow-up" value="up">
<span class="article_id" value="'.$article_id.'" ></span>
<span class="user_id" value="'.$loggedInUser->user_id.'"></span>
</div>
<div class=".votes_count" style="font-size: 24px;" id= "vote_article_'.$article_id.'" >'.$votes_count.'</div>
<div class="vote_down fa fa-arrow-down" value="down">
<span class="article_id" value="'.$article_id.'"></span>
<span class="user_id" value="'.$loggedInUser->user_id.'"></span>
</div></td>';
?></div>
<div class="col-md-10"><?php echo "<a href=".$article['url']."><h2>". $article['title']."</a></h2>";?>	<br>
</div>
<div class="col-md-10">
<ul class="list-inline">
    <li><b>Article Id :</b> <?php echo $article['article_id']; ?></li>
    <li> <b> Alternate Id : </b><?php echo $article['alternate_id']; ?></li>
    <li> <b> DOI : </b><?php echo $article['doi']; ?></li>
	<li><b> Language : </b><?php echo $article['language']; ?></li>
    <li><b> Year : </b><?php echo $article['year']; ?></li>
    <li><b> Page : </b><?php echo $article['page']; ?></li>
    <li><b> Published : </b><?php if ($article['is_published'] == 1) {echo "True";} else echo "False"; ?></li>

</ul> 
</div>
<div class="col-md-10" ><strong> Journal : </strong><?php echo $article['journal'] ;?><br>	</div>
<div class="col-md-10" style="margin-top: 10px;"><strong> Publisher : </strong><?php echo $article['publisher'] ;?><br>	</div>



<div class="col-xs-8 col-sm-4 col-md-10" style="margin-top: 10px;"><ul class="list-inline"><strong>Authors: </strong>

	<?php 
	//var_dump($article);
	//var_dump($article['author_ids']);
		for ($i=0;$i < count($article['authors']);$i++){
			echo "<li><a href='".$host."author.php?author_id=".$article['author_ids'][$i]."'> ".$article['authors'][$i]."</a></li>";

		}
	//foreach ($article['authors'] as $x ) {echo "<li>". $x."</li>";} ?></ul></div>

<div class="col-xs-8 col-sm-4 col-md-12"><ul class="list-inline"><strong>Tags </strong><?php foreach ($article['tags'] as $x ) {echo "<li>". $x."</li>";} ?></ul></div>
<div class="col-md-10" ><strong> URL : </strong><?php echo "<a href='".$article['url']."'>".$article['url'] ;?></a><br>	</div>

<div class="row show-grid">
		
<div class="col-md-10" style="margin: 7px;"><?php echo "<p>". $article['abstract']."</p>";?></div>
</div>


</div>