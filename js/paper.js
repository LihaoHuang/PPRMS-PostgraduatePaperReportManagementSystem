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
		$.post("php/paper.php", data, function(msg){
			var obj = JSON.parse(msg);
			if (obj == "" || obj == null) {
				console.log("查無資料!!");
                let str = "";
                str += "<tr>";
                str +=    "<td colspan='7' align='center'><h2>無資料</h2></td>";
                str +="</tr>";
                $("tbody").html(str);
			} else {
				let str = "";
				for (var i = 0; i < obj.length; i++) {
					str += "<tr>";
	                str +=    "<td>"+ obj[i]['paper_name'] +"</td>";
	                str +=    "<td>"+ obj[i]['source'] +"</td>";
	                str +=    "<td>"+ obj[i]['publish'] +"</td>";
	                str +=    "<td>第"+ obj[i]['vol'] +"捲第"+ obj[i]['no'] +"期</td>";
	                str +=    "<td>"+ obj[i]['name'] +"</td>";
	                str +=    "<td>"+ (obj[i]['pass']==1?'通過':(obj[i]['pass']==2?'不通過':'尚未審核')) +"</td>";
	                str +=    "<td>";
	                str +=        "<button class='btn btn-success' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i> 查看</button>";
	                str +=        "<button class='btn btn-primary' data-toggle='modal' data-target='#edit' onclick='edit("+ obj[i]['paper_id'] +")'><i class='fa fa-pencil' aria-hidden='true'></i> 編輯</button>";
					str +=        "<button class='btn btn-danger' onclick='check_delete("+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i> 刪除</button>";
					if (obj[i]['SESSION_auth'] == 1){
                        if (obj[i]['favorite'] == 1){
                            str +=        "<button class='btn btn-warning' onclick='check_favorite(1,"+ obj[i]['paper_id'] +")'><i class='fa fa-star' aria-hidden='true'></i> 加到我的最愛</button>";
                        }else{
                            str +=        "<button class='btn btn-warning' onclick='check_favorite(0,"+ obj[i]['paper_id'] +")'><i class='fa fa-star-o' aria-hidden='true'></i> 加到我的最愛</button>";
                        }
					}
	                str +=    "</td>";
	                str +="</tr>";
				}
				$("tbody").html(str);
			}
		});
	}
}

function favorite_load(user_id, search = false) {
    if (search) {

    } else {
        let data = {
            "user_id": user_id
        };
        $.post("php/favorite.php", data, function(msg){
            var obj = JSON.parse(msg);
            if (obj == "" || obj == null) {
                console.log("查無資料!!");
                let str = "";
                str += "<tr>";
                str +=    "<td colspan='7' align='center'><h2>無資料</h2></td>";
                str +="</tr>";
                $("tbody").html(str);
            } else {
                let str = "";
                for (var i = 0; i < obj.length; i++) {
                    str += "<tr>";
                    str +=    "<td>"+ obj[i]['paper_name'] +"</td>";
                    str +=    "<td>"+ obj[i]['source'] +"</td>";
                    str +=    "<td>"+ obj[i]['publish'] +"</td>";
                    str +=    "<td>第"+ obj[i]['vol'] +"捲第"+ obj[i]['no'] +"期</td>";
                    str +=    "<td>"+ obj[i]['name'] +"</td>";
                    str +=    "<td>"+ (obj[i]['pass']==1?'通過':(obj[i]['pass']==2?'不通過':'尚未審核')) +"</td>";
                    str +=    "<td>";
                    str +=        "<button class='btn btn-success' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i> 查看</button>";
                    str +=        "<button class='btn btn-primary' data-toggle='modal' data-target='#edit' onclick='edit("+ obj[i]['paper_id'] +")'><i class='fa fa-pencil' aria-hidden='true'></i> 編輯</button>";
                    str +=        "<button class='btn btn-danger' onclick='check_delete("+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i> 刪除</button>";
					str +=        "<button class='btn btn-warning' onclick='check_nonfavorite("+ obj[i]['paper_id'] +")'><i class='fa fa-star' aria-hidden='true'></i> 取消我的最愛</button>";
                    str +=    "</td>";
                    str +="</tr>";
                }
                $("tbody").html(str);
            }
        });
    }
}

function verify_load(user_id, search = false) {
    if (search) {

    } else {
        let data = {
            "user_id": user_id
        };
        $.post("php/verify.php", data, function(msg){
            var obj = JSON.parse(msg);
            if (obj == "" || obj == null) {
                console.log("查無資料!!");
                let str = "";
                str += "<tr>";
                str +=    "<td colspan='7' align='center'><h2>無資料</h2></td>";
                str +="</tr>";
                $("tbody").html(str);
            } else {
                let str = "";
                for (var i = 0; i < obj.length; i++) {
                    str += "<tr>";
                    str +=    "<td>"+ obj[i]['paper_name'] +"</td>";
                    str +=    "<td>"+ obj[i]['name'] +"</td>";
                    str +=    "<td>"+ (obj[i]['pass']==1?'通過':(obj[i]['pass']==2?'不通過':'尚未審核')) +"</td>";
                    str +=    "<td>";
                    str +=        "<button class='btn btn-success' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i> 查看</button>";
                    str +=        "<button class='btn btn-warning' onclick='check_verify(1, "+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i> 通過</button>";
                    str +=        "<button class='btn btn-danger' onclick='check_verify(2, "+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i> 不通過</button>";
                    str +=    "</td>";
                    str +="</tr>";
                }
                $("tbody").html(str);
            }
        });
    }
}

function favorite(state, paper_id) {
	if (state==1){
		alert("已經加到最愛!");
	}else{
        let data = {
            "paper_id": paper_id
        };
        $.post("php/paper_favorite.php", data, function(msg){
            window.location.reload();
        });
	}
}

function nonfavorite(paper_id){
    let data = {
        "paper_id": paper_id
    };
    $.post("php/paper_nonfavorite.php", data, function(msg){
        window.location.reload();
    });
}

function verify(state, paper_id) {
	let data = {
		"paper_id": paper_id,
		"state": state,
	};
	$.post("php/paper_verify.php", data, function(msg){
		window.location.reload();
	});
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
	if(confirm("確定要刪除嗎?"))
		paper_delete(paper_id);
}

function check_favorite(state, paper_id) {
    if(confirm("確定要加到我的最愛嗎?"))
        favorite(state, paper_id);
}

function check_nonfavorite(paper_id) {
    if(confirm("確定要取消我的最愛嗎?"))
        nonfavorite(paper_id);
}

function check_verify(state, paper_id) {
	if (state == 1){
        if(confirm("確定要審核 通過?"))
            verify(state, paper_id);
	}else{
        if(confirm("確定要審核 不通過?"))
            verify(state, paper_id);
	}

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