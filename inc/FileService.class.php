<?php

class FileService implements IFileService  
{
    static function read()
    {
        $fileName = ARTICLE_FILE;
        try {
            //Open a File Handle
            $fh = fopen($fileName,'r');
    
            if (!$fh)   {
                throw new Exception("Could not open $fileName");
            }
            //Read the contents
            $contents = fread($fh,filesize($fileName));
    
            //Close the file Handle
            fclose($fh);
          
            //Check if the contents are empty, if they are then throw an exception
            if(empty($contents))
            {
                throw new Exception("File is empty");
            }
        }
        //Catch the exception
        catch(Exception $ex)
        {
            echo $ex->getMessage();
            //Wirte to the error log
            error_log($ex->getMessage(),0);
        }
        //Return the file contents
        return $contents;

    }

    static function write($contents)
    {
        try {
            //Open the file handle with the write mode
            $fh = fopen(ARTICLE_FILE,'w');
            //Check if the contents are empty, if they are then throw an exception
            if(!$contents)
            {
                throw new Exception("Cannot write. The contents are empty");
            }
            fwrite($fh,$contents);
    
    }
            catch (Exception $ex) {
                echo $ex->getMessage()."<BR>";
                error_log($ex->getMessage()."\n", 0);
            } 

    }

}
?>