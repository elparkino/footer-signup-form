$(document).ready(function(){  
   $('#newsletter-signup').submit(function(){  
  
  		var form = $(this),  
    		formData = form.serialize(),  
    		formUrl = form.attr('action'),  
    		formMethod = form.attr('method'),   
    		responseMsg = $('#signup-response');

    	//show response message - waiting  
		responseMsg.hide()  
           .addClass('response-waiting')  
           .text('Please Wait...')  
           .fadeIn(200);

   		//send data to server  
        $.ajax({  
            url: formUrl,  
            type: formMethod,  
            data: formData,  
            success:function(data){  
        		//setup variables  
    			var responseData = jQuery.parseJSON(data),   
        		klass = '' ;

        		//response conditional  
				switch(responseData.status){  
    			case 'error':  
        			klass = 'response-error';  
    			break;  
    			case 'success':  
        			klass = 'response-success';  
    			break; 
    			//show reponse message  
				responseMsg.fadeOut(200,function(){  
    				$(this).removeClass('response-waiting')  
           				   .addClass(klass)  
           				   .text(responseData.message)  
           				   .fadeIn(200,function(){  
               				//set timeout to hide response message  
               					setTimeout(function(){  
                   					responseMsg.fadeOut(200,function(){  
                       					$(this).removeClass(klass);  
                   					});  
               					},3000);
            				  });  
				});
            }  
        }); 

   
}  
        
  
        //prevent form from submitting  
        return false;  
    })  
})