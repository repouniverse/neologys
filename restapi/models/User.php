<?php
namespace restapi\models;

class User extends \common\models\User
{
    public function fields()
    {
        return [
            'username',
            'estado' => 'status',
            'created_at'
        ];
    }

}