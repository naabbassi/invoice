<form class="form" action="" id="customer">
	<h3>Services</h3>
	<label>Title : </label><input type="text" name="title" id="title" required>
	<label> Unit : </label><input type="text" name="unit" id="unit" required>
	<label> Unit Price : </label><input type="text" name="unitprice" id="unitprice" required>
<div style="clear:both;"></div>
<input type="submit" value="Save">
</form>
<div style="clear:both"></div>
<div id="table"></div>
<div id="notification"></div>
<script type="text/javascript">
	$(document).ready(function() {
        $('#table').load("loadservice.php?op=table");
		$('#customer').live('submit',function(e) {
            $.ajax({
            url:'loadservice.html?op=newservice',
            data:$(this).serialize(),
            type:'POST',
            success:function(data){
              document.getElementById('title').value='' ; 
              document.getElementById('unit').value='' ; 
              document.getElementById('unitprice').value='' ;
             $('#table').load("loadservice.php?op=table");
            },
            error:function(data){
            $("#notif").html("<div class='error'>عملیات ناموفق بود.</div>").show().fadeOut(4000);
            }
            });
        e.preventDefault();
        });
        $('#update').live('submit',function(e) {
            $.ajax({
            url:$(this).attr('action'),
            data:$(this).serialize(),
            type:'POST',
            success:function(data){
             $('#table').load("loadservice.php?op=table");
              $("#notification").fadeOut(2000);
            },
            error:function(data){
            $("#notification").html("<div class='error'>Filed</div>").show().fadeOut(4000);
            }
            });
        e.preventDefault();
        });
         $(".table #delete").live("click",function(){
            var id=$(this).attr("href");
            var r=confirm("Are You Sure To Delete This Record?");
            if (r==true) {
            $("#notification").load("loadservice.php?op=delete&id=" + id);
            $("#notification").fadeOut(4000);
             var td = $(this).parent();
             var tr = td.parent();
             tr.fadeOut(400, function(){
            tr.remove();
            });
        }
            return false;
        });
         $(".table #edit").live("click",function(){
            var id=$(this).attr("href");
            $("#notification").load("loadservice.php?op=edit&id=" + id);
            $("#notification").show();
            return false;
        });
	});
</script>