<?php

function getRole($id)
{
    $roles=['2'=>'Usuario normal','1'=>'Administrador','0'=>'Administrador'];
    return $roles[$id];
}

function getStatus($value)
{
    $status = [
        'PUBLISHED' => 'Publicado',
        'DRAFT' => 'Borrador',
    ];
    return $status[$value];
}

function cleanT($value)
{
    $value = str_replace('"', '', $value);
    $value = str_replace(array("<p>","</p>"), "", $value);
    return $value;
}