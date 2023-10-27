<?php
/**
 * Файл с вспомогательным
 * классом для взаимодействия
 * с массивами
 *
 * PHP version 8
 *
 * @category Support
 * @package  Settings
 * @author   Whatis <anton-gogo@mail.ru>
 * @license  unlicense
 * @link     https://github.com/TheWhatis/Settings
 */

namespace Whatis\Support;

use ArrayAccess;

/**
 * Вспомогательный класс массивов
 *
 * Вспомогательный класс
 * для работы с массивами
 *
 * PHP version 8
 *
 * @category Support
 * @package  Settings
 * @author   Whatis <anton-gogo@mail.ru>
 * @license  unlicense
 * @link     https://github.com/TheWhatis/Settings
 */
class Arr
{
    /**
     * Проверка что значение сопоставляемое массиву
     *
     * @param mixed $value Значение
     *
     * @return bool
     */
    public static function accessible(mixed $value): bool
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    /**
     * Проверить является ли
     * массив ассоциативным
     *
     * @param array $array Массив
     *
     * @return bool
     */
    public static function isAssoc(array $array): bool
    {
        return array_keys(
            $keys = array_keys($array)
        ) !== $keys;
    }

    /**
     * Проверить что ключ есть в массиве
     *
     * @param string|int        $key   Ключ
     * @param array|ArrayAccess $array Массив
     *
     * @return bool
     */
    public static function exists(
        string|int $key,
        array|ArrayAccess $array
    ): bool {
        if (is_array($array)) {
            return array_key_exists($key, $array);
        }

        return $array->offsetExists($key);
    }

    /**
     * Создать dotted массив
     *
     * Преобразовывает массив в
     * одномерный, в котором
     * вложенность переданного
     * массива определяется
     * ключами в одномерном
     *
     * Каждый отдельный ключ -
     * это ключи, разделенные
     * точками, определяющие
     * вложенность переданного
     * массива, пример: `path.to.key`
     *
     * @param iterable $iterable Итерируемый объект
     * @param string   $prefix   Профикс (необходим
     *                           для генерации)
     *
     * @return array
     */
    public static function dot(
        iterable $iterable,
        string $prefix = ''
    ): array {
        $result = [];
        foreach($iterable as $key => $value) {
            // Если массив то перебираем
            // внутренние элементы с
            // помощью static::dot
            if(static::accessible($value)) {
                $result = array_merge(
                    $result, static::dot(
                        $value, $prefix . $key . '.'
                    )
                );

                // И пропусаем добавление
                // значения для родителя
                continue;
            }

            // Добавляем значение в массив
            $result[$prefix . $key] = $value;
        }

        return $result;
    }

    /**
     * Развернуть dotted массив
     *
     * Разворачивает dotted массив
     * (см. метод {@see Arr::dot()})
     *
     * @param array $array Массив
     *
     * @return array
     */
    public static function undot(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            static::set($result, $key, $value);
        }

        return $result;
    }

    /**
     * Установить значение в массив
     *
     * Установить значение в массив
     * по ключу (вложенные ключи,
     * разделенные точками)
     *
     * @param array      $array Массив
     * @param string|int $key   Ключ
     * @param mixed      $value Значение
     *
     * @return array
     */
    public static function set(
        array &$array,
        string|int $key,
        mixed $value
    ): array {
        foreach (($keys = explode('.', $key)) as $index => $key) {
            // Если последний элемент, то
            // устанавливем соответствующее
            // значение в конец
            if ($index === array_key_last($keys)) {
                $array[$key] = $value;
                break;
            }

            $array = &$array[$key];
        }

        return $array;
    }

    /**
     * Получить значение из массива
     * по ключу
     *
     * Можно прописать путь через точку:
     * `path.to.key`
     *
     * @param array|ArrayAccess $array   Массив
     * @param string|int        $key     Ключ
     * @param mixed             $default Значение по-умолчанию
     *
     * @return mixed
     */
    public static function get(
        array|ArrayAccess $array,
        string|int $key,
        mixed $default = null
    ): mixed {
        // Если есть вложенность
        if (strpos($key, '.') === false) {
            // Если ключ в массиве есть, то
            // возвращаем его, иначе значение
            // по-умолчанию
            return $array[$key] ?? $default;
        }

        // Ищем значение в массиве
        foreach (explode('.', $key) as $segment) {
            if (static::accessible($array) && static::exists(
                $segment, $array
            )
            ) {
                $array = $array[$segment];
                continue;
            }

            return $default;
        }

        // Возвращаем значение
        return $array;
    }
}
