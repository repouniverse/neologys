<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use yii\widgets\Pjax;
use common\helpers\h;


/** */
/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
/* @var $form yii\widgets\ActiveForm */


?>

<!--FORMULARIO-->
<div class="buzon-mensajes-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="panel-heading">
        <h5>
            <b>CATEGORIA</b>
        </h5>
    </div>
    <!-- DROPDOWN DEL DEPARTAMENTO -->
    <?= $form->field($model, 'departamento_id')->dropDownList(
        combo::getCboDepartamentosFacuCodepa(h::gsetting('general', 'MainFaculty'), array('OTI-FCCTP', 'REG-FCCTP')),
        [
            'prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",
            'id' => "departamento"
        ]
    )
    ?>

    <!-- ESCRIBIR EL MOTIVO -->
    <div class="panel-heading" style="margin-top: 0;">
        <h5>
            <b>MOTIVO</b>
        </h5>
    </div>
    <div class="motivos-body">
        <p class="text-secondary">Estimado alumno, este espacio ha sido diseñado para usted. Por favor, ingrese su consulta, duda o queja</p>
        <!-- OBTENEMOS EL VALOR DEL MOTIVO -->
        <?= $form->field($model, 'mensaje')->textarea(['rows' => 10, 'placeholder' => 'Ingrese su consulta']) ?>
    </div>
    <!-- DATOS PERSONALES -->
    <div class="personal-heading">
        <h5>
            <b>DATOS PERSONALES</b>
        </h5>
    </div>
    <div class="personal-body">
        <div class="form-group">
            <!-- DROPDOWN DE LA CARRERA -->
            <div class="form-group">
                <?= $form->field($model, 'esc_id')->dropDownList(
                    combo::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                    ['prompt' => '--' . yii::t('base_verbs', 'Choose a value') . "--",]
                )
                ?>
                <?= $form->field($model, 'nombres')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su nombre']) ?>
                <?= $form->field($model, 'ap')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su apellido paterno']) ?>
                <?= $form->field($model, 'am')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su apellido materno']) ?>
                <?= $form->field($model, 'numerodoc')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su dni']) ?>
                <?= $form->field($model, 'email')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su email']) ?>
                <?= $form->field($model, 'celular')->textInput(['rows' => 10, 'placeholder' => 'Ingrese su celular']) ?>

               

            </div>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h3>Cordinación academica</h3>
                </div>
                <div class="modal-body">
                    <td><input type="button" id="add" class="btn btn-primary" value="Agregar"></td>
                    <button id='del' class='btn btn-danger'>Eliminar</button>
                    <p>

                    <table id="tabla">
                        <tr>
                            <td id="Curso">Curso</td>
                            <td id="cabeza">Seccion</td>
                            <td id="cabeza">Ciclo</td>
                        </tr>
                        <tr>

                            <td><input type="text"> </td>
                            <td><input type="text"></td>
                            <!-- podemos añadir tantas columnas como deseemos -->
                            <td><input type="text"></td>


                        </tr>
                    </table>
                    </p>
                </div>

            </div>

        </div>

        <BR></BR>
        <?= Html::submitButton(Yii::t('base_verbs', 'Send'), ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
        <br></br>
        <br>
    </div>

<?php
/* AGREGANDO JQUERY */
$script = <<< JS
    //todo codigo Jquery o javascript stuffer
    $('#departamento').change(function(){
    var departamento_elegido = $(this).val();
    
    if(departamento_elegido ==134){
    modal.style.display = "block";
    }else if(departamento_elegido ==128){
    alert('OTI EN MANTENIMIENTO')  
    }

    });  
    
//prueba
    // Get the modal
var modal = document.getElementById("myModal");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
    
JS;
$this->registerJs($script);
    


?>

<!----------------------------------------------------------- MODAL  -------------------------------------------->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3>Cordinación academica</h3>
    </div>
    <div class="modal-body">
    <body>
    <script>
        function myCreateFunction() {

            var table = document.getElementById("myTable");
            var row = table.insertRow(0);
            var fila = table.insertRow();
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
        
        
            // CREO UN ELEMENTO DEL TIPO INPUT CON document.createElement("NOMBRE TAG HTML QUE QUIERO CREAR");
            var input = document.createElement("input");
            input.type = "text";
            input.className = "input1";
            input.setAttribute("onclick", "vaciar_campo(this);");
            input.style.height = "30px";
            input.style.width = "150px";
            input.style.padding = "3px 5px"
            input.placeholder = "Nombre del docente"

            // Creo un segundo elemento Input
            var input2 = document.createElement("input");
            input2.type = "text";
            input2.className = "ptss";
            input2.setAttribute("onclick", "vaciar_campo(this);");
            input2.style.height = "30px";
            input2.style.width = "150px";
            input2.style.padding = "3px 5px"
            input2.placeholder = "Curso"

            //Creo el tercer elemento Input
            var input3 = document.createElement("input");
            input3.type = "text";
            input3.className = "ptss2";
            input3.setAttribute("onclick", "vaciar_campo(this);");
            input3.style.height = "30px";
            input3.style.width = "150px";
            input3.style.padding = "3px 5px"
            input3.placeholder = "Sección"


            var campo4 = document.createElement("input");
            campo4.type = "button";
            campo4.value = "-";
            campo4.style.width = "30px"
            campo4.style.background = "#C63865"
            campo4.ClassName ="btn btn-danger"
            campo4.onclick = function()

            {

                var fila = this.parentNode.parentNode;
                var tbody = table.getElementsByTagName("tbody")[0];

                tbody.removeChild(fila);

            }


            // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO
            cell1.appendChild(input);
            cell2.appendChild(input2);
            cell2.appendChild(input3);
            cell2.appendChild(campo4);
        }



        function vaciar_campo(input) {

            input.value = "";

        }
    </script>

    <button onclick="myCreateFunction()" type="button" class="btn btn-success">
        Agregar
    </button>
    <br>
    <table id="myTable">
        <tr>  
            <input name="urlresp" type="text" id="urlresp" style="padding: 3px 5px; height: 30px; width: 150px;" onFocus="vaciar_campo(this)" value="" placeholder="Nombre del Docente">
            <input name="ptss" type="text" class="ptss" id="ptss" style="padding: 3px 5px; height: 30px; width: 150px;" onFocus="vaciar_campo(this)" value="" placeholder="Curso">
            <input name="ptss2" type="text" class="ptss2" id="ptss2" style="padding: 3px 5px; height: 30px; width: 150px;" onFocus="vaciar_campo(this)" value="" placeholder="Sección">

        </tr>
    </table>
</body>
    </div>
    
  </div>

</div>  


<!--------------------------------------------------------------- MODAL ------------------------------------------------>
<style>
.panel-heading {
    color: #333;
    background-color: #f5f5f5;

    padding: 10px 15px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    margin-top: -20px;
}

.categorias-body {
    padding: 15px;
    width: 100%;
    height: 250px;
    border-left: 1px solid #D0D3D4;
    border-right: 1px solid #D0D3D4;
    border-bottom: 1px solid #D0D3D4;
    border-top: none;
}

.personal-heading {
    color: #333;
    background-color: #f5f5f5;

    padding: 10px 15px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    margin-top: -20px;
}


.color-rojo {
    color: red
}

p {
    padding: 2px;
}

.contenedor-form {
    width: 60%;

    margin-left: 20%;
}


/*diseño del modal*/
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 50%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: red;
  float: right;
  font-size: 40px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  background-color: #f2f2f2;
  color: black;
  padding: 0 10px;
  margin: 0;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #f2f2f2;
  color: black;
}

