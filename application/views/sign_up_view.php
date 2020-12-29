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
</head>
<body>
	<div class="signup-form">
		<form action="/blog/signup" method="post">
			User Name: <input type="text" name="name"><br><br>
			User ID: <input type="text" name="id">
			<br><br>
			Password: <input type="password" name="pw"> 8자 이상<br><br>
			Password Confirm: <input type="password" name="pwconf"><br><br>
			Email Address: <input type="text" name="email"><br><br>
			Phone Number: <input type="text" name="phone"><br><br>
			<input type="submit" value="Sign Up" class="btn btn-success"><br><br>
			<h4 style="color:red"><?php echo validation_errors() ?></h4>
		</form>
	</div>

<script>
	function idcheck_error(){

	}
</script>
</body>
</html>
