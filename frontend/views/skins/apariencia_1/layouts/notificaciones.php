                <li class="dropdown notifications-menu">
                    <a href="#" id="campanita" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-eraser"></i>
                        
                    </a>
                   
                </li>
                <?php $cadenaJs="$('#campanita').on('click',function(){  $.ajax({"
                        . "url: '".\yii\helpers\Url::toRoute('/site/clear-cache')."', "
                        ." type:'GET', "
                        ." dataType: 'json', "
                        ." success: function(json) {
                            var n = Noty('id');
                             $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success'); 
                   
                        }  "
                            . " "
                        . "});  })";  ?>
                <?php $this->registerJs($cadenaJs,$this::POS_END);   ?>