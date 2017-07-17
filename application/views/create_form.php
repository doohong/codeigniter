<h1> 글쓰기 </h1>
<table class="table table-striped"> 

<form action="create" method="post" enctype="multipart/form-data" name="fm" id="fm">
	

	
	<tr>

	<td>	<input type="text" name = "title" class="form-control" required placeholder="제목"  id="title"></td>
	</tr>
	
	
	<tr>
		<td height="400px">
		<textarea name="contents" id="contents" rows="10" cols="100" style="width:200px; height:400px; display:none;"></textarea>
		</td>
	</tr>
	
	<tr>

		<td>
		<input type="file" name="userfile" size="20">
		</td>
	</tr>

	<tr>
		<td>
		<button class="btn btn-default" id="submit_btn"> 작성</button>
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

        fCreator:"createSEditor2",
        

   	});


$( "#submit_btn" ).click(function(){
	oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD",[]);
	if(!fm.title.value) {
       	alert("제목을 입력해주세요");
       	fm.title.focus();
        return;
    }
    else{
	$("#fm").submit();
}
});
})
</script>
	</table>
</form>