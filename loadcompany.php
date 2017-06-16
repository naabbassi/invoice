<?php
	require_once 'asset/class/modelslist.php';
	$company=new company();
	$request=$_REQUEST['op'];
	$id=$_REQUEST['id'];

	switch ($request) {
		case 'table':
			$res=$company->All();
				?>
				<table class="table">
					<tr>
						<td>Title</td>
						<td>Phone</td>
						<td>Adress</td>
						<td>Operation</td>
					</tr>
				<?php
				$res=$company->All();
				foreach ($res as $key) {
					echo "<tr>";
					echo "<td>".$key->title."</td>";
					echo "<td>".$key->phone."</td>";
					echo "<td>".$key->adress."</td>";
					echo "<td><a href='".$key->id."' id='edit'>Edit </a></td>";
				}
				?>
				</table>
				<?php
				break;
		case 'update':
		$id=$_REQUEST['id'];
				$company->datamembers= array(
					title=>$_POST['title'],
					phone=>$_POST['phone'],
					adress=>$_POST['adress']
					);
				$company->UpdateByCond("id=".$id);
		case 'edit':
				$r=$company->FindByKey($id);
				?>
				<form class="form" action="company.php?op=update&id=<?php echo $r->id; ?>" id="update">
				<h3>Edit Customer</h3>
				<label>Title : </label><input type="text" name="title" id="title" value="<?php echo $r->title ?>" required>
				<label> Phone : </label><input type="text" name="phone" id="phone" value="<?php echo $r->phone ?>" required>
				<label> Adress : </label><input type="text" name="adress" id="adress" value="<?php echo $r->adress ?>" required>
				<div style="clear:both;"></div>
				<input type="submit" value="Update">
			</form>
				<?php
				break;
			default:
				# code...
				break;
	}
	?>