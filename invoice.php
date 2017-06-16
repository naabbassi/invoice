<?php
$customer= new customer();
$invoice = new invoice();
$service = new service();
?>
<form class="form" id="invoice" action="operation.php?operation=newinvoice">
    <h3>Invoice Registeration</h3>
<label>Title : </label><input type="text" name="title" value="<?php echo $invoice->maxid(); ?>">
<label>Customer : </label>
<select name="cid">
<?php
    $res=$customer->all();
    foreach ($res as $key) {
        echo "<option value='".$key->id."'>".$key->title."</option>";
    }
?>
</select>
<label>Date : </label><input type="text" name="date" value="<?php echo date('Y/m/d'); ?>">
<div style="clear:both;"></div>
<label>Discount : </label><input type="text" name="discount" value="0">
<label>Discription : </label><textarea name="discription" row="4" cols="44"></textarea>
<div style="clear:both;"></div>
<input type="submit" value="Add Invoice" class="addinvoice">
</form>
<div id="detail">
<form class="form" action="" id="row">
    <h3>Invoice Item Registeration</h3>
    <label>Service : </label>
    <select name="serviceid" required>
<?php
    $res=$service->all();
    foreach ($res as $key) {
        echo "<option value='".$key->id."'>".$key->title."</option>";
    }
?>
</select>
<label> Recipt No : </label><input type="number" name="rno" id="rno" required>
<label> Quntity : </label><input type="number" name="quntity" id="quntity" required>
<label> M2 : </label><input type="number" name="m2" id="m2" required>
<div style="clear:both;"></div>
<input type="submit" value="Add Item To Invoice">
</form>
</div>
<div style="clear:both;"></div>
<div id="table"></div>
<div id="notif"></div>
<script type="text/javascript">
$(document).ready(function() {  
    $('#detail').hide();
   
    var invoiceid = 0;
        $('#invoice').live('submit',function(e) {
            $.ajax({
            url:'operation.html?operation=newinvoice',
            data:$(this).serialize(),
            type:'POST',
            success:function(data){
            $('#invoice').fadeOut(1000);
            $('#detail').fadeIn(1000);
            },
            error:function(data){
            $("#notif").html("<div class='error'>عملیات ناموفق بود.</div>").show().fadeOut(4000);
            }
            });
        e.preventDefault();
        });
         $('#row').live('submit',function(e) {
            $.ajax({
            url:"operation.html?operation=newrow",
            data:$(this).serialize(),
            type:'POST',
            success:function(data){
            console.log(data);
              $("#table").load("operation.php?operation=table");
              document.getElementById('rno').value='' ; 
              document.getElementById('quntity').value='' ; 
              document.getElementById('m2').value='' ; 
            },
            error:function(data){
            $("#notif").html("<div class='error'>عملیات ناموفق بود.</div>").show().fadeOut(4000);
            }
            });
        e.preventDefault();
        });
                $(".table #delete").live("click",function(){
            var id=$(this).attr("href");
            $("#notif").load("operation.php?operation=deleterow&id=" + id);
             var td = $(this).parent();
             var tr = td.parent();
             tr.fadeOut(400, function(){
            tr.remove();
            });
            return false;
        });
    });
</script>