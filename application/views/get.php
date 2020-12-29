
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- 합쳐지고 최소화된 최신 CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

	<!-- 부가적인 테마 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

	<script
		src="https://code.jquery.com/jquery-3.5.1.js"
		integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
		crossorigin="anonymous"></script>

	<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<form method="post">
<p><input id="index" type="number" style="width:50px"> 제목:
	<input id="title" type="text">
	<input id="btn_save" type="button" value="save">
	<input id="btn_delete" type="button" value="delete">
	<input id="btn_start" type="button" value="start"><br><br>
	<select id="selectbox">
		<option value="headID">번호</option>
		<option value="headID">제목</option>
		<option value="headID">날짜</option>
	</select>
	<input id="btn_sort_up" type="button" value="▲">
	<input id="btn_sort_down" type="button" value="▼">
</p>
<table id="mytable" class="table" border="1">
	<thead style="background-color: gray">
	<tr>
		<th>번호</th><th>제목</th><th>조회수</th><th>날짜</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach($table_list as $id=>$name):?>
			<tr>
				<td><?=$id?></td>
				<td><?=$name?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
</form>

<script>
	var title = document.getElementById('title');
	var number = 0;
	var list = Array();

	function add(index, title){
		if(index==0){
			var row = [];
			row['number'] = list.length+1;
			row['title']= title;
			row['date'] = new Date().toLocaleTimeString();

			list.push(row);
		}else {
			var row = [];
			row['number'] = list.length+1;
			row['title'] = title;
			row['date'] = new Date().toLocaleTimeString();

			list.splice(--index, 0, row);
		}
		$('#title').val('');

	}
	function remove(index){
		list.splice(--index, 1);
	}
	function listview(){
		$('#mytable > tbody > tr').remove();

		for(var i=0; i < list.length; i++){
			$('#mytable >tbody:last').append('<tr><td>'+list[i]['number']+'</td><td>'+list[i]['title']+'</td><td>0</td><td>'+list[i]['date']+'</td></tr>');
		}
	}

	$('#btn_save').on('click', function(event){
		add($('#index').val(),$('#title').val());
		listview();
	});

	$('#btn_delete').on('click', function(event){
		remove($('#index').val());
		listview();
	});

	$('#btn_start').on('click', function(event){
		var interval = setInterval(function(){
			add(0, 'test');
			listview();
		}, 1000);
		setTimeout(function(){
			clearTimeout(interval);
		}, 3000);
	});

	$('#btn_sort_up').on('click', function(event){
		list.sort(function (a, b){
			switch($("#selectbox option:selected").text()){
				case "번호":
					return a.number < b.number ? -1 : a.number > b.number ? 1 : 0;
					break;
				case "제목":
					return a.title < b.title ? -1 : a.title > b.title ? 1 : 0;
					break;
				case "날짜":
					return a.date < b.date ? -1 : a.date > b.date ? 1 : 0;
					break;
			}
		});
		listview();
	});
	$('#btn_sort_down').on('click', function(event){
		list.sort(function (a, b){
			switch($("#selectbox option:selected").text()){
				case "번호":
					return a.number > b.number ? -1 : a.number < b.number ? 1 : 0;
					break;
				case "제목":
					return a.title > b.title ? -1 : a.title < b.title ? 1 : 0;
					break;
				case "날짜":
					return a.date > b.date ? -1 : a.date < b.date ? 1 : 0;
					break;
			}
		});
		listview();
	});
</script>
</body>
</html>
