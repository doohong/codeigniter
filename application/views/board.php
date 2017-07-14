

<table  class="table table-hover">
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>작성자</th>
			<th>작성 시간</th>
		</tr
<?php
foreach($list as $val)
{
?>
	
		<tr>
			<td> 
			<?php echo $val['num']; ?>
			 </td>
			<td width="200px"> 
			<a href="/index.php/user_c/board/<?php echo $val['num'];?>"> <?php echo $val['title']; ?> </a> 
			</td>
			<td>
			<?php echo $val['nickname']; ?>
			</td>
			<td>
			<?php echo $val['date']; ?>
			</td>
		</tr>
	<?php
}; ?>
            <tr>
            
                <td align="center" colspan="4">
                <h3>
                <?php echo $pagination; ?>
                </h3>
                </td>	

            </tr>
            <tr>
            
                <td align="center" colspan="4">
                <form action="http://localhost/index.php/user_c/search_c" method="get" class="form-inline">
                	<select name="search" class="form-control">
                		<option value="title">제목</option>
                		<option value="contents">내용</option>
                		<option value="title_contents">제목+내용</option>
                		<option value="nickname">글쓴이</option>
                	</select>
                	<input type="text" name="searchcontents" placeholder="입력하세요" class="form-control">
                	<input type="checkbox" name="file_existence" value="1" class="checkbox"> 첨부파일 
                	<input type="submit" class="btn btn-default" value="검색">
                </form>
                </td>	

            </tr>
   
</table>
<a href="/index.php/user_c/create_form" class="btn btn-primary btn-lg">글작성</a>


