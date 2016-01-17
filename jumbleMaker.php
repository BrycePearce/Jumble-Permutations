<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://w...content-available-to-author-only...3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://w...content-available-to-author-only...3.org/1999/xhtml">
<head>
<title>Jumble Maker</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
<pre>
<?php

 define("NAME", "Bryce Pearce");
 define("DESCRIPTION", "Day Number");
 
 /* ------------------- Function: printHeader ----------- */
 function printHeader()
 {
 static $sent = 0;
 
 if (!$sent)
 {
 $sent = 1;
 }
 }
 
 /* -------------------- Function: writeBeginningHTML ---- */
 function writeBeginningHTML($heading)
 {
 printHeader();
 echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\""
 . " \"http://w...content-available-to-author-only...3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">"
 . "<html xmlns=\"http://w...content-available-to-author-only...3.org/1999/xhtml\">"
 . "<head>"
 . "<title>" . NAME
 . "</title>"
 . "</head>"
 . "<body>"
 . "<h1>" . $heading . " </h1>\n";
 }
 
  /* -------------------- Function: writeAddress ---------- */
 function writeAddress()
 {
echo "<HR />"
 . "<address>"
 . "Time of Request: " . date("D j M Y h:i:s A") . "\n"
 . "<a href=\"http://csnew.angelo.edu/~bpearce\">Bryce Pearce</a><br />"
 . "<a href=\"mailto:bpearce@angelo.edu\">bpearce@angelo.edu</a><br />"
 . "<br />\n"
 . "</address>\n"
 . "</body>\n"
 . "</html>\n";
 }
 

 
 /* ------------------- Function: errorMsg -------------- */
 function errorMsg($msg)
 {
 printHeader();
 writeBeginningHTML(" Jumble Word Solver Error");
 
 echo "Your form results could not be processed because ". $msg ;
 
echo "<HR />"
 . "<address>"
 . "Time of Request: " . date("D j M Y h:i:s A")
 . "\n"
 . "<a href=\"http://csnew.angelo.edu/~bpearce\">Bryce Pearce</a><br />"
 . "<a href=\"mailto:bpearce@angelo.edu\">bpearce@angelo.edu</a><br />"
 . "<br />\n"
 . "</address>\n"
 . "</body>\n"
 . "</html>\n";
 exit(1);
 }
 
 function permute($str) 
{
    /* If we only have a single character, return it */
    if (strlen($str) < 2) 
	{
        return array($str);
    }
 
    /* Initialize the return value */
    $permutations = array();
 
    /* Copy the string except for the first character */
    $tail = substr($str, 1);
 
    /* Loop through the permutations of the substring created above */
    foreach (permute($tail) as $permutation) 
	{
        /* Get the length of the current permutation */
        $length = strlen($permutation);
 
        /* Loop through the permutation and insert the first character of the original
        string between the two parts and store it in the result array */
        for ($i = 0; $i <= $length; $i++) 
		{
            $permutations[] = substr($permutation, 0, $i) . $str[0] . substr($permutation, $i);
        }
    }
 
    /* Return the result */
    return $permutations;
}
 
 printHeader();
 
 
  
$str = $_SERVER['QUERY_STRING'];

//checks for word=, before it trims
if (!preg_match('/word=/', $str)) 
{
	errorMsg("variable word is missing.");
	exit;
}

//set $str to be trimmed and continue
$str = ltrim($str,"word=");

//check for errrrrrrros

//if not enough or too many numbers
   if(strlen($str) < 4 || strlen($str) > 7 || $str == "")
  {
	  //if data after word= is empty
	if($str == "")
	{
	errorMsg("variable word is empty.");
	exit;
	}
	 errorMsg("words must be at least four and at most seven letters long.<br />\n");
	exit;
  }

 //check for non alphabetic characters
else if (!preg_match('/^[A-z]+$/', $str))
{
	errorMsg("words must be only letters.");
	exit;
}



 
 
 
//unJumbler, if no errors occured

writeBeginningHTML(NAME . " - " . COURSE . " - Lab "  . LAB_NO . " Jumble Word Solver Results");
$word = strtoupper($str);
$perms = permute($word);

$data = file_get_contents("/usr/dict/words");  
$data = strtoupper($data);
$lines = explode(PHP_EOL, $data); 
$matches = array_intersect($perms, $lines);

$word = strtoupper($str);
$matches = array_unique($matches);
$count = count($matches);

$test=count($matches);

if($test == 1 || $test == 0)
{
	if($test == 0)
	{
	echo "For the Jumble word $str, no solutions were found.<br />\n";
	writeAddress();
	exit;
	}
	else
	{
echo "For the Jumble word $str, 1 solution was found.<br />";
echo $unJumble;
writeAddress();
 exit;
	}
}

echo "For the Jumble word <b>$word</b>, $count solutions were found.\n\n";
 
 

 $i = 0;
echo "<b>";
foreach ($matches as $key => $word) 
{
    $i++;
    echo "$i.  $word\n";
}
echo "</b>";
echo "<br />\n";



echo $unJumble;

//footer
writeAddress();

?>
</pre>
</p>
</body>
</html>
