<?php
use dosamigos\chartjs\ChartJs;
?>
 <?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        'height' => 180,
        'width' => 400,
        'title'=>[
            display=> true,
            text=> yii::t('sigi.labels','Consumos mensuales'),
        ],
    ],
    'data' => [
        'labels' =>array_keys($lecturas),
        'datasets' => [
            [
                'label' => yii::t('sta.labels',"Del mes"),
                'backgroundColor' => "rgba(255,157,64,0.9)",
                'borderColor' => "rgba(60,117,9,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => array_values($lecturas),
            ],
           
        ]
    ]
]);
?>
