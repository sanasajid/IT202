
<form name="searchForm" method="POST">
<input name="questionSearch" placeholder="Type of question"/>
<select name="category">
<option value="">Select one</option>

<?php foreach($result as $cat):?>
<option value="<?php echo $cat;?>">
<?php echo $cat;?>
</option>
<?php endforeach;?>

</select>

<input type="submit" name="search"/>
</form>

<?php
if(isset($_POST['search'])){
	$q = $_POST['questionSearch'];
	$cat = $_POST['category'];
	//db stuff here
	//very simple sample query
	//check to see if you want OR or AND
	"SELECT * FROM Questions where question_text like %:q% OR category = :category";
	$param = Array(":q" => $q, ":category"=>$cat);
	//execute
	$results = $stmt->execute($param);
	//TODO loop over results
}
?>


?>