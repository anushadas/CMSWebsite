<?php

//This Class is to construct our html page.
class Page  {

  //We store the title in an attribute
  public $title = "Please set the title";
  public $summary="";
  //Constructor
  function __construct($newTitle,$newsummary)  
  {
    $this->title = $newTitle;
    $this->summary=$newsummary;
  }


  //This function displays the html header
   function header()   { ?>
      <!doctype html>
      <html lang="en">
      
      <head>
      <title><?php echo htmlspecialchars($this->title)?> </title>
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
      <link href="style.css" rel="stylesheet" type="text/css" />
      <style>
      textarea { vertical-align: top; }
      h1#yo{
	font-size: 1.4em;
	color: rgb(244, 217, 66);
    }
      </style>
      </head>
      
      <body>

      <p class="colorline"></p>
      <div id="contain">
      <div id="header"><div>
        <h1><?php echo htmlspecialchars($this->title)?></h1>
        <h3><?php echo htmlspecialchars($this->summary)?></h3>
      </div></div>
      <nav>
      <p><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=home'?>">Home</a></p>
      </nav>
   
  <?php }

  function editArticle($article,$key)
  {?>
    <h1 id="yo"><?php echo "Edit Article"?></h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" style="vertical-align: middle;">
    <input type="hidden" name="articleId" value="<?php echo $key ?>"/>
    <input type="hidden" name="UpdatedDate" value="<?php echo date("D M d, Y g:ia", time());?>"/>
           <ul>
           <li>
               <label for="short">Article ShortName</label>
               <input type="text" name="short" id="short" placeholder="ShortName of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $article->getShortName() )?>"  />
             </li>
   
             <li>
               <label for="title">Article Title</label>
               <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $article->getTitle() )?>" />
             </li>
   
             <li>
               <label for="summary">Article Summary</label>
               <textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;width: 40em"><?php echo htmlspecialchars( $article->getSummary() )?></textarea>
             </li>
   
             <li>
               <label for="content">Article Content</label>
               <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="width: 42em;height: 15em;"><?php echo htmlspecialchars( $article->getContent() )?></textarea>
             </li>
             </ul>
   
           <div class="buttons" >
             <input type="submit" name="saveChanges" value="Save Changes" />
             <input type="submit" formnovalidate name="cancel" value="Cancel" />
           </div>
   
   </form>
   <?php  }


    function insertArticlep()
    {?>
      <h1 id="yo"><?php echo htmlspecialchars($this->title)?></h1>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" style="vertical-align: middle;">
    <input type="hidden" name="UpdatedDate" value="<?php echo date("D M d, Y g:ia", time());?>"/>
           <ul>
             <li>
               <label for="shortName">Article ShortName</label>
               <input type="text" name="shortName" id="shortName" placeholder="ShortName of the article" required autofocus maxlength="255"  />
             </li>
            
             <li>
               <label for="title">Article Title</label>
               <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255"  />
             </li>
   
             <li>
               <label for="summary">Article Summary</label>
               <textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;width: 40em"></textarea>
             </li>
   
             <li>
               <label for="content">Article Content</label>
               <textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="width: 42em;height: 15em;"></textarea>
             </li>
             </ul>
   
           <div class="buttons" >
             <input type="submit" name="saveChanges" value="Save Changes" />
             <input type="submit" formnovalidate name="cancel" value="Cancel" />
           </div>
   
   </form>
   <?php
    }




  function showArticles($articles)
  {?>
      <div id="left">
      <h1><?php echo htmlspecialchars($this->title)?></h1>
        <TABLE style="text-align:center">
      <?php
                  echo '<TR>';
                  echo '<TH>Article ShortName</TH>';
                  echo '<TH>Title</TH>';
                  echo '<TH>Edit</TH>';
                  echo '<TH>Delete</TH>';
                  echo '</TR>';
     // Iterate through the articles and print it out
      foreach ($articles as $key=>$article)   {
        if($article->getShortName()=='home' || $article->getShortName()=='about')
        {
        echo '<TR>
          <TD>'.$article->getShortName().'</TD>
          <TD>'.$article->getTitle().'</TD>
          <TD>'.'Edit'.'</TD>
          <TD>'.'Delete'.'</TD>
          </TR>'."\n";
        }
        else
        {
          echo '<TR>
          <TD>'.$article->getShortName().'</TD>
          <TD>'.$article->getTitle().'</TD>
          <TD>'.'<a href="?action=update&shortName='.$article->getShortName().'">Edit</a>'.'</TD>
          <TD>'.'<a href="?action=delete&shortName='.$article->getShortName().'">Delete</a>'.'</TD>
          </TR>'."\n"; 
        }
      }
    
      ?>
      </TABLE>
   
   
    </div>
    <div id="right">
    <div class="block"> 
    <strong>Admin Menu</strong>
    <p>Please pick the admin option below for a new article:</p>
    <ul>
    <li><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=insert'; ?>">New Article</a></li>
    <li><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=list'; ?>">List Article</a></li>
    </ul>
    </div>
    </div>
  
  <?php }
  //This function lists the articles
function listArticles($result)
{?>
  <div id="left">
      <h1><?php echo htmlspecialchars($this->title)?></h1>
    <OL>
    <?php 
    foreach($result as $article)
    {?>
      <li><?php echo $article->getTitle(); ?></li>
    <?php
    }
    ?>
    </OL>
    </div>
    <div id="right">
    <div class="block"> 
    <strong>Admin Menu</strong>
    <p>Please pick the admin option below for a new article:</p>
    <ul>
    <li><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=insert'; ?>">New Article</a></li>
    <li><a href="<?php echo $_SERVER["PHP_SELF"]. '?action=list'; ?>">List Article</a></li>
    </ul>
    </div>
    </div>

<?php
}
  //This function displays the html footer
  static function  footer()  { ?>
      <div id="footer">
        <h4>This assignment was submitted by Anusha Das(300283182) and Loveleen Kaur(300284947)</h4>
        <p><a href="http://www.taologic.com">Website Designed by TaoLogic</a> - <a href="http://www.oswd.org/">OSWD</a> - <a href="http://www.openwebdesign.org">OWD</a> - <a href="http://validator.w3.org/check?uri=http%3A//taologic.com/templates/simple_elegance/index.html">XHTML</a> - <a href="http://jigsaw.w3.org/css-validator/validator?uri=http://taologic.com/templates/simple_elegance/index.html">CSS</a> </p>
        </div>
      </div>
      </body>
      </html>
  <?php }

    }

?>
