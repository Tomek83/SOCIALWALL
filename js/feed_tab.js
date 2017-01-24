$(document).ready(function(){
$('.box').ready(function(){
$.get('ajax.php', {},
function(data){
var result=eval('('+data+')')
if(result.STATUS==250) {
	for (var n in result.RESULT) {
		for (var l in result.RESULT[n]) {
			$('#feed_'+n+' ul').append(result.RESULT[n][l]);
		}
	}
}
else {
	alert(result.MESSAGE);
}
});
});
$('.feed_b').hover(
function(){$(this).animate({'right':'+='+$(this).width()+'px'});}, 
function(){$(this).animate({'right':'+=-'+$(this).width()+'px'});}
);
});
