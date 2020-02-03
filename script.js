var GWidth;
var GHeight = 75;

function handler(events, target, func) {
    $(document).on(events,target,func);
}

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
$(document).ready(function()
{
	listTimeTable();
	$("#subject").focus();
	GWidth = ($("#timetable").width()-64)/5;
});

handler("submit","#lister",function (e){
	e.preventDefault();
	listSubs();
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

handler("mouseleave",".hov",function() {
	var width = $(this).attr("gwidth");
	var height = $(this).attr("gheight");
	var font = $(this).attr("gfont");
	var xpos = $(this).attr("gxpos");
	
	$(this).css("z-index",0);
	$(this).clearQueue();
	$(this).animate({
		width: width,
		height: height,
		fontSize:font + "px",
		left:xpos + "px",
	},100);
});

handler("mouseenter",".hov",function() {	
	var width = GWidth;
	var height = GHeight*2;
	height = Math.max($(this).attr("gheight"),height);

	$(this).css("z-index",1);
	$(this).clearQueue();
	$(this).animate({
		width: width,
		height: height,
		fontSize:"14px",
		left:$(this).attr("gxfix") + "px",
	},100);
});
