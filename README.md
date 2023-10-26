# Классы-помощники для работы с массивами
## Документация
  * [Documentation](https://github.com/TheWhatis/SupportArr/tree/master/docs/markdown/index.md "Documentation")
## Установка
```
composer require whatis/support-arr
```
## Использование
```php
<?php
/// ... Подключение пакета (require_once 'vendor/autoload.php')


use Whatis\Support\Arr;

$array = [
    'key' => 'value',
    'array' => [
        'key' => 'value',
        'entryarray' => [
            'key' => 'value'
        ]
    ]
];

// Получение значений
echo Arr::get($array, 'key'); // > value
echo Arr::get($array, 'array.key'); // > value

var_dump(Arr::get($array, 'array'));
// > [
// >    'key' => 'value',
// >    'entryarray' => [
// >        'key' => 'value'
// >    ]
// > ]

// Установка значений
Arr::set($array, 'array.key1', 'myvalue');
var_dump($array);
// > [
// >     'key' => 'value',
// >     'array' => [
// >         'key' => 'value',
// >         'key1' => 'myvalue'
// >         'entryarray' => [
// >             'key' => 'value'
// >         ]
// >     ]
// > ]
// ... И т.д.
```
