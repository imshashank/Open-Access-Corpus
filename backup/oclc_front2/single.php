
<div id="content" class="col-xs-12 col-sm-10">
	<br>
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