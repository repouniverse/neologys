$('div[id="ajax_total"] [family="holas"]').on( 'click', function() { 
        // alert(this.title);
     var yapaso=false;
   if(!yapaso){  
        $.ajax({
              url: this.title,
              
              type: 'POST',
              data:JSON.parse(this.id)    ,
              dataType: 'json', 
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              
              success: function(json) {
             
               //alert(typeof json['dfdfd']==='undefined');
                        var n = Noty('id');
                        
                           $.pjax.reload({container: '#ajax_total', async: false});
                         
                           
                             

                       if ( !(typeof json['error']==='undefined') ) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                          }    

                             if ( !(typeof json['warning']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['warning']);
                              $.noty.setType(n.options.id, 'warning');  
                             } 
                          if ( !(typeof json['success']==='undefined' )) {
                        $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['success']);
                              $.noty.setType(n.options.id, 'success');  
                             } 
                            
                            }
                                        
                        });  
                       yapaso=true; 
                     }      
                        })