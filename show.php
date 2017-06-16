<?php
if (isset($_REQUEST['id'])) { 
	$invoice=new invoice();
	$customer=new customer();
	$service=new service();
	$row=new rows();
	$company=new company();
	$id=$_REQUEST['id'];
	?>
	<div class="invoice">
<?php		$in=$invoice->FindByKey($id);
		$cu=$customer->FindByKey($in->cid);
		$co=$company->maxid();
		$co=$company->FindByKey($co);
		?>
		<img src="asset/img/logo.png" class="logo">
		<div class='detail'>
		<p>Date : <?php echo $in->date; ?></p>
		<p class='red'>Invoice No : <?php echo $in->id; ?></p>
		</div>
		<div style='clear:both'></div>
		
		<?php 
		echo "<div class='customer'>";
		echo "<h3>Invoice</h3>";
		echo "<p>".$co->title."</p>";
		echo "<p>".$co->adress."</p>";
		echo "<p>".$co->phone."</p>";
		echo "</div>";
		echo "<div style='clear:both'></div>";
		echo "<div class='customer'>";
		echo "<p class='invoicetitle'>Customer :</p>";
		echo "<p>".$cu->title."</p>";
		echo "<p>".$cu->adress."</p>";
		echo "<p>".$cu->phone."</p>";
		echo "</div>";
		echo "<div style='clear:both'></div>";
		?>
		<br>
		<table class="rows">
			<tr>
				<td>No</td>
				<td>Description</td>
				<td>R.No</td>
				<td>Quntity</td>
				<td>M2</td>
				<td>Unit Price</td>
				<td>Total</td>
			</tr>
			<?php
			$i=1;
			$total=0;
			$res=$row->Select("iid=".$id,"*","","","");
			foreach ($res as $key) {
				$ser=$service->FindByKey($key->serviceid);
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$ser->title."</td>";
				echo "<td>".$key->rno."</td>";
				echo "<td>".$key->quntity."</td>";
				echo "<td>".$key->m2."</td>";
				echo "<td>".$ser->unitprice."</td>";
				$t=($key->m2 * $key->quntity) * $ser->unitprice;
				echo "<td>".$t." $</td>";
				echo "</tr>";
				$i++;
				$total=$total + $t;
			}
			?>
			<tr>
				<td class="bold" colspan="6">Invoice Total : </td>
				<td class="bold"><?php echo number_format($total); ?> $</td>
			</tr>
		</table>
		<p class="invoicesign">Manager Signature :</p>
	</div>
<?php }
?>