<form action="idcreate" method="post" class="form-group">
	이름<input type="text" name="name" class="form-control" placeholder="이름" required> 
	아이디<input type="text" name="id" id="id-id" required class="form-control" placeholder="ID">
	<button type="button" id="btn-over" >ID 중복확인</button><br> 
	비밀번호<input type="password" name="pwd" class="form-control"   placeholder="암호" required>
	메일<input type = "email" name="email" required class="form-control" placeholder="이메일을 입력하세요">
  닉네임<input type="text" name="nickname" required class="form-control" placeholder="닉네임">
  
	<input type="submit" value="회원가입">
</form>
<script>

$( "#btn-over" ).click(function() {
  
  	var idfind = $("#id-id").val();

    $.ajax({
    	type:'POST',
    	url:'idfinder',
    	dataType:'json',
    	data:{idfind : idfind} ,
    	success:function(data){
           		if(data==0)
           	  {
                alert('사용 가능');
               
              }

              
            
           		else
           		{
           			alert('사용 불가능');
           		}
           		
        },
        
    })

  });
</script>
