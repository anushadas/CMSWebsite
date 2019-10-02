<?php

//Reference https://www.elated.com/cms-in-an-afternoon-php-mysql/#step5

//Require the files
require_once("inc/IArticle.class.php");
require_once("inc/IArticleService.class.php");
require_once("inc/IFileService.class.php");
require_once("inc/Fileservice.class.php");
require_once("inc/Article.class.php");
require_once("inc/ArticleService.class.php");
require_once("inc/config.inc.php");

ArticleService::parse(FileService::read());

//If there was an action, write it to $action
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

//Run a case statement to see what was requested.
switch($action)
{
    //do the appropriate function for the respective action
    //view the Article
    case "view":
    viewArticle();
    break;
    //Show the homepage
    case "homepage":
    homepage();
    break;

    default:
    homepage();
    break;
}

//View Article Function
function viewArticle()  {

    //See if the articleShortName was passed in
    if(isset($_GET["shortName"]) || $_GET["shortName"])
    {
        //Always get the articles for the navigation pane
        $navBarArticles = ArticleService::getArticles();
        //Include the viewArticle Page
        $result = ArticleService::getArticle($_GET["shortName"]);
        include TEMPLATE_PATH.'/viewArticle.php';
    }
    //Otherwise render the home page
    else {
        //Otherwise just call the homepage function
        homepage();
    }
    
}


//This function shows the homepage
function homepage() {
    
    //Always get the articles for the navigation pane
    $navBarArticles = ArticleService::getArticles();
    //Get the homepage article from ArticleService
    $result = ArticleService::getArticle("home");
    
    //Include the viewArticle template
    include TEMPLATE_PATH.'/viewArticle.php';
}

