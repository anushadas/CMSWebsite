<div id="right">
<div class="block"> 
<strong>Navigation</strong>
    <ul>
    <?php foreach($navBarArticles as $article)
    {
      if($article->getShortName()=="home") 
      {?> 
      <li><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=home'; ?>"><?php echo htmlspecialchars($article->getTitle())?></a></li>
    <?php }
    else
    {?>
        <li><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=view&shortName='.$article->getShortName().''; ?>"><?php echo htmlspecialchars($article->getTitle())?></a></li>
    <?php }
    }
    ?>
      
      </ul>
</div>
</div>