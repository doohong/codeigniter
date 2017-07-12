

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
   
</table>
<a href="/index.php/user_c/create_form" class="btn btn-primary btn-lg">글작성</a>

