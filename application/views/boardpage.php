<h1>게시글 상세보기</h1>
<div class="table-responsive">
<table class="table table-striped"> 



	<tr>

		<td colspan="2" class="col-md-8">
		<?php echo $list[0]['title']; ?> 
		</td>
	</tr>
	<tr>

		<td align="left">
		작성자 : <?php echo $list[0]['nickname'] ?>
		</td>
		<td align="right" >
		<?php echo $list[0]['date']; ?>
		</td>

	
	</tr>
	
	
	<tr>
		<td colspan="2" height="400px">
		<?php echo nl2br($list[0]['contents']); ?>
		<br>
		<?php if($list[0]['user_file'] == 1) { ?>
		<img src="http://localhost/upload/ <?php echo $list[0]['num'] ?>/<?php echo $list[0]['filename']; ?>">
		<?php } ?>
		</td>
	</tr>
		
		
	

</table>
</div>

<?php $boardnum = $this->uri->segment(3);
?>


<form action="http://localhost/index.php/user_c/update" method="post">

	<input type="hidden" value="<?php echo $boardnum; ?>" name="boardnum">
	<input type="submit" class="btn btn-default" value="수정">
</form>

<button id ="update-btn">
수정</button> 

<form action="http://localhost/index.php/user_c/deleteboard" method="post">

	<input type="hidden" value="<?php echo $boardnum; ?>" name="boardnum">
	<input type="submit" class="btn btn-default" value="삭제">
</form>
</div>
<script>
$( "#update-btn" ).click(function() {
  
  	var num = <?php echo $boardnum; ?>;

    $.ajax({
    	type:'post',
    	url:'http://localhost/index.php/user_c/update',
    	dataType:'json',
    	data:{boardnum : num} ,
    	success:function(data){
    		if(data==1)
    		location.href = "http://localhost/index.php/user_c/update";
    	},
    	error : function(error) {
       		 alert("Error!");
   		 },


    });

  });
</script>
