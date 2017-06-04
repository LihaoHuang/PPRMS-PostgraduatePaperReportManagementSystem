/*
* @Author: LihaoHuang
* @Date:   2017-06-04 16:47:33
* @Last Modified by:   LihaoHuang
* @Last Modified time: 2017-06-04 22:53:30
*/

'use strict';

function paper_load(user_id, search = false) {
	if (search) {

	} else {
		let data = {
            "user_id": user_id
        };
        let user = [];
        $.post("php/user.php", data, function(msg){
			var obj = JSON.parse(msg);
			if (obj == "" || obj == null) {
				console.log("查無資料!!");
			} else {
				user['user_id'] = 		obj[0]['user_id'];
				user['username'] = 		obj[0]['username'];
				user['name'] = 			obj[0]['name'];
				user['school'] = 		obj[0]['school'];
				user['department'] = 	obj[0]['department'];
				user['email'] = 		obj[0]['email'];
				user['authority'] = 	obj[0]['authority'];
				user['valid'] = 		obj[0]['valid'];
			}
		});
		$.post("php/paper.php", data, function(msg){
			var obj = JSON.parse(msg);
			if (obj == "" || obj == null) {
				console.log("查無資料!!");
			} else {
				let str = "";
				for (var i = 0; i < obj.length; i++) {
					str += "<tr>";
	                str +=    "<td>"+ obj[i]['paper_name'] +"</td>";
	                str +=    "<td>"+ obj[i]['source'] +"</td>";
	                str +=    "<td>"+ obj[i]['publish'] +"</td>";
	                str +=    "<td>第"+ obj[i]['vol'] +"捲第"+ obj[i]['no'] +"期</td>";
	                str +=    "<td>"+ user['name'] +"</td>";
	                str +=    "<td>"+ (obj[i]['pass']==1?'通過':'尚未通過') +"</td>";
	                str +=    "<td>";
	                str +=        "<button class='btn btn-primary' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i> 查看</button>";
	                str +=        "<button class='btn btn-warning' data-toggle='modal' data-target='#edit' onclick='edit("+ obj[i]['paper_id'] +")'><i class='fa fa-pencil' aria-hidden='true'></i> 編輯</button>";
	                str +=        "<button class='btn btn-danger' onclick='check_delete("+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i> 刪除</button>";
	                str +=    "</td>";
	                str +="</tr>";
				}
				$("tbody").html(str);
			}
		});
	}
}

function view(paper_id) {
	let data = {
        "paper_id": paper_id
    };

	$.post("php/paper_view.php", data, function(msg){
		var obj = JSON.parse(msg);
		if (obj == "" || obj == null) {
			console.log("查無資料!!");
		} else {
			console.log(obj);
			$('#model_paper_name').html(obj[0]['paper_name']);
			$('#model_source').html(obj[0]['source']);
			$('#model_publish').html(obj[0]['publish']);
			$('#model_seminar_loc').html(obj[0]['seminar_loc']);
			$('#model_seminar_time').html(obj[0]['seminar_time']);
			$('#model_page').html(obj[0]['page']);
			$('#model_vol').html("第"+obj[0]['vol']+"捲");
			$('#model_no').html("第"+obj[0]['no']+"期");
			$('#model_keyword1').html(obj[0]['keyword1']);
			$('#model_keyword2').html(obj[0]['keyword2']);
			$('#model_keyword3').html(obj[0]['keyword3']);
			$('#model_keyword4').html(obj[0]['keyword4']);
			$('#model_keyword5').html(obj[0]['keyword5']);
			$('#model_filename').html(obj[0]['filename']);
			$('#model_teacher').html(obj[0]['teacher']);
			$('#model_report_time').html(obj[0]['report_time']);
		}
	});
}

function check_delete(paper_id) {
	if(confirm("確實要刪除嗎?"))
		paper_delete(paper_id);
}

function paper_delete(paper_id) {
	let data = {
        "paper_id": paper_id
    };
	$.post("php/paper_delete.php", data, function(msg){
		alert(msg);
		window.location.reload();
	});
}

function edit(paper_id) {
	let data = {
        "paper_id": paper_id
    };

	$.post("php/paper_view.php", data, function(msg){
		var obj = JSON.parse(msg);
		if (obj == "" || obj == null) {
			console.log("查無資料!!");
		} else {
			console.log(obj);
			$('#paper_id').val(obj[0]['paper_id']);
			$('#paper_name').html("<input type='text' class='form-control' name='paper_name' value='"+obj[0]['paper_name']+"' required>");
			$('#source').html("<input type='text' class='form-control' name='source' value='"+obj[0]['source']+"' required>");
			$('#publish').html("<input type='text' class='form-control' name='publish' value='"+obj[0]['publish']+"' required>");
			$('#seminar_loc').html("<input type='text' class='form-control' name='seminar_loc' value='"+obj[0]['seminar_loc']+"' required>");
			$('#seminar_time').html("<input type='date' class='form-control' name='seminar_time' value='"+obj[0]['seminar_time']+"' required>");
			$('#page').html("<input type='number' class='form-control' name='page' value='"+obj[0]['page']+"' required>");
			$('#vol').html("<input type='number' class='form-control' name='vol' value='"+obj[0]['vol']+"' required>");
			$('#no').html("<input type='number' class='form-control' name='no' value='"+obj[0]['no']+"' required>");
			$('#keyword1').html("<input type='text' class='form-control' name='keyword1' value='"+obj[0]['keyword1']+"'>");
			$('#keyword2').html("<input type='text' class='form-control' name='keyword2' value='"+obj[0]['keyword2']+"'>");
			$('#keyword3').html("<input type='text' class='form-control' name='keyword3' value='"+obj[0]['keyword3']+"'>");
			$('#keyword4').html("<input type='text' class='form-control' name='keyword4' value='"+obj[0]['keyword4']+"'>");
			$('#keyword5').html("<input type='text' class='form-control' name='keyword5' value='"+obj[0]['keyword5']+"'>");
			$('#teacher').html("<input type='text' class='form-control' name='teacher' value='"+obj[0]['teacher']+"' required>");
			$('#report_time').html("<input type='date' class='form-control' name='report_time' value='"+obj[0]['report_time']+"' required>");
		}
	});
}