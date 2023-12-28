<?php

readonly class Repository
{
    public function __construct(
        private PDO $conn,
    ) {
    }

    /**
     * @param int[] $ids
     */
    public function loadUsersByIds(array $ids): array
    {
        $idsFilter = $this->_getInCondition('id', $ids);

        return $this->_loadObjectsByFilter('user', [$idsFilter]);
    }

    private function _quoteString(string $value): string
    {
        return $this->conn->quote($value);
    }

    private function _getInCondition(string $field, array $values): string
    {
        if (count($values) === 0) {
            return '1';
        }

        $quotedField =  $this->_quoteString($field);

        $uniqueValues = array_unique(array_filter($values));
        $quotedValues = array_map(fn(string $value) => $this->_quoteString($value), $uniqueValues);
        $implodedValues = implode(', ', $quotedValues);

        return "$quotedField IN ($implodedValues)";
    }

    private function _loadObjectsByFilter(string $objectName, array $filter = []): array
    {
        //some PDO work, result query will be SELECT * FROM $objectName WHERE ($f
        return [];
    }
}
