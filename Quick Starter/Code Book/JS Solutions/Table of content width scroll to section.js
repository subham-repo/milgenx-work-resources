var prevH2Item = null;                                                            
var prevH2List = null; 
var index = 0;    
var offHeight = jQuery('#headerinsidewrap').height() + 0;	
jQuery(".entry-content h3 , .entry-content h2").each(function() {         
	var anchor = "<a  id='"+index+"'  name='" + index + "' value='" + index + "'></a>";     
	jQuery(this).before(anchor);                                     
	
	var li     = "<li><a class='scolltohead' href='#' value='" + index + "' >" + jQuery(this).text() + "</a></li>";      
	prevH2Item = jQuery(li);                                                               
	prevH2Item.appendTo("#toc");                         
														   
	index++;                                                     
});         

  jQuery(".scolltohead").click(function(e){
	e.preventDefault();
	var id = jQuery(this).attr("value");
	jQuery([document.documentElement, document.body]).animate({
		scrollTop: jQuery("#"+id+"").offset().top - offHeight
	}, 2000);
});  