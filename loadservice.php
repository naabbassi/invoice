<?php
require_once 'asset/class/modelslist.php';
$service=new service();
$request=$_REQUEST['op'];
$id=$_REQUEST['id'];
switch ($request) {
	case 'newservice':
		$service->datamembers=array(
			title=>$_POST['title'],
			unit=>$_POST['unit'],
			unitprice=>$_POST['unitprice']
			);
		$service->Save();
		break;
	case 'delete':
		$service->Delete($id);
		echo "Delete Done";
		break;
	case 'update':
		$service->datamembers=array(
			title=>$_POST['title'],
			unit=>$_POST['unit'],
			unitprice=>$_POST['unitprice']
			);
		$service->UpdateByCond("id=".$id);
		echo "Update Done";
		break;
	case 'delete':
		$service->Delete($id);
		echo "Delete";
		break;
	case 'edit': 
	$r=$service->FindByKey($id);
	?>
		<form class="form" action="loadservice.php?op=update&id=<?php echo $id; ?>" id="update">
			<h3>Edit Customer</h3>
			<label>Title : </label><input type="text" name="title" id="phone" value="<?php echo $r->title ?>" required>
			<label> Unit : </label><input type="text" name="unit" id="unit" value="<?php echo $r->unit ?>" required>
			<label> Unit Price : </label><input type="text" name="unitprice" id="unitprice" value="<?php echo $r->unitprice ?>" required>
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
				<td>Unit</td>
				<td>Unit Price</td>
				<td>Operation</td>
			</tr>
		<?php
		$res=$service->All();
		$i=1;
		foreach ($res as $key) {
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$key->title."</td>";
			echo "<td>".$key->unit."</td>";
			echo "<td>".$key->unitprice."</td>";
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