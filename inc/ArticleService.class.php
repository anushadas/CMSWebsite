<?php
require_once "inc/Article.class.php";
class ArticleService implements IArticleService
{
    private static $articles = array();
    //self::$articles = self::parse(FileService::read());
    static function insertArticle(Article $newArticle) : bool
    {
        $flag = true;
        if(empty($newArticle))
        {
            $flag = false;
        }
        if($flag)
        {
            array_push(self::$articles,$newArticle);
        }
        return $flag;
    }

    static function getArticle(string $aShortName) : Article
    {
        $searchRes = new Article();
       foreach(self::$articles as $article)
       {
           if($article->getShortname() == $aShortName)
           {
               $searchRes = $article;
           }
       }
       return $searchRes;

    }
    static function getArticles(): array
    {
        return self::$articles;
    }
    static function deleteArticle(string $shortName) : bool
    {
        $flag = false; $pos=-1;
        foreach(self::$articles as $key=>$article)
        {
            if($article->getShortName() == $shortName)
            {
                $flag = true;
                $pos = $key;
            }
        }
        if($flag)
        {
            unset(self::$articles[$pos]);
            self::$articles = array_values(self::$articles);
        }
        return $flag;
    }
    static function updateArticle(Article $updatedArticle) : bool
    {
        $flag = true;
        if(empty($updatedArticle))
        {
            $flag = false;
        }
        else
        {
            foreach(self::$articles as $key=>$article)
            {
                if($updatedArticle->getShortName() == $article->getShortName())
                {
                    $article->setTitle($updatedArticle->getTitle());
                    $article->setSummary($updatedArticle->getSummary());
                    $article->setContent($updatedArticle->getContent());
                    $article->setLastUpdate($updatedArticle->getLastUpdate());
                }
            }
        }
        
        return $flag;
    }
    static function writeArticles() : bool
    {
        $flag = false;
        $fileContents = "shortname|title|summary|content|lastupdate\n";
        foreach(self::$articles as $k=>$article)
        {
            // foreach($article as $key=>$col)
            // {
            //     $line = "";
            //     if($key == count($article)-1)
            //     {
            //         $line +=$col;
            //     }
            //     else
            //     {
            //         $line += $col + "|";
            //     }
            // }
            // $fileContents +=$col;
            // if($k == count($articles)-1)
            // {
            //     $fileContents += "\n";
            // }
            //$line = $article->getShortName()."|".$article->getTitle()."|".$article->getSummary()."|".$article.getContent()."|".$article->getLastUpdate();
            $line = $article->getShortName()."|".$article->getTitle()."|".$article->getSummary()."|".$article->getContent()."|".$article->getLastUpdate();
            $fileContents .=$line;
            if($k < (count(self::$articles)-1))
            {
                $fileContents .= "\n";
            }
        }
        if(!empty($fileContents))
        {
            $flag = true;
            FileService::write($fileContents);
        }
        return $flag;
    }
    static function parse($contents)
    {
        //parse contents from file.
        $articles = array();
        try {
            //Parse the lines
            $lines = explode("\n",$contents);
                //Parse the individual line
                for ($x = 1; $x < count($lines); $x++)    {
    
                    try { 
                        //Add each column of each line to the array
                        $columns = explode("|", $lines[$x]);
                        
                        //Check it has the right count, if not throw an exception
                        if (count($columns) != 5)   {
                            throw new Exception("Problem parsing file on line: ".($x + 1)."<BR>");
                        }
                        //Add the column to the array of each line
                        else
                        {
                            $newArticle = new Article();
                            $newArticle->setShortName($columns[0]);
                            $newArticle->setTitle($columns[1]);
                            $newArticle->setSummary($columns[2]);
                            $newArticle->setContent($columns[3]);
                            $newArticle->setLastUpdate($columns[4]);
                            array_push($articles,$newArticle);
                        }
                    } 
                        catch (Exception $ex) {
                            echo $ex->getMessage();
                            error_log($ex->getMessage(), 0);
                        }
                }
            
            }
        catch (Exception $ex) {
    
            echo $ex->getMessage();
            //Write to the error log
            error_log($ex->getMessage(),0);
    
        }
        //Return the multi-dimensional array
        self::$articles = $articles;
    
    }
}

?>