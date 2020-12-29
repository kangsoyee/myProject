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
<?php if($user_data[0]['id'] == $table['id'] || $user_data[0]['auth'] == 1){ ?>
	<a href="http://www.kangse2942.com/table/edit_page/<?php echo $index ?>">edit</a>
	<a href="http://www.kangse2942.com/table/delete/<?php echo $index ?>">delete</a>
<?php }?>
<h3><?php echo $table['title'] ?></h3>
<h4><?php echo $table['contents'] ?></h4>
<?php if($table['file']!=null){ ?>
<a href="<?='http://www.kangse2942.com/image/'.$table['file'];?>" target="_blank">
	<img src="<?='/image/'.$table['file'];?>"></a>
<?php } ?>

<table class="table" id="comment">
	<thead>
	<tr>
		<th></th>
		<th>comment</th>
		<th>id</th>
		<th>Date</th>
	</tr>
	</thead>
	<tbody id="tbody">
	<?php for($i=0; $i<count($comment); $i++) {?>
		<tr id="comment_tr">
			<td style="color: white"><?php echo $comment[$i]['index'] ?></td>
			<td><?php echo $comment[$i]['comment'] ?></td>
			<td><?php echo $comment[$i]['id'] ?></td>
			<td><?php echo $comment[$i]['date'] ?></td>
			<td><?php if($user_data[0]['id'] == $comment[$i]['id'] || $user_data[0]['auth'] == 1){ ?>
					<a id="delete">delete</a><?php } ?></td>
		</tr>
		<?php for($j=0; $j<count($recomment); $j++){
		if($recomment[$j]['parents'] == $comment[$i]['index']){?>
			<tr style="background-color:whitesmoke">
				<td style="color: whitesmoke"><?php echo $recomment[$j]['index'] ?></td>
				<td><?php echo $recomment[$j]['comment'] ?></td>
				<td><?php echo $recomment[$j]['id'] ?></td>
				<td><?php echo $recomment[$j]['date'] ?></td>
				<td><?php if($user_data[0]['id'] == $recomment[$j]['id'] || $user_data[0]['auth'] == 1){ ?>
					<a id="delete_re">delete</a><?php } ?></td>
			</tr>
	<?php }}} ?>
	</tbody>
</table>

<form id="recomment_form"></form><br>
<form id="comment_form" name="comment_form"  method="post">
	<textarea id="text_comment" class="form-control" name="comment" placeholder="Enter comment"></textarea>
	<input id="save" type="button" class="btn btn-primary" value="save">
</form>


<script type="text/html" id="template_tr">
	<tr id="comment_tr">
		<td style="color:white">{%index%}</td>
		<td>{%comment%}</td>
		<td>{%id%}</td>
		<td>{%date%}</td>
		<td><a id="delete">{%delete%}</a></td>
	</tr>
</script>
<script type="text/html" id="template_re">
	<tr style="background-color:whitesmoke">
		<td style="color:whitesmoke">{%index%}</td>
		<td>{%comment%}</td>
		<td>{%id%}</td>
		<td>{%date%}</td>
		<td><a id="delete_re">{%delete%}</a></td>
	</tr>
</script>


<script>
	var post = <?php echo $index ?>;
	var user = <?php echo '"'.$user_data[0]['id'].'"' ?>;
	var auth = <?php echo $user_data[0]['auth']?>
	var no;

	$('#save').click(function (){
		comment(<?php echo $index ?>);
	});
	$('#tbody tr td a').click(function (event){
		var index = $(this).closest("tr").children().eq(0).text();
		del(index);
		event.stopPropagation();
	});
	$('#tbody tr td a').click(function (event){
		var index = $(this).closest("tr").children().eq(0).text();
		del_re(index);
		event.stopPropagation();
	});

	$("#comment tbody tr").click(function(){
		// 현재 클릭된 Row(<td>)
		var td = $(this).children();
		no = td.eq(0).text();

		$('#recomment_form').html($('<input>', {
			type: 'text',
			name:'recomment',
			id: 'recomment',
			placeholder: 'Enter recomment'
		}));

		$('#recomment_form').append($('<input>', {
			type: 'button',
			value: 'save',
			id: 're',
			click : recomment
		}));
	});

	function del(index){
		$.ajax({
			url: "http://www.kangse2942.com/table/comment_delete/",
			type: "post",
			data: {index:index, post:<?=$index?>},
			dataType: "json",
			success: drawing
		});
	}

	function del_re(index){
		$.ajax({
			url: "http://www.kangse2942.com/table/recomment_delete/",
			type: "post",
			data: {index:index, post:<?=$index?>},
			dataType: "json",
			success: drawing
		});
	}

	function recomment(){
		var comment = $('#recomment').val();
		$.ajax({
			url: "http://www.kangse2942.com/table/recomment/",
			type: "post",
			data: {
				comment: comment,
				post: post,
				parents: no
			},
			dataType: "json",
			success: drawing
		});
	}

	function comment(index){
		var comment = $('#text_comment').val();
		$.ajax({
			url: "http://www.kangse2942.com/table/comment/"+index,
			type: "post",
			data: {
				comment: comment,
				index: index
			},
			dataType: "json",
			success: drawing
		});
		$('#text_comment').val("");
	}

	function drawing(data){
		var template = $("#template_tr").html();
		var template_re = $("#template_re").html();
		var replacedHtml = '';
		for(var i=0; i<data[0].length; i++){
			if(user == data[0][i]['id'] || auth == 1){
				replacedHtml += template
					.split("{%index%}").join(data[0][i]['index'])
					.split("{%comment%}").join(data[0][i]['comment'])
					.split("{%id%}").join(data[0][i]['id'])
					.split("{%date%}").join(data[0][i]['date'])
					.split("{%delete%}").join("delete");
			}else replacedHtml += template
				.split("{%index%}").join(data[0][i]['index'])
				.split("{%comment%}").join(data[0][i]['comment'])
				.split("{%id%}").join(data[0][i]['id'])
				.split("{%date%}").join(data[0][i]['date'])
				.split("{%delete%}").join("");
			for(var j=0; j<data[1].length; j++){
				if(data[1][j]['parents'] === data[0][i]['index']){
					if(user == data[1][j]['id'] || auth == 1){
						replacedHtml += template_re
							.split("{%index%}").join(data[1][j]['index'])
							.split("{%comment%}").join(data[1][j]['comment'])
							.split("{%id%}").join(data[1][j]['id'])
							.split("{%date%}").join(data[1][j]['date'])
							.split("{%delete%}").join("delete");
					}else replacedHtml += template_re
						.split("{%index%}").join(data[1][j]['index'])
						.split("{%comment%}").join(data[1][j]['comment'])
						.split("{%id%}").join(data[1][j]['id'])
						.split("{%date%}").join(data[1][j]['date'])
						.split("{%delete%}").join("");
				}
			}
		}
		$('#recomment').remove();
		$('#re').remove();

		$('#tbody').html(replacedHtml);
	}
</script>
</body>
</html>
