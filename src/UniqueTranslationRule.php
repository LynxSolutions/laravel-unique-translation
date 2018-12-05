<?php

namespace CodeZero\UniqueTranslation;

class UniqueTranslationRule
{
    /**
     * @var string
     */
    protected $rule = 'unique_translation';

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string|null
     */
    protected $column = null;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @var string
     */
    protected $removePrefix;

    /**
     * @var mixed
     */
    protected $ignoreValue = null;

    /**
     * @var string|null
     */
    protected $ignoreColumn = null;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string|null $column
     * @param string $delimiter
     * @param string $removePrefix
     *
     * @return static
     */
    public static function for($table, $column = null, $delimiter = '.', $removePrefix = '')
    {
        return new static($table, $column, $delimiter, $removePrefix);
    }

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string|null $column
     */
    public function __construct($table, $column = null, $delimiter = '.', $removePrefix = '')
    {
        $this->table = $table;
        $this->column = $column;
        $this->delimiter = $delimiter;
        $this->removePrefix = $removePrefix;
    }

    /**
     * Ignore any record that has a column with the given value.
     *
     * @param mixed $value
     * @param string $column
     *
     * @return $this
     */
    public function ignore($value, $column = 'id')
    {
        $this->ignoreValue = $value;
        $this->ignoreColumn = $column;

        return $this;
    }

    /**
     * Generate a string representation of the validation rule.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            '%s:%s,%s,%s,%s,%s,%s',
            $this->rule,
            $this->table,
            $this->column ?: 'NULL',
            $this->ignoreValue ?: 'NULL',
            $this->ignoreColumn ?: 'NULL',
            $this->delimiter,
            $this->removePrefix
        );
    }
}
