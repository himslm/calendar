//Get Server Time and display within site top-div
$(document).ready(function getTime(){
	$("#time").load("../ajax/getTime.php?r="+Math.random());
	setTimeout(function(){getTime()}, 60000);
	$('#dev-title').fadeIn(1000);	
	$('#logo').fadeIn(1000);

	//Sets Calendar Table Rows to equal heights to expand heigh of table to height of Window innerHeight
	var rowCount = $('#calendar tr').length - 1;
	$('#calendar td').css('height', ($(window).innerHeight() / rowCount) - ((83 + rowCount) / rowCount));
	$(window).resize(function(){
		$('#calendar td').css('height', ($(window).innerHeight() / rowCount) - ((83 + rowCount) / rowCount));
	});
});

