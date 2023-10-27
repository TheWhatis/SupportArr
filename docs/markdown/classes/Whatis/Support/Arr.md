***

# Arr

Вспомогательный класс массивов

Вспомогательный класс
для работы с массивами

PHP version 8

* Full name: `\Whatis\Support\Arr`

**See Also:**

* https://github.com/TheWhatis/Settings - 




## Methods


### accessible

Проверка что значение сопоставляемое массиву

```php
public static accessible(mixed $value): bool
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$value` | **mixed** | Значение |




***

### exists

Проверить что ключ есть в массиве

```php
public static exists(string|int $key, array|\ArrayAccess $array): bool
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **string&#124;int** | Ключ |
| `$array` | **array&#124;\ArrayAccess** | Массив |




***

### dot

Создать dotted массив

```php
public static dot(iterable $iterable, string $prefix = &#039;&#039;): array
```

Преобразовывает массив в
одномерный, в котором
вложенность переданного
массива определяется
ключами в одномерном

Каждый отдельный ключ -
это ключи, разделенные
точками, определяющие
вложенность переданного
массива, пример: `path.to.key`

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$iterable` | **iterable** | Итерируемый объект |
| `$prefix` | **string** | Профикс (необходим<br />для генерации) |




***

### undot

Развернуть dotted массив

```php
public static undot(array $array): array
```

Разворачивает dotted массив
(см. метод {@see \Whatis\Support\Arr::dot()})

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | Массив |




***

### set

Установить значение в массив

```php
public static set(array& $array, string|int $key, mixed $value): array
```

Установить значение в массив
по ключу (вложенные ключи,
разделенные точками)

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array** | Массив |
| `$key` | **string&#124;int** | Ключ |
| `$value` | **mixed** | Значение |




***

### get

Получить значение из массива
по ключу

```php
public static get(array|\ArrayAccess $array, string|int $key, mixed $default = null): mixed
```

Можно прописать путь через точку:
`path.to.key`

* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$array` | **array&#124;\ArrayAccess** | Массив |
| `$key` | **string&#124;int** | Ключ |
| `$default` | **mixed** | Значение по-умолчанию |




***


***
> Automatically generated from source code comments on 2023-10-27 using [phpDocumentor](http://www.phpdoc.org/) and [saggre/phpdocumentor-markdown](https://github.com/Saggre/phpDocumentor-markdown)
