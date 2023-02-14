<?php

namespace TaskForce\classes\Additions;

use SplFileObject;
use TaskForce\classes\Exceptions\FileExistingException;
use TaskForce\classes\Exceptions\FileFormatException;

class CsvToSqlTranslation {

    private string $filecsv;
    private array $columns;
    private $fileObject;

    private array $result = [];
    private ?string $error = null;

    public function __construct(string $filecsv, array $columns)
    {
        $this->filecsv = $filecsv;
        $this->columns = $columns;
    }

    public function importCsv(): void
    {
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException("Invalid column headers are set!");
        }

        if (!file_exists($this->filecsv)) {
            throw new FileExistingException("File $this->filecsv doesn't exist!");
        }

        try {
            $this->fileObject = new SplFileObject($this->filecsv);
        }
        catch (RuntimeException $exception) {
            throw new FileExistingException("Could not open the file for reading!");
        }

        $this->fileObject->setFlags(
            SplFileObject::DROP_NEW_LINE |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::READ_CSV
        );

        $header_data = $this->getHeaderData();

        if ($header_data !== $this->columns) {
            throw new FileFormatException("The source file does not contain the required columns!");
        }

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }
    }

    public function getData(): array
    {
        return $this->result;
    }

    private function getHeaderData(): ?array
    {
        $data = $this->fileObject->fgetcsv();
        return $data;

        var_dump($this->getHeaderData());
    }

    private function getNextLine(): ?iterable {
        $result = null;

        while (!$this->fileObject->eof()) {
            yield $this->fileObject->fgetcsv();
        }

        return $result;
    }

    private function validateColumns(array $columns):bool
    {
        $result = true;

        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    $result = false;
                }
            }
        }
        else {
            $result = false;
        }

        return $result;
    }

    public function generateSqlFile(string $tableName): void
    {
        $this->tableName = $tableName;

        $data = $this->importCsv();
        $file = new SplFileObject($tableName . '.sql', 'w');

        foreach ($data as $string) {
            $values = '"' . implode('","', $string) . '"';

            $string = 'INSERT INTO ' . $tableName . ' (' . implode(",", $this->columns) .') ' . 'VALUES (' . $values . ');' . PHP_EOL;

            $file->fwrite($string);
        }
    }
}
