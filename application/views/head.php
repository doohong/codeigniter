<!DOCTYPE html>
        <html>
            <head>
                <!-- 합쳐지고 최소화된 최신 CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

                <!-- 부가적인 테마 -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

                <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
                <meta charset="utf-8"/>
                <script src="/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
                <link rel="stylesheet" type="text/css" href="/assets/css/usercss.css">
            </head>
            <body>
              <div class="col-md-4 col-md-offset-4 col-xs-6">
           		 <?php 
           			if(@$this->session->userdata('login_idle')==TRUE){
           				?>
                  <div>
           			<?php echo $this->session->userdata('login_nickname');
           			?>님 로그인 하셧습니다.</div>
                <div class="col-md-offset-8">
                <ul class="nav nav-pills">
           			<li>
                <a href="/index.php/user_c">홈으로</a>
                </li>
                <li> 
           			<a href="/index.php/user_c/logout">로그아웃</a>
                </li>
                </ul>
                </div>
           		<?php 
           			}
           			else{
           				?>
                  <div class="col-md-offset-6">
                  <ul class="nav nav-pills ">
           				<li><a href="/index.php/user_c">홈으로</a></li>

           				<li><a href="/index.php/user_c/login">로그인</a></li>
           				<li><a href="/index.php/user_c/user">회원가입</a></li>
                  </ul>
                  </div>
           			<?php 
           				}
           				?>
                  



            