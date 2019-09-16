<?php
// Forked from https://gist.github.com/1809044
// Available from https://gist.github.com/nichtich/5290675#file-deploy-php
// Use ls command to shell_exec 
// function 
echo exec('whoami');
$output = shell_exec('ls'); 
exec('ls', $output, $return_var);
echo "<pre>$output</pre>"; 
echo "<pre>$return_var</pre>"; 

 $output_including_status = shell_exec("command 2>&1; echo $?");
echo "<pre>$output_including_status</pre>"; 
  
// Display the list of all file 
// and directory 

$TITLE   = 'Git Deployment Hamster';
$VERSION = '0.11';
echo <<<EOT
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>$TITLE</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
  o-o    $TITLE
 /\\"/\   v$VERSION
(`=*=') 
 ^---^`-.
EOT;

    $tmp = shell_exec("cd public_html/abcd; git pull;");
    $tmp = shell_exec("cd public_html/abcd; git pull origin master;");
// Actually run the update
$PWD = "/home/gemacipta/public_html/abcd";
$commands = array(
	'dir',
	'cd public_html/abcd; git pull',
	'cd public_html/abcd; git pull origin master',
	'git pull',
	'git status',
	'git submodule sync',
	'git submodule update',
	'git submodule status',
    'test -e /usr/share/update-notifier/notify-reboot-required && echo "system restart required"',
);
$output = "\n";
$log = "####### ".date('Y-m-d H:i:s'). " #######\n";
foreach($commands AS $command){
    // Run it
    $tmp = shell_exec("$command 2>&1");
    // Output
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
    $log  .= "\$ $command 1: \n". $tmp ."\n";
    $log  .= "\$ $command 2: \n". trim($tmp) ."\n";
}
$log .= "\n";
file_put_contents ('deploy-log.txt',$log,FILE_APPEND);
echo $output; 
?>
</pre>
</body>
</html>
