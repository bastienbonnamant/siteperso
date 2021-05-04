<?php

namespace App\Model;

class BlogManager extends AbstractManager
{
    public const TABLE = 'blog';

    public function insert(array $blog): int
    {
        $statement = $this->pdo->prepare(" INSERT INTO " . self::TABLE . " (`title`, `date`, `name`, `text`) 
        VALUES (:title,:date,:name,:text)");
        $statement->bindValue('title', $blog['title'], \PDO::PARAM_STR);
        $statement->bindValue('date', $blog['date'], \PDO::PARAM_INT);
        $statement->bindValue('name', $blog['name'], \PDO::PARAM_STR);
        $statement->bindValue('text', $blog['text'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $blog): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title`=:title, `date`=:date, 
        `name`=:name, `text`=:text WHERE id=:id");
        $statement->bindValue('id', $blog['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $blog['title'], \PDO::PARAM_STR);
        $statement->bindValue('date', $blog['date'], \PDO::PARAM_INT);
        $statement->bindValue('name', $blog['name'], \PDO::PARAM_STR);
        $statement->bindValue('text', $blog['text'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
