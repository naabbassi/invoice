<?php
require_once 'asset/class/modelslist.php';
$customer=new customer();
$request=$_REQUEST['op'];
$id=$_REQUEST['id'];
switch ($request) {
	case 'newcustomer':
		$customer->datamembers=array(
			title=>$_POST['title'],
			phone=>$_POST['phone'],
			adress=>$_POST['adress']
			);
		$customer->Save();
		break;
	case 'delete':
		$customer->Delete($id);
		echo "Delete Done";
		break;
	case 'update':
		$customer->datamembers=array(
			title=>$_POST['title'],
			phone=>$_POST['phone'],
			adress=>$_POST['adress']
			);
		$customer->UpdateByCond("id=".$id);
		echo "Update Done";
		break;
	case 'delete':
		$customer->Delete($id);
		echo "Delete";
		break;
	case 'edit': 
	$r=$customer->FindByKey($id);
	?>
		<form class="form" action="loadcustomer.php?op=update&id=<?php echo $id; ?>" id="update">
			<h3>Edit Customer</h3>
			<label>Title : </label><input type="text" name="title" id="phone" value="<?php echo $r->title ?>" required>
			<label> Phone : </label><input type="text" name="phone" id="phone" value="<?php echo $r->phone ?>" required>
			<label> Adress : </label><input type="text" name="adress" id="adress" value="<?php echo $r->adress ?>" required>
			<div style="clear:both;"></div>
			<input type="submit" value="Update">
		</form>
	<?php
		break;
	case 'table':
		?>
		<table class="table">
			<tr>
				<td>No</td>
				<td>Title</td>
				<td>Phone</td>
				<td>Adress</td>
				<td>Operation</td>
			</tr>
		<?php
		$res=$customer->All();
		$i=1;
		foreach ($res as $key) {
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$key->title."</td>";
			echo "<td>".$key->phone."</td>";
			echo "<td>".$key->adress."</td>";
			echo "<td><a href='".$key->id."' id='edit'>Edit </a> | <a href='".$key->id."' id='delete'>Delete </a></td>";
		}
		?>
		</table>
		<?php
		break;
	default:
		# code...
		break;
}
?>