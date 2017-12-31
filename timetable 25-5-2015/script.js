$(document).ready(function(){	

	var dragArray = ["#a", "#b", "#c", "#d", "#e", "#f","#g","#h","#i","#j","#k","#l","#m","#n","#o","#p","#q","#r"];
	$.each(dragArray, function(index, value){
		$(value ).draggable({
			helper: "clone",
			cursor: "move",
			start: function(){
			contents = $(this).text();
				}
			});
	});	
	var dropArray = ["#00", "#01", "#02", "#03", "#04","#05"
					,"#10", "#11", "#12", "#13", "#14", "#15"
					,"#20", "#21", "#22", "#23", "#24", "#25"
					,"#30", "#31", "#32", "#33", "#34", "#35"
					,"#40", "#41", "#42", "#43", "#44", "#45"
					,"#50", "#51", "#52", "#53", "#54", "#55"
					,"#60", "#61", "#62", "#63", "#64", "#65"
					,"#70", "#71", "#72", "#73", "#74", "#75"];	
					
	$.each(dropArray, function(index, value){
		
			$( value ).droppable({
					 hoverClass:  "hover",
						drop: function( event, ui ) {
						   $( this )
						   .addClass( "ui-state-highlight" )
						   .find( "p" )
						   .append(contents);
								$.post("post.php",
									{
										cellid: index+1,
										celldata: contents
									},
								function(data)
									{
										$('#success').text(data);
										$(value).droppable('destroy');
									});
						}
					 });
				 
			$(value).dblclick(function(){
								$.post("post.php",
												{
													cellid: index+1
												},
											function(data)
												{	
													location.reload();
													$('#success').text(data);
												});
							}); 
			
	});			
});