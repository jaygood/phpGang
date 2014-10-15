<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $this->data['page_title']; ?></title>
</head>
<body>
<?php
foreach ($this->data['data'] as $friend) {
	echo $friend['id'].' - '.$friend['name'].' - '.$friend['job'].'</br />';
}
?>
</body>
</html>
