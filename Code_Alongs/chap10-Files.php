<?php

//create a folder
$folderPath = "c:/php";
if(!File_exists($folderPath)){
    mkdir($folderPath);
};
//open a file
$filePath = $folderPath . "\users.txt";
//relative file paath 
$rel_path = "../Images";
//w means write 
//r means read
//w+ means read and write
//a means append so add to the end of the file
//a+ means append and write
//x means to just create 
$myFile = fopen($filePath, "a+"); // will create file if it doesnt exits
fwrite($myFile, "Jim Johnson \r\n");
fwrite($myFile, "sally sue\r\n");
rewind($myFile); //go to the start of the file
fwrite($myFile, "googly moogly");
rewind($myFile);
while(!feof($myFile)){
    echo fgets($myFile) . "<br>";
}
printf("the size of the file is %s bytes<br>", filesize($filePath));
printf("the name of the file is %s <br>", basename($filePath));
printf("the directory path is %s <br>", dirname($filePath));
printf("the size of the file is %s in kilobytes<br>", round(filesize($rel_path)/1024));
printf("absolute path %s<br>", realpath($rel_path));
printf("Disk Space Remaining %s<br>", round(disk_free_space("c:")/1024));
fclose($myFile);

?>