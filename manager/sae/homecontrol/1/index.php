<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 

<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
<title>Home Control</title>
<?php
    require_once dirname(__FILE__).'/GrandCloudStorage.php';

    $access_key = '2W7F1RBYD9JO5KMB0E5PS7YLX';
    $access_secret = 'NmUwODc5ZjYtNmRiMC00M2FjLWI4OTUtMGU5Y2Y3OGI3N2Vm';
    $host = 'http://storage.grandcloud.cn';

    $client = new GrandCloudStorage($host);
    $client->set_key_secret($access_key, $access_secret);

    $bucket_name = "homecontrol";

    $client->set_bucket($bucket_name);
    try {
           $client->put_object("index1.php", "index.php");
        } catch(Exception $e) {
           $error = $e->getMessage();
           var_dump($error);
        }
?>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
</head>
<body>
	<div>
		<?php echo '<strong>Welcome to HomeControl!</strong>';?>
	</div>
</body>
</html>