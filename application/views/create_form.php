<h1> 글쓰기 </h1>
<table class="table table-striped"> 

<form action="create" method="post" enctype="multipart/form-data">
	

	
	<tr>

	<td>	<input type="text" name = "title" class="form-control" placeholder="제목"></td>
	</tr>
	
	
	<tr>
		<td height="300px;"><textarea class="form-control" rows="15" name="contents" placeholder="내용" ></textarea></td>
	</tr>
	
	<tr>

		<td>

		<input type="file" name="userfile" size="20" />
		</td>
	</tr>
	<tr>
		<td>
	
		<input type="submit" value="작성" class="btn btn-default">
		</td>
	</tr>
</form>

</table>