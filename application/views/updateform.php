<h1> 수정하기 </h1>
<table class="table table-striped"> 
<form action="updatecomplete" method="post" enctype="multipart/form-data">
	<tr>

		<td>	
		<input type="text" class="form-control" placeholder="제목" name = "title" value = "<?php echo $list[0]['title'] ; ?>">
		</td>
	</tr>
	<tr>
		<td height="300px;"><textarea class="form-control" rows="15" name="contents" placeholder="내용" ><?php echo $list[0]['contents']; ?></textarea></td>
	</tr>
	<tr>
		<td>
		<input type="file" name="userfile" size="20" />
		</td>
	<tr>
		<td>
		<input type="hidden" value="<?php echo $list[0]['num']; ?>" name="num">
		<input type="submit" value="수정" class="btn btn-default">
		</td>
	</tr>
</form>
</table>
