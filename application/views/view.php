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
	<input id="text_number" type="number" name="number" style="width:50px"> 제목:
	<input id="text_title" type="text" name="title">

	<input id="btn_save" type="button" value="save">
	<input id="btn_delete" type="button" value="delete">
	<input id="btn_edit" type="button" value="edit"><br><br>
</form>

<form method="post" name="search_form">
	<input id="text_search" type="text" name="search">
	<input id="btn_search" type="button" value="search">
</form>

<form method="post" name="sort_form">
	<select id="selectbox_title" name="select_name">
		<option value="headID">번호</option>
		<option value="headID">제목</option>
		<option value="headID">날짜</option>
	</select>
	<select id="selectbox_dir" name="select">
		<option value="1">오름차순</option>
		<option value="2">내림차순</option>
	</select>
	<input id="btn_sort" type="button" value="sort">
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
	<tbody id="table_body">
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
<script type="text/html" id="template_tr">
	<tr>
		<td>{%no%}</td>
		<td>{%title%}</td>
		<td>{%count%}</td>
		<td>{%date%}</td>
	</tr>
</script>
<script type="text/javascript">
	$(document).ready(function () {

		$('#btn_save').on('click', function () {
			AJAX("save");
		});
		$('#btn_delete').on('click', function () {
			AJAX("delete");
		});
		$('#btn_edit').on('click', function () {
			AJAX("edit");
		});
		$('#btn_search').on('click', function () {
			AJAX("search");
		});
		$('#btn_sort').on('click', function () {
			AJAX("sort");
		});
	});

	function AJAX(fun){
		var number = $('#text_number').val();
		var title = $('#text_title').val();
		var search = $('#text_search').val();
		var select_title = $('#selectbox_title option:selected').val();
		var select_dir = $('#selectbox_dir option:selected').val();

		$.ajax({
			url: "http://www.kangse2942.com/ajax/"+fun,
			type: "post",
			data: {
				number: number,
				title: title,
				search: search,
				select_title: select_title,
				select_dir: select_dir
			},
			dataType: "json",
			success: drawing
		});
		$('#text_number').val("");
		$('#text_title').val("");
		$('#text_search').val("");
	}

	function drawing(data){
		alert("a");
		var template = $("#template_tr").html();
		var replacedHtml = '';
		for(var i=0; i<data.length-1; i++){
			replacedHtml += template.split("{%no%}").join(data[i][0])
				.split("{%title%}").join(data[i][1])
				.split("{%count%}").join(data[i][2])
				.split("{%date%}").join(data[i][3]);
		}
		//$('#table_body').append(replacedHtml)
		$('#table_body').html(replacedHtml);
	}
</script>
</body>
</html>

