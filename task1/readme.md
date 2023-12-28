<b>Настройка БД</b>
<br />
1. Исправить аномально большие значения следующих полей: <br />
max_binlog_cache_size, <br />
max_binlog_stmt_cache_size, <br />
max_join_size, <br />
max_write_lock_count, <br />
max_seeks_for_key, <br />
2. Определить является ли нужным индекс на столбец creation_date

<b>Некоторые замечания</b>
1. Вынести логику строителя запроса в отдельный класс (QueryBuilder)
2. Желательно бы не использовать PDO::quote, так она не самая безопасная
3. Так как у нас не стоит declare(strict_types=1), то данный код работать должен, 
но в ином случае будет несоответствие типов в _getInCondition. 
Быстрое решение - убрать <br/>
   $quotedValues = array_map(fn(string $value) => $this->_quoteString($value), $uniqueValues)
