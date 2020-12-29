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
<header>
	<nav id="right_nav">
		<ul>
			<li id="login"><a class="title" href="http://www.kangse2942.com/blog/logout">로그아웃</a></li>
		</ul>
	</nav>
</header>
<h5> name: <?php echo $list['name']?> </h5>
<h5> id: <?php echo $list['id']?> </h5>
<h5> email: <?php echo $list['email']?> </h5>
<h5> phone: <?php echo $list['phone']?> </h5>
<nav class="sub_nav">
	<ul id="topic_list_tree" >
		<li id="list_10930">
			<div class="label"><a href="http://www.kangse2942.com/table"><span class="title">글쓰기</span></a></div>
		</li>
		<?php if($auth){?>
		<li id="list_10931">
			<div class="label"><a href="http://www.kangse2942.com/table/notice"><span class="title">공지사항 글쓰기</span></a></div>
		</li><?php } ?>
	</ul>
</nav>

<form name="notice_form" method="get">
	<table class="table" id="notice">
		<thead>
		<tr>
			<th>Number</th>
			<th>Title</th>
			<th>id</th>
			<th>Date</th>
		</tr>
		</thead>
		<tbody>
		<?php for($i=0; $i<count($notice); $i++) {?>
			<tr>
				<td><?php echo $notice[$i]['index'] ?></td>
				<td><?php echo $notice[$i]['title'] ?></td>
				<td><?php echo $notice[$i]['id'] ?></td>
				<td><?php echo $notice[$i]['date'] ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

</form>

<form name="table_form" method="get">
<table class="table" id="table">
	<thead>
	<tr>
		<th>Number</th>
		<th>Title</th>
		<th>id</th>
		<th>Date</th>
		<th>image</th>
	</tr>
	</thead>
	<tbody>
	<?php for($i=0; $i<5; $i++) {?>
		<tr>
			<td><?php echo $table[$i]['index'] ?></td>
			<td><?php echo $table[$i]['title'] ?></td>
			<td><?php echo $table[$i]['id'] ?></td>
			<td><?php echo $table[$i]['date'] ?></td>
			<td><?php if($table[$i]['file']!=null){ ?>
			<a href="<?='http://www.kangse2942.com/image/'.$table[$i]['file'];?>" target="_blank">
				<img src="<?='/image/'.$table[$i]['file'];?>" height="20"></a><?php }?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</form>

<nav id="right_nav">
	<ul>
	<?php for($i=1; $i<(count($table)/5)+1; $i++) {?>
		<a href="javascript:void(0)" onclick="page(<?php echo $i?>)" style="font-size: 20px"><?php echo $i?></a>
	<?php }?>
	</ul>
</nav>

<script type="text/html" id="template">
	<tr>
		<td>{%index%}</td>
		<td>{%title%}</td>
		<td>{%id%}</td>
		<td>{%date%}</td>
		<td><a href="<?='http://www.kangse2942.com/image/'?>{%file%}" target="_blank">
				<img src="/image/{%file%}" height="20"></a></td>
	</tr>
</script>
<script type="text/html" id="template_non">
	<tr>
		<td><a href="<?='http://www.kangse2942.com/table/detail/'?>{%index%}">{%index%}</a></td>
		<td><a href="<?='http://www.kangse2942.com/table/detail/'?>{%index%}">{%title%}</a></td>
		<td>{%id%}</td>
		<td>{%date%}</td>
		<td></td>
	</tr>
</script>

<!--<script type="text/html" id="template_non">-->
<!--	<tr>-->
<!--		<td>{%index%}</td>-->
<!--		<td>{%title%}</td>-->
<!--		<td>{%id%}</td>-->
<!--		<td>{%date%}</td>-->
<!--		<td></td>-->
<!--	</tr>-->
<!--</script>-->

<script type="text/javascript">
	$("#table tbody tr").click(function(){
		var td = $(this).children();
		var no = td.eq(0).text();

		var form = document.forms['table_form'];
		form.action = 'http://www.kangse2942.com/table/detail/'+no;
		form.submit();
	});
	$("#notice tbody tr").click(function(){
		var td = $(this).children();
		var no = td.eq(0).text();

		var form = document.forms['notice_form'];
		form.action = 'http://www.kangse2942.com/table/detail/'+no;
		form.submit();
	});

	function page(index) {
		var offset = --index*5;
		$.ajax({
			url: "http://www.kangse2942.com/blog/pagination",
			type: "post",
			data: {offset: offset},
			dataType: "json",
			success: drawing
		});
	}
	function drawing(data){
		var template = $("#template").html();
		var template_non = $("#template_non").html();
		var replacedHtml = '';
		for (var i = 0; i < data.length; i++){
			if(data[i]['file']!=null)
				replacedHtml += template
					.split("{%index%}").join(data[i]['index'])
					.split("{%title%}").join(data[i]['title'])
					.split("{%id%}").join(data[i]['id'])
					.split("{%date%}").join(data[i]['date'])
					.split("{%file%}").join(data[i]['file']);
			else replacedHtml += template_non
					.split("{%index%}").join(data[i]['index'])
					.split("{%title%}").join(data[i]['title'])
					.split("{%id%}").join(data[i]['id'])
					.split("{%date%}").join(data[i]['date']);
		}
		$('#table tbody').html(replacedHtml);
	}

</script>
</body>
</html>

