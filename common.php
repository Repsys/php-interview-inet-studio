<?php

$array = [
    ['id' => 1, 'date' => "12.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "02.05.2020", 'name' => "test2"],
    ['id' => 4, 'date' => "08.03.2020", 'name' => "test4"],
    ['id' => 1, 'date' => "22.01.2020", 'name' => "test1"],
    ['id' => 2, 'date' => "11.11.2020", 'name' => "test4"],
    ['id' => 3, 'date' => "06.06.2020", 'name' => "test3"],
];

// 1
function unique_md_array_by_id(array $array): array
{
    $unique_ids = [];

    return array_values(array_filter($array, function ($el) use (&$unique_ids) {
        if (in_array($el['id'], $unique_ids)) {
            return false;
        }

        $unique_ids[] = $el['id'];
        return true;
    }));
}

//var_dump(unique_md_array_by_id($array));

// 2
function sort_md_array_by_key(array $array, string $key): array
{
    usort($array, function($l, $r) use ($key) {
        return $l[$key] <=> $r[$key];
    });

    return $array;
}

//var_dump(sort_md_array_by_key($array, 'name'));

// 3
function filter_md_array(array $array, string $key, $value, bool $strict = true): array
{
    return array_values(array_filter($array, function ($el) use ($key, $value, $strict) {
        return $strict ? $el[$key] === $value : $el[$key] == $value;
    }));
}

//var_dump(filter_md_array($array, 'id', 1));

// 4
var_dump(array_column($array, 'id', 'name'));