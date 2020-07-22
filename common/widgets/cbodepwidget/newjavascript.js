$(document).ready(function() {
    $('#importcargamasiva-modelo').on('change',function(){
  
  $.ajax({ 
   url:'/yii-application/frontend/web/import/finder/combodependiente',
   type:'get',
   dataType:'html',
   data:{
   valorfiltro:$('#').value,
   clase:'',
   campoclave:'',
   camporef:''
   },
   success: function (data) {// success callback function
           $('#').html(data);
    }
       }); //ajax 
        } //on change
    );//on change
     });


