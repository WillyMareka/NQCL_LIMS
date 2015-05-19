<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
         <script src="<?php echo base_url(); ?>javascripts/jqueryFileTree/jqueryFileTree.js?1500" type="text/javascript"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
    </head>
    <body>
        <?php
  // open this directory 
$myDirectory = opendir("excel/");

// get each entry
while($entryName = readdir($myDirectory)) {
	$dirArray[] = $entryName;
}

// close directory
closedir($myDirectory);

//	count elements in array
$indexCount	= count($dirArray);
Print ("$indexCount files<br>\n");

// sort 'em
sort($dirArray);

// print 'em
print("<TABLE border=1 cellpadding=5 cellspacing=0 class=whitelinks>\n");
print("<TR><TH>Filename</TH><th>Filetype</th><th>Filesize</th></TR>\n");
// loop through the array of files and print them all
for($index=0; $index < $indexCount; $index++) {
        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
		print("<TR><TD><a href=\"$dirArray[$index]\">$dirArray[$index]</a></td>");
		print("<td>");
		print(filetype($dirArray[$index]));
		print("</td>");
		print("<td>");
		print(filesize($dirArray[$index]));
		print("</td>");
		print("</TR>\n");
	}
}
print("</TABLE>\n");

        
        
        
        // Create recursive dir iterator which skips dot folders
$dir = new RecursiveDirectoryIterator('excel/',
    FilesystemIterator::SKIP_DOTS);

// Flatten the recursive iterator, folders come before their files
$it  = new RecursiveIteratorIterator($dir,
    RecursiveIteratorIterator::SELF_FIRST);

// Maximum depth is 1 level deeper than the base folder
$it->setMaxDepth(1);

// Basic loop displaying different messages based on file or folder
foreach ($it as $fileinfo) {
    if ($fileinfo->isDir()) {
        printf("Folder - %s\n", $fileinfo->getFilename());
    } elseif ($fileinfo->isFile()) {
        printf("File From %s - %s\n", $it->getSubPath(), $fileinfo->getFilename());
    }
}
    ?>    
    </body>
</html>
