<h1> 수정하기 </h1>
<table class="table table-striped"> 
<form action="updatecomplete" id="fm" method="post" enctype="multipart/form-data">
	<tr>

		<td>	
		<input type="text" class="form-control" placeholder="제목" name = "title" value = "<?php echo $list[0]['title'] ; ?>" required id="title">
		</td>
	</tr>
	<tr>
		<td height="300px;"><textarea id="contents" rows="15" name="contents" placeholder="내용" ><?php echo $list[0]['contents']; ?></textarea></td>
	</tr>
	<tr>
		<td>
		<input type="file" name="userfile" size="20" />
		</td>
	<tr>
		<td>
		<input type="hidden" value="<?php echo $list[0]['num']; ?>" name="num">
		<button type="submit" id="submit_btn" class="btn btn-default">수정</button>
		</td>
	</tr>


<script type="text/javascript">
$(function(){

	var oEditors = [];
     
    nhn.husky.EZCreator.createInIFrame({
        oAppRef : oEditors,
        elPlaceHolder: "contents",
        sSkinURI: "/assets/js/workspace/SmartEditor2Skin.html",
        
        htParams : {
            // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseToolbar : true,            
            // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseVerticalResizer : true,    
            // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
            bUseModeChanger : true,
            
        },

        fCreator:"createSEditor2"
        

   	});


$( "#submit_btn" ).click(function(){
	oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD",[]);
	if(!form.title.value) {
        alert("제목을 입력해주세요");
        form.title.focus();
        return;
    }
	$("#fm").submit();

});
})
</script>
</form>
</table>
