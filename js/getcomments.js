google.load("feeds", "1") //Load Google Ajax Feed API (version 1)
var rssoutput='';
var hastagtwitter='';
var idNote='';
function gfeedfetcher2(){	
	this.feedlabels=[] //array holding lables for each RSS feed
	this.feedurls=[]
	this.feeds=[] //array holding combined RSS feeds' entries from Feed API (result.feed.entries)	
	this.feedlimit=30
	this.itemcontainer="<li>" //default element wrapping around each RSS entry item
}
gfeedfetcher2.prototype.addFeed=function(label, url,note){
	this.feedlabels[this.feedlabels.length]=label
	this.feedurls[this.feedurls.length]=url;
	hastagtwitter=label;
	idNote=note;
}
gfeedfetcher2.prototype.init=function(){	
	//$("#blog").html('<p><img src="indicator.gif" /> Retrieving RSS feed(s)</p>');
	rssoutput='';
	
	this.feeds=[] //reset feeds[] array to empty (in case init() is called more than once)
		
	for (var i=0; i<this.feedurls.length; i++){ //loop through the specified RSS feeds' URLs
		var feedpointer=new google.feeds.Feed(this.feedurls[i]) //create new instance of Google Ajax Feed API
		feedpointer.setResultFormat(google.feeds.Feed.XML_FORMAT);
		//feedpointer.includeHistoricalEntries();
		feedpointer.setNumEntries(this.feedlimit) //set number of items to display
		feedpointer.load(function(){
			return function(result){				
				var thisfeed=(!result.error)? result.xmlDocument.getElementsByTagName('item') : "" //get all feed entries as a JSON array or "" if failed
					if (thisfeed==""){ //if error has occured fetching feed
						alert("Some comments posts could not be loaded: "+result.error.message);
					}
				var p=0;		
				$(".commentsList").remove();
				var commentsList='';
					for (var i=0; i<thisfeed.length; i++){ //For each entry within feed	
						var item = thisfeed[i];
						
						var arrItem = item.childNodes;
						
						
						var content='';						
						var content_b=0;
						
						var pubDate='';
						var pubDate_b=0;
						
						var author='';
						var author_b=0;
						for(var k=0; k<arrItem.length;k++){
							if(arrItem[k].nodeName=="content:encoded" && content_b==0){
								content=arrItem[k].firstChild.nodeValue;	
								contentclear=content.replace(/(?:<(?:script|style)[^>]*>[\s\S]*?<\/(?:script|style)>|<[!\/]?[a-z]\w*(?:\s*[a-z][\w\-]*=?[^>]*)*>|<!--[\s\S]*?-->|<\?[\s\S]*?\?>)[\r\n]*/gi, '');
								content_b=1;								
							}
							if(arrItem[k].nodeName=="pubDate" && pubDate_b==0){
								pubDate=arrItem[k].firstChild.nodeValue;
								pubDate_b=1;								
							}
							if(arrItem[k].nodeName=="author" && author_b==0){
								author=arrItem[k].firstChild.nodeValue;
								author_b=1;								
							}
						}
						var parseddate=new Date(pubDate)
						var itemdate=parseddate.toLocaleDateString()
						
						commentsList+='<p class="wp_author">'+author+' --- '+itemdate+'</p>';
						commentsList+='<p class="wp_comment">'+contentclear+'</p>';
						
						
					}
					
					$( "#popupComment"+idNote ).popup({
				    	beforeopen: function( event, ui ) {				        	
				    		$(".klbloglist").html(commentsList);
				        	}
				    	});					
					if(hastagtwitter.trim()){
					$.ajax({ 
		                type: "POST",
		                data: { 'hastag': hastagtwitter},
		                url: 'blogs/gettwitter/',
		                success: 
		        		function(response){	
		                	
		                	$("#commentstwitter"+idNote).html(response);
		                	var restantes;
		                    $("#txt_comments_t"+idNote).keyup(function() {
		                        var limit = $(this).attr("maxlength"); // Límite del textarea
		                        var value = $(this).val();             // Valor actual del textarea
		                        var current = value.length;              // Número de caracteres actual
		                        if (limit < current) {                   // Más del límite de caracteres?
		                            // Establece el valor del textarea al límite
		                            $(this).val(value.substring(0, limit));
		                        }
		                        restantes = 140 - current;
		                        $("#numberRest"+idNote).html('-' + restantes + '-');
		                    });

		                    var actual = $("#txt_comments_t"+idNote).val();
		                    var current = actual.length;
		                    restantes = 140 - current;
		                    $("#numberRest"+idNote).html('-' + restantes + '-');
		        		}
		        });// end GET FIND HASTAG TWITTER
					}
					
			}
		}(this.feedlabels[i])) //call Feed.load() to retrieve and output RSS feed.
	}
}

















