<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>sign_in</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!-- 부가적인 테마 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.js"
			integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			crossorigin="anonymous"></script>
	<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script src = "//developers.kakao.com/sdk/js/kakao.min.js"></script>
</head>
<body>
	<form action="/blog/signin" method="post">
		ID: <input type="text" name="id"><br>
		PW: <input type="password" name="pw">
		<input type="submit" value="Sign in" class="btn btn-success">
	</form>

	<div>
		<a href="/blog/signup" class="btn">Sign Up</a>
	</div>
	<a href="https://kauth.kakao.com/oauth/authorize?
	client_id=da0117784d27dd31f89ccfcbbf54f464
	&redirect_uri=http://www.kangse2942.com/blog/kakao
	&response_type=code">
		<img src="/image/kakao_login_medium_wide.png">
	</a>
	<a id="kakao-login-btn"><img src="/image/kakao_login_medium_wide.png"></a>
	<br><br><h4 style="color:red"><?php echo $error ?></h4>
	<script type="text/javascript">
		Kakao.init('3e9631e18fa7d952005f721ecdccdd77'); //아까 카카오개발자홈페이지에서 발급받은 자바스크립트 키를 입력함

		//카카오 로그인 버튼을 생성합니다.

		Kakao.Auth.createLoginButton({
			container: '#kakao-login-btn',
			success: function(authObj) { //authObj가 참일때, 자료를 성공적으로 보냈을때 출력되는 부분
				Kakao.API.request({

					url: 'http://www.kangse2942.com/blog/kakao',

					success: function(res) { //res가 참일때, 자료를 성공적으로 보냈을때 출력되는 부분

						console.log(res.id);//<---- 콘솔 로그에 id 정보 출력(id는 res안에 있기 때문에  res.id 로 불러온다)
						console.log(res.kaccount_email);//<---- 콘솔 로그에 email 정보 출력 (어딨는지 알겠죠?)
						console.log(res.properties['nickname']);//<---- 콘솔 로그에 닉네임 출력(properties에 있는 nickname 접근
						// res.properties.nickname으로도 접근 가능 )
						console.log(authObj.access_token);//<---- 콘솔 로그에 토큰값 출력

						var kakaonickname = res.properties.nickname;    //카카오톡 닉네임을 변수에 저장
						var kakaoe_mail = res.properties.kaccount_email;    //카카오톡 이메일을 변수에 저장함


						//카카오톡의 닉네임과,mail을 url에 담아 같이 페이지를 이동한다.
						window.location.replace("http://" + window.location.hostname
								+ ((location.port==""||location.port==undefined)?"":":" + location.port)
								+ "/hansub_project/home?kakaonickname="+kakaonickname+"&kakaoe_mail="+kakaoe_mail);
					}
				})
			},
			fail: function(error) { //에러 발생시 에러 메시지를 출력한다.
				alert(JSON.stringify(error));
			}
		});
	</script>
</body>
</html>
