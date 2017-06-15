/*
* @Author: CingYingYeh
* @Date:   2017-06-15 15:21:44
* @Last Modified by:   LihaoHuang
* @Last Modified time: 2017-06-15 17:49:59
*/

'use strict';
$('[data-tooltip="tooltip"]').tooltip();
function user_load(user_id, search = false) {
	if (search) {

	} else {
		let data = {
            "user_id": user_id
        };
		$.post("php/user.php", data, function(msg){
			var obj = JSON.parse(msg);
			if (obj == "" || obj == null) {
				console.log("查無資料!!");

				/* 使用者申請 */

                let str1 = "";
                str1 += "<tr>";
                str1 +=    "<td colspan='4' align='center'><h2>無資料</h2></td>";
                str1 +="</tr>";
                $("#table1").html(str1);

				/* 使用者列表 */

                let str2 = "";
                str2 += "<tr>";
                str2 +=    "<td colspan='7' align='center'><h2>無資料</h2></td>";
                str2 +="</tr>";
                $("#table2").html(str2);
			} else {

				/* 使用者申請 */

				let str1 = "";
				for (var i = 0; i < obj.length; i++) {
					if(obj[i]['valid'] == 0){
						str1 += "<tr>";
						str1 +=    "<td>"+ obj[i]['name'] +"</td>";
		                str1 +=    "<td>"+ obj[i]['school'] +"</td>";
		                str1 +=    "<td>"+ obj[i]['department'] +"</td>";
		                str1 +=    "<td>";
		                str1 +=        "<button class='btn btn-success' data-tooltip='tooltip' title='通過' data-toggle='modal' onclick='check_verify("+ obj[i]['user_id'] +")'><i class='fa fa-check' aria-hidden='true'></i></button>";
		                str1 +=    "</td>";
		                str1 +="</tr>";		
					}
				}
				$("#table1").html(str1);

				/* 使用者列表 */

				let str2 = "";
				for (var i = 0; i < obj.length; i++) {
					if(obj[i]['valid'] == 1){
						str2 += "<tr>";
		                str2 +=    "<td>"+ obj[i]['name'] +"</td>";
		                str2 +=    "<td>"+ obj[i]['username'] +"</td>";
		                str2 +=    "<td>"+ obj[i]['email'] +"</td>";
		                str2 +=    "<td>"+ obj[i]['school'] + "</td>";
		                str2 +=    "<td>"+ obj[i]['department'] +"</td>";
		                str2 +=    "<td>"+ (obj[i]['authority']==0?'一般使用者':'管理員') +"</td>";
		                str2 +=    "<td>";
		                if(obj[i]['authority'] == 0){
		                	str2 += "<button class='btn btn-success' data-tooltip='tooltip' title='設為系統管理員' data-target='#view' onclick='check_authority(1, "+ obj[i]['user_id'] +")'><i class='fa fa-user' aria-hidden='true'></i> &nbsp;設為系統管理員</button>";
		                }
		                else{
		                	str2 += "<button class='btn btn-success' data-tooltip='tooltip' title='設為一般使用者' data-target='#view' onclick='check_authority(0, "+ obj[i]['user_id'] +")'><i class='fa fa-user' aria-hidden='true'></i> &nbsp;設為一般使用者</button>";
		                }        
		                str2 +=    "</td>";
		                str2 +="</tr>";
		            }
				}
				$("#table2").html(str2);
                $('[data-tooltip="tooltip"]').tooltip();
			}
		});
	}
}

function verify(user_id) {
	let data = {
		"user_id": user_id,
	};
	$.post("php/user_verify.php", data, function(msg){
		window.location.reload();
	});
}

function authority(state, user_id) {
	let data = {
		"user_id": user_id,
		"state": state,
	};
	$.post("php/user_authority.php", data, function(msg){
		window.location.reload();
	});
}

function check_verify(user_id) {
    if(confirm("確定要審核 通過?")){
        verify(user_id);
    }
}

function check_authority(state, user_id) {
	if (state == 1){
        if(confirm("確定要設為 管理員?"))
            authority(state, user_id);
	}else{
        if(confirm("確定要設為 一般使用者?"))
            authority(state, user_id);
	}
}