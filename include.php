<?php

/**
 * Функция осуществляет обертку указанного значения последовательно по переданному массиву ключей
 *
 * @param array $keys
 * @param $value
 *
 * @return array|null
 */
function wrap(array $keys, $value)
{
    $result = $value;

    foreach ($keys as $key) {
        $result = array(
            $key => $result
        );
    }

    return $result;
};