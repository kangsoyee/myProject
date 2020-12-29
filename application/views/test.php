<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Member</title>
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
<form method="post" name="test_form">
	<input id="index" type="number" name="number" style="width:50px"> 제목:
	<input id="title" type="text" name="title">

	<input id="btn_save" type="button" value="save" onclick="saveSubmit()">
	<input id="btn_delete" type="button" value="delete" onclick="deleteSubmit()">
	<input id="btn_edit" type="button" value="edit" onclick="editSubmit()"><br><br>
</form>

<form action="http://www.kangse2942.com/test/search" method="post" name="search_form">
	<input type="text" name="search">
	<input type="submit" value="search">
</form>

<form action="http://www.kangse2942.com/test/sort" method="post" name="sort_form">
	<select id="selectbox" name="select_name">
		<option value="headID">번호</option>
		<option value="headID">제목</option>
		<option value="headID">날짜</option>
	</select>
	<select id="select" name="select">
		<option value="1">오름차순</option>
		<option value="2">내림차순</option>
	</select>
	<input id="btn_sort_up" type="submit" value="sort">
</form>

<table class="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Title</th>
		<th>Views</th>
		<th>Date</th>
	</tr>
	</thead>
	<tbody>
		<?php for($i=0; $i<count($list)-1; $i++) {?>
			<tr>
				<td><?php echo $list[$i][0] ?></td>
				<td><?php echo $list[$i][1] ?></td>
				<td><?php echo $list[$i][2] ?></td>
				<td><?php echo $list[$i][3] ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<script>
	function saveSubmit(){
		var form = document.forms['test_form'];
		form.action = 'http://www.kangse2942.com/test/save';
		form.submit();
	}
	function deleteSubmit(){
		var form = document.forms['test_form'];
		form.action = 'http://www.kangse2942.com/test/delete';
		form.submit();
	}
	function editSubmit(){
		var form = document.forms['test_form'];
		form.action = 'http://www.kangse2942.com/test/edit';
		form.submit();
	}
</script>
</body>
</html>

