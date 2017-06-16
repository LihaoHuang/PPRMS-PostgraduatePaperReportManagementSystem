/*
* @Author: LihaoHuang
* @Date:   2017-06-04 16:47:33
* @Last Modified by:   LihaoHuang
* @Last Modified time: 2017-06-04 22:53:30
*/

'use strict';
$('[data-tooltip="tooltip"]').tooltip();
var search = getCookie("search");

function paper_load(user_id) {
	if (search == "searching") {
        setCookie("search", "", 365);
        let data = {
            "user_id": user_id,
            "category": getCookie("category"),
            "keyword" : DecodeCookie(getCookie("keyword"))
        };

        $.post("php/paper_search.php", data, function(msg){
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
                    str +=    "<td>"+ obj[i]['journal'] +"(第"+ obj[i]['vol'] +"捲第"+ obj[i]['no'] +"期)</td>";
                    str +=    "<td>"+ obj[i]['name'] +"</td>";
                    str +=    "<td>"+ (obj[i]['pass']==1?'通過':(obj[i]['pass']==2?'不通過':'尚未審核')) +"</td>";
                    str +=    "<td>";
                    str +=        "<button class='btn btn-success' data-tooltip='tooltip' title='查看' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='編輯' data-toggle='modal' data-target='#edit' onclick='edit("+ obj[i]['paper_id'] +")'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='論文上傳' data-toggle='modal' data-target='#fileupload' onclick='fileupload("+ obj[i]['paper_id'] +")'><i class='fa fa-file' aria-hidden='true'></i></button>";
                    str +=        "<a type='button' class='btn btn-info' data-tooltip='tooltip' title='論文資訊下載(IEEE格式)' href='php/ieee_download.php?paper_id=" + obj[i]['paper_id'] +"'><i class='fa fa-download' aria-hidden='true'></i></a>";
                    str +=        "<button class='btn btn-danger' data-tooltip='tooltip' title='刪除' onclick='check_delete("+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i> </button>";
                    if (obj[i]['SESSION_auth'] == 1){
                        if (obj[i]['favorite'] == 1){
                            str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='加到我的最愛' onclick='check_favorite(1,"+ obj[i]['paper_id'] +")'><i class='fa fa-star' aria-hidden='true'></i></button>";
                        }else{
                            str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='加到我的最愛' onclick='check_favorite(0,"+ obj[i]['paper_id'] +")'><i class='fa fa-star-o' aria-hidden='true'></i></button>";
                        }
                    }
                    str +=    "</td>";
                    str +="</tr>";
                }
                $("tbody").html(str);
                $('[data-tooltip="tooltip"]').tooltip();
            }
        });
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
	                str +=    "<td>"+ obj[i]['journal'] +"(第"+ obj[i]['vol'] +"捲第"+ obj[i]['no'] +"期)</td>";
	                str +=    "<td>"+ obj[i]['name'] +"</td>";
	                str +=    "<td>"+ (obj[i]['pass']==1?'通過':(obj[i]['pass']==2?'不通過':'尚未審核')) +"</td>";
	                str +=    "<td>";
	                str +=        "<button class='btn btn-success' data-tooltip='tooltip' title='查看' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i></button>";
	                str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='編輯' data-toggle='modal' data-target='#edit' onclick='edit("+ obj[i]['paper_id'] +")'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='論文上傳' data-toggle='modal' data-target='#fileupload' onclick='fileupload("+ obj[i]['paper_id'] +")'><i class='fa fa-file' aria-hidden='true'></i></button>";
                    str +=        "<a type='button' class='btn btn-info' data-tooltip='tooltip' title='論文資訊下載(IEEE格式)' href='php/ieee_download.php?paper_id=" + obj[i]['paper_id'] +"'><i class='fa fa-download' aria-hidden='true'></i></a>";
					str +=        "<button class='btn btn-danger' data-tooltip='tooltip' title='刪除' onclick='check_delete("+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i> </button>";
					if (obj[i]['SESSION_auth'] == 1){
                        if (obj[i]['favorite'] == 1){
                            str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='加到我的最愛' onclick='check_favorite(1,"+ obj[i]['paper_id'] +")'><i class='fa fa-star' aria-hidden='true'></i></button>";
                        }else{
                            str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='加到我的最愛' onclick='check_favorite(0,"+ obj[i]['paper_id'] +")'><i class='fa fa-star-o' aria-hidden='true'></i></button>";
                        }
					}
	                str +=    "</td>";
	                str +="</tr>";
				}
				$("tbody").html(str);
                $('[data-tooltip="tooltip"]').tooltip();
			}
		});
	}
}

function favorite_load(user_id) {
    if (search == "searching") {
        setCookie("search", "", 365);
        let data = {
            "user_id": user_id,
            "category": getCookie("category"),
            "keyword" : DecodeCookie(getCookie("keyword"))
        };
        $.post("php/favorite_search.php", data, function(msg){
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
                    str +=    "<td>"+ obj[i]['journal'] +"(第"+ obj[i]['vol'] +"捲第"+ obj[i]['no'] +"期)</td>";
                    str +=    "<td>"+ obj[i]['name'] +"</td>";
                    str +=    "<td>"+ (obj[i]['pass']==1?'通過':(obj[i]['pass']==2?'不通過':'尚未審核')) +"</td>";
                    str +=    "<td>";
                    str +=        "<button class='btn btn-success' data-tooltip='tooltip' title='查看' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='編輯' data-toggle='modal' data-target='#edit' onclick='edit("+ obj[i]['paper_id'] +")'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='論文上傳' data-toggle='modal' data-target='#fileupload' onclick='fileupload("+ obj[i]['paper_id'] +")'><i class='fa fa-file' aria-hidden='true'></i></button>";
                    str +=        "<a type='button' class='btn btn-info' data-tooltip='tooltip' title='論文資訊下載(IEEE格式)' href='php/ieee_download.php?paper_id=" + obj[i]['paper_id'] +"'><i class='fa fa-download' aria-hidden='true'></i></a>";
                    str +=        "<button class='btn btn-danger' data-tooltip='tooltip' title='刪除' onclick='check_delete("+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='取消我的最愛' onclick='check_nonfavorite("+ obj[i]['paper_id'] +")'><i class='fa fa-star' aria-hidden='true'></i></button>";
                    str +=    "</td>";
                    str +="</tr>";
                }
                $("tbody").html(str);
                $('[data-tooltip="tooltip"]').tooltip();
            }
        });
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
                    str +=    "<td>"+ obj[i]['journal'] +"(第"+ obj[i]['vol'] +"捲第"+ obj[i]['no'] +"期)</td>";
                    str +=    "<td>"+ obj[i]['name'] +"</td>";
                    str +=    "<td>"+ (obj[i]['pass']==1?'通過':(obj[i]['pass']==2?'不通過':'尚未審核')) +"</td>";
                    str +=    "<td>";
                    str +=        "<button class='btn btn-success' data-tooltip='tooltip' title='查看' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='編輯' data-toggle='modal' data-target='#edit' onclick='edit("+ obj[i]['paper_id'] +")'><i class='fa fa-pencil' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-primary' data-tooltip='tooltip' title='論文上傳' data-toggle='modal' data-target='#fileupload' onclick='fileupload("+ obj[i]['paper_id'] +")'><i class='fa fa-file' aria-hidden='true'></i></button>";
                    str +=        "<a type='button' class='btn btn-info' data-tooltip='tooltip' title='論文資訊下載(IEEE格式)' href='php/ieee_download.php?paper_id=" + obj[i]['paper_id'] +"'><i class='fa fa-download' aria-hidden='true'></i></a>";
                    str +=        "<button class='btn btn-danger' data-tooltip='tooltip' title='刪除' onclick='check_delete("+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='取消我的最愛' onclick='check_nonfavorite("+ obj[i]['paper_id'] +")'><i class='fa fa-star' aria-hidden='true'></i></button>";
                    str +=    "</td>";
                    str +="</tr>";
                }
                $("tbody").html(str);
                $('[data-tooltip="tooltip"]').tooltip();
            }
        });
    }
}

function verify_load(user_id) {
    if (search == "searching") {
        setCookie("search", "", 365);
        let data = {
            "user_id": user_id,
            "category": getCookie("category"),
            "keyword" : DecodeCookie(getCookie("keyword"))
        };
        $.post("php/verify_search.php", data, function(msg){
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
                    str +=        "<button class='btn btn-success' data-tooltip='tooltip' title='查看' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='通過' onclick='check_verify(1, "+ obj[i]['paper_id'] +")'><i class='fa fa-check' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-danger' data-tooltip='tooltip' title='不通過' onclick='check_verify(2, "+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i></button>";
                    str +=    "</td>";
                    str +="</tr>";
                }
                $("tbody").html(str);
                $('[data-tooltip="tooltip"]').tooltip();
            }
        });
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
                    str +=        "<button class='btn btn-success' data-tooltip='tooltip' title='查看' data-toggle='modal' data-target='#view' onclick='view("+ obj[i]['paper_id'] +")'><i class='fa fa-eye' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-warning' data-tooltip='tooltip' title='通過' onclick='check_verify(1, "+ obj[i]['paper_id'] +")'><i class='fa fa-check' aria-hidden='true'></i></button>";
                    str +=        "<button class='btn btn-danger' data-tooltip='tooltip' title='不通過' onclick='check_verify(2, "+ obj[i]['paper_id'] +")'><i class='fa fa-close' aria-hidden='true'></i></button>";
                    str +=    "</td>";
                    str +="</tr>";
                }
                $("tbody").html(str);
                $('[data-tooltip="tooltip"]').tooltip();
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
            $('#model_journal').html(obj[0]['journal']);
			$('#model_vol').html("第"+obj[0]['vol']+"捲");
			$('#model_no').html("第"+obj[0]['no']+"期");
			$('#model_keyword1').html(obj[0]['keyword1']);
			$('#model_keyword2').html(obj[0]['keyword2']);
			$('#model_keyword3').html(obj[0]['keyword3']);
			$('#model_keyword4').html(obj[0]['keyword4']);
			$('#model_keyword5').html(obj[0]['keyword5']);
			$('#model_filename').html("<a type='button' class='btn btn-info' href='php/filedownload.php?paper_id="+obj[0]['paper_id']+"'>論文下載</a>");
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
            $('#journal').html("<input type='text' class='form-control' name='journal' value='"+obj[0]['journal']+"' required>");
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

function fileupload(paper_id) {
    let data = {
        "paper_id": paper_id
    };

    $.post("php/paper_view.php", data, function(msg){
        var obj = JSON.parse(msg);
        if (obj == "" || obj == null) {
            console.log("查無資料!!");
        } else {
            console.log(obj);
            $('#FileUpload_paper_id').val(obj[0]['paper_id']);
        }
    });
}

function category() {
    let val = $('#search option:selected').val();
    let text = $('#search option:selected').text();
    if (val == "report_time"){
        $('#keyword').attr("type","date");
    }else if(val == "publish"){
        $('#keyword').attr("type","number");
    }else{
        $('#keyword').attr("type","text");
    }
}

function keyword_search() {
    let val = $('#search').val();
    let text = $('#keyword').val();

    setCookie("search", "searching", 365);
    setCookie("category", val, 365);
    setCookie("keyword", CodeCookie(text), 365);

    window.location.reload();
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//編碼程序：
function CodeCookie(str) {
    var strRtn="";

    for (var i=str.length-1;i>=0;i--)
    {
        strRtn+=str.charCodeAt(i);
        if (i) strRtn+="a"; //用a作分隔符
    }
    return strRtn;
}

//解碼程序：
function DecodeCookie(str) {
    var strArr;
    var strRtn="";

    strArr=str.split("a");

    for (var i=strArr.length-1;i>=0;i--)
        strRtn+=String.fromCharCode(eval(strArr[i]));

    return strRtn;
}