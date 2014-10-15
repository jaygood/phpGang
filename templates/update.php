<?php
if($_POST){
        echo post_to_url("http://localhost/users/".$_POST['id'], $_POST); // add id after last slash which you want to edit.
} else{
UPDATE RECORD.
<br>
<form action="" method="post">
<input type="text" name="id" placeholder="Id to update" /><br>
<input type="text" name="name" placeholder="Name" /><br>
<input type="text" name="email" placeholder="Email" /><br>
<input type="hidden" name="_METHOD" value="PUT" />
<input type="submit" value="U P D A T E" />
</form>
<?php
}
?>
