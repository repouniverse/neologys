  <div class="col-xs-12 col-md-8">
      <?=$form->field($useruniversidad,"[$i]id")->
 hiddenInput()->label(false) ?>
      
<?=$form->field($useruniversidad,"[$i]activo")->
 checkBox(['label'=> \yii\helpers\StringHelper::mb_ucwords(
         strtolower($useruniversidad->universidad->nombre))]
         ) ?>
 
</div>
