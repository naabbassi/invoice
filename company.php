<br>
<div id="table"></div>
<div style="clear:both"></div><br>
<div id="notification"></div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#table").load("loadcompany.php?op=table");
		$(".table #edit").live("click",function(){
            var id=$(this).attr("href");
            $("#notification").load("loadcompany.php?op=edit&id=" + id);
            $("#notification").show();
            return false;
        });
    $('#update').live('submit',function(e) {
            $.ajax({
            url:$(this).attr('action'),
            data:$(this).serialize(),
            type:'POST',
            success:function(data){
     		$("#notification").html("<div>Success</div>").show().fadeOut(4000);
     		$("#table").load("loadcompany.php?op=table");
            },
            error:function(data){
            $("#notification").html("<div class='error'>Filed</div>").show().fadeOut(4000);
            }
            });
        e.preventDefault();
        });
	});
</script>
