<?php

//References: https://www.elated.com/cms-in-an-afternoon-php-mysql/#step3

class Article implements IArticle
{
    private $shortName = "";
    private $title = "";
    private $publishDate = "";
    private $summary = "";
    private $content = "";

    function getShortName(): string
    {
        return $this->shortName;
    }
    function setShortName(string $newShortName)
    {
        $this->shortName = $newShortName;
    }
    function getLastUpdate(): string
    {
        return $this->publishDate;
    }
    function setLastUpdate(string $pDate)
    {
        $this->publishDate = $pDate;
    }
    function setTitle(string $title)
    {
        $this->title = $title;
    }
    function getTitle(): string
    {
        return $this->title;
    }
    function setSummary(string $summary)
    {
        $this->summary = $summary;
    }
    function getSummary(): string
    {
        return $this->summary;
    }
    function getContent(): string
    {
        return $this->content;
    }
    function setContent(string $content)
    {
        $this->content = $content;
    }
}

?>