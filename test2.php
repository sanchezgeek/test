<?php

include 'include.php';

/**
 * Написать функцию которая из этого массива
 */
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];

//сделает такой и наоборот
$data = [
    'parent' => [
        'child' => [
            'field' => 1,
            'field2' => 2,
        ]
    ],
    'parent2' => [
        'child' => [
            'name' => 'test'
        ],
        'child2' => [
            'name' => 'test',
            'position' => 10
        ]
    ],
    'parent3' => [
        'child3' => [
            'position' => 10
        ]
    ],
];

/**
 * Функция выполняет прямое преобразование переданного массива
 *
 * @param array $data
 *
 * @return array
 */
function convert(array $data)
{
    $result = array();

    foreach ($data as $keys => $value) {
        $keys = explode('.', $keys);

        $result = array_merge_recursive(
            $result,
            wrap(array_reverse($keys), $value)
        );
    }

    return $result;
}

/**
 * Функция выполняет обратное преобразование переданного массива
 *
 * @param array $data
 * @param string $previous
 *
 * @return array
 */
function convertBack(array $data, $previous = '')
{
    $result = array();

    foreach ($data as $key => $value) {
        $current = $previous . $key;

        if (is_array($value)) {
            $result = array_merge($result, convertBack($value, $current . '.'));
        } else {
            $result[$current] = $value;
        }
    }

    return $result;
}

$result1 = convert($data1);
$result2 = convertBack($result1);

print_r($result1);
print_r($result2);
