function remLesson(subject,code,course,teacher,room,day,time) {
	var width = $("#timetable").width();
	$.post("save.php", {action:'rem',subject:subject,code:code,course:course,teacher:teacher,room:room,day:day,time:time,width:width} , function(data)
	{
		$("#timetable").html(data);
		listSubs();
	});
}


function saveLesson(subject,code,course,teacher,room,day,time,vis) {
	var width = $("#timetable").width();
	$.post("save.php", {action:'add',subject:subject,code:code,course:course,teacher:teacher,room:room,day:day,time:time,vis:vis,width:width} , function(data)
	{
		$("#timetable").html(data);
		listSubs();
	});
}

function listTimeTable()
{
	var width = $("#timetable").width();
	$.post("save.php", {width:width},function(data)
    {
    	$("#timetable").html(data);
    });
}

function listSubs()
{
	var felev=$("#felev").val();
	var korlat=$("#darab").val();
	var keres=$("#subject").val().trim();
	var melyik=$("#search").val();
	var nar=$("#nar").val();
	var width=$("#tar").width();

	if(melyik == "nevalapjan"){
		listByName(melyik,felev,korlat,keres,nar,width);
	}	
	if(melyik == "kodalapjan"){
		listByCode(melyik,felev,korlat,keres,nar,width);
	}
	if(melyik == "oktnevalapjan"){
		listByTeacher(melyik,felev,korlat,keres,nar,width);
	}
}

function addCustomCourse()
{
	var subject = $("#cc_subject").val();
	var code = $("#cc_code").val();
	var day = $("#cc_day").val();
	var time = $("#cc_time").val();
	var room = $("#cc_room").val();
	var teacher = $("#cc_teacher").val();
	var course = $("#cc_course").val();

	$.post("addcc.php", {subject:subject,code:code,course:course,day:day,time:time,room:room,teacher:teacher,vis:'true'} , function(data)
	{
		listTimeTable();
		$("#error").html(data);
	});
}

function listByName(melyik,felev,korlat,keres,nar,width)
{
	$.post("data.php",{melyik:melyik, felev:felev,limit:korlat,targynev:keres,nar:nar,width:width},function(data){
		$("#tar").html(data);
	});
}
function listByCode(melyik,felev,korlat,keres,nar,width)
{
	$.post("data.php",{melyik:melyik, felev:felev,limit:korlat,targykod:keres,nar:nar,width:width},function(data){
		$("#tar").html(data);
	});
}
function listByTeacher(melyik,felev,korlat,keres,nar,width)
{
	$.post("data.php",{melyik:melyik, felev:felev,limit:korlat,oktnev:keres,nar:nar,width:width},function(data){
		$("#tar").html(data);
	});
}

$("#lister").submit(function(e){
	e.preventDefault();
	listSubs();
});

$(document).ready(function()
{
	listTimeTable();
	$("#subject").focus();
});

$("#tt_export").click(function()
{
	$.post("eximport.php",{action:"export"},function(data)
	{
		$("#eximdata").val(data);
	});
});

$("#tt_import").click(function()
{
	var data = $("#eximdata").val();
	$.post("eximport.php",{action:"import",data:data},function(data)
	{
		$("#eximdata").val(data);
		var width = $("#timetable").width();
		$.post("save.php", {width:width},function(data)
		{
			$("#timetable").html(data);
		});
	});
});

$("#gcexport").submit(function(e)
{
	e.preventDefault();
	window.open("exgoogle.php?weeks=" + parseInt($("#weeks").val()));
});

$("#cc_form").submit(function(e)
{
	e.preventDefault();
	addCustomCourse();
});

setInterval(() => {
	$.get("session_reset.php");
}, 60000);