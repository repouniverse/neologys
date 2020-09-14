        <div class="container">
    		<div class="row">
				<div class="col-md-12">					
					<div style="display:inline-block;width:100%;overflow-y:auto;">
					<ul class="timeline timeline-horizontal">
					<?php foreach($datos as $dato) {
                                            echo $this->render('ciclo',['dato'=>$dato]);
                                        } ?>	
					</ul>
				</div>
				</div>
			</div>
			
		</div>


 




