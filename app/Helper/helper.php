<?php

function p($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function pd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}

function getAdminUrl()
{
    return 'admin';
}

function checkSelected($name, $tableData, $data){
    if(!empty(old($name)) && old($name) == $data){
        return 'selected';
    }

    if(empty(old($name)) && $tableData == $data){
        return 'selected';
    }
}

function renderOptionsSameValue($name, $tableData, $value){
    foreach($value as $value){
        echo '<option '.checkSelected($name, $tableData, $value).' value="'.$value.'">'.$value.'</option>';
    }
}

function renderOptions($name, $tableData, $value, $inner){
        echo '<option '.checkSelected($name, $tableData, $value).' value="'.$value.'">'.$inner.'</option>';
}
