<?php
$customer=new customer();
$invoice=new invoice();
$service=new service();
$rows=new rows();
		$iid=$invoice->maxid();
		$res=$invoice->All();
		?>
		<br>
		<h3 class="title">Invoices List</h3>
		<table class="table">
		<tr>
			<td>No</td>
			<td>Invoice Title</td>
			<td>Customer</td>
			<td>Date</td>
			<td>Discount</td>
			<td>Discription</td>
			<td>Total</td>
			<td>Operation</td>
		</tr>
		<?php
		$i=1;
			foreach ($res as $key) {
				$c=$customer->FindByKey($key->cid);
				$irows=$rows->Select("iid=".$key->id ,"*","id DESC","","");
				$total=0;
				foreach ($irows as $item) {
					$s=$service->FindByKey($item->serviceid);
					$unitprice=$s->unitprice;
					$t=($item->quntity * $item->m2) * $unitprice;
					$total=$total + $t;
				}
				echo "<tr>";
				echo "<td>".$i."</td>";
				echo "<td>".$key->title."</td>";
				echo "<td>".$c->title."</td>";
				echo "<td>".$key->date."</td>";
				echo "<td>".number_format($key->discount)." $</td>";
				echo "<td>".$key->discription."</td>";
				echo "<td>".number_format($total)." $</td>";
				echo "<td><a href='show.html?id=".$key->id."' id='show'>Show</a></td>";
				echo "</tr>";
				$i++;
			}
		 ?>
	</table>