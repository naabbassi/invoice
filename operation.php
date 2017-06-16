<?php
require_once 'asset/class/modelslist.php';
$rows=new rows();
$invoice=new invoice();
$operation=$_REQUEST['operation'];
$id=$_REQUEST['id'];
switch ($operation) {
	case 'newinvoice':
		$invoice=new invoice();
		$invoice->datamembers=array(
			title=>$_POST['title'],
			cid=>$_POST['cid'],
			date=>$_POST['date'],
			discount=>$_POST['discount'],
			discription=>$_POST['discription']
			);
		$invoice->Save();
		break;
	case 'newrow':
		$rows->datamembers=array(
			iid=>$invoice->maxid(),
			serviceid=>$_POST['serviceid'],
			rno=>$_POST['rno'],
			quntity=>$_POST['quntity'],
			m2=>$_POST['m2']
			);
		$rows->Save();
		echo 'newrow';
		break;
	case 'table':
		$iid=$invoice->maxid();
		$service=new service();
		$res=$rows->FindAll("iid=".$iid);
		?>
		<h3 class="title">Invoice Items</h3>
		<table class="table">
		<tr>
			<td>No</td>
			<td>Content</td>
			<td>R.No</td>
			<td>Quntity</td>
			<td>M2</td>
			<td>U.P</td>
			<td>Total</td>
			<td>Operation</td>
		</tr>
		<?php
		$i=1;
		$tot=0;
			foreach ($res as $key) {
				$r=$service->FindByKey($key->serviceid);
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$r->title."</td>";
				echo "<td>".$key->rno."</td>";
				echo "<td>".number_format($key->quntity)."</td>";
				echo "<td>".number_format($key->m2)."</td>";
				echo "<td>".number_format($r->unitprice)." $</td>";
				$Total=($key->quntity * $key->m2) * $r->unitprice;
				echo "<td>".number_format($Total)." $</td>";
				echo "<td><a href='".$key->id."' id='delete'>Delete</a></td>";
				echo "</tr>";
				$i++;
				$tot=$tot + $Total;
			}
		 ?>
	</table>
	<?php
	echo "Invoice Total : ".number_format($tot)." $";
	echo "<div style='clear:both'></div><h3></h3>";
	echo "<br><a href='invoiceprint.html?id=".$iid."' class='btn' id='finish'>Finish & Print</a>";
	break;
	case 'deleterow':
		$id=$_REQUEST['id'];
		$rows->Delete($id);
		break;
	default:
		echo 'null';
		break;
}
?>