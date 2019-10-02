<?php

//require files
require_once("inc/IArticle.class.php");
require_once("inc/IArticleService.class.php");
require_once("inc/IFileService.class.php");
require_once("inc/Fileservice.class.php");
require_once("inc/Article.class.php");
require_once("inc/ArticleService.class.php");
require_once("inc/config.inc.php");
require_once("templates/admin/Page.class.php");

ArticleService::parse(FileService::read());

//set action
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
if(isset( $_GET['action'] ))
{
switch ( $action ) {
  case 'insert':
    insertArticle();
  break;
  case 'update':
    updateArticle();
    break;
  case 'delete':
    deleteArticle();
  break;
  case 'home':
    homepage();
  break;
  case 'list':
    listArticles();
  break;
  default:
    homepage();
}
}
else if(isset($_POST['articleId']))
{
  if ( isset( $_POST['saveChanges'] ) ) 
  {
    // User has posted the article edit form: save the article changes
    editArticle();
  }
  elseif ( isset( $_POST['cancel'] ) ) 
  {
    // User has cancelled their edits: return to the article list
    homepage();
  }
}
else if(isset($_POST['shortName']))
{
  if ( isset( $_POST['saveChanges'] ) ) 
  {
    // User has posted the article 
    insertArticletoFile();
  }
  elseif ( isset( $_POST['cancel'] ) ) 
  {
    // User has cancelled their inserting a new article
    homepage();
  }
}
else{
  homepage();
}

function insertArticle()
{
  $page=new Page("Insert Article","Write your creative thoughts here");
  $page->header();
  $page->insertArticlep();
  $page->footer();
}

function insertArticletoFile()
{
 $article=new Article();
 $article->setShortName($_POST['shortName']);
 $article->setTitle($_POST['title']);
 $article->setLastUpdate("Last Updated at ".$_POST['UpdatedDate']);
 $article->setSummary($_POST['summary']);
 $article->setContent($_POST['content']);
 ArticleService::insertArticle($article);
 ArticleService::writeArticles();
 homepage();
}


function editArticle() 
{
  $article = ArticleService::getArticle($_POST['articleId']);
  $article->setTitle($_POST['title']);
  $article->setLastUpdate("Last Updated at ".$_POST['UpdatedDate']);
  $article->setSummary($_POST['summary']);
  $article->setContent($_POST['content']);
  $article->setShortName($_POST['short']);
  ArticleService::updateArticle($article);
  ArticleService::writeArticles();
  homepage();
}


function updateArticle()
{
  $article = ArticleService::getArticle($_GET['shortName']);
  $page=new Page($article->getTitle(),$article->getSummary());
  $page->header();
  $page->editArticle($article,$_GET['shortName']);
  $page->footer();
}


function deleteArticle()
{
  ArticleService::deleteArticle($_GET['shortName']);
  ArticleService::writeArticles();
  homepage();
}

function listArticles()
{
  $result = ArticleService::getArticles();
  $page = new Page("List Articles","This article displays all articles in this CMS");
  $page->header();
  $page->listArticles($result);
  $page->footer();
}

function homepage()
{
  $articles = ArticleService::getArticles();
  $page=new Page("Admin Page - Articles","A page for editing articles");
  $page->header();
  $page->showArticles($articles);
  $page->footer();
}
?>
