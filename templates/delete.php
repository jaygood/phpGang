<?php
if($_POST){
        echo post_to_url("http://localhost/users/".$_POST['id'], $_POST);
} else{
 ?>
DELETE RECORD.
<br>
<form action="" method="post">
<input type="text" name="id" placeholder="Id to delete" /><br>
<input type="hidden" name="_METHOD" value="DELETE" />
<input type="submit" value="D E L E T E" />
</form>
 <?php
}
?>
