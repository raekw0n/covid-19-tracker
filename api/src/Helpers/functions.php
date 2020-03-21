<?php

if (!function_exists('obj')) {
    function obj($data)
    {
        if (gettype($data) == 'array') {
            return (object)array_map("obj", $data);
        } else {
            return $data;
        }
    }
}