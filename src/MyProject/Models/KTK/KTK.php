<?php

namespace MyProject\Models\KTK;
use MyProject\Models\Users\User;

use MyProject\Models\ActiveRecordEntity;

class KTK extends ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var string */
    protected $authorId;

    /** @var string */
    protected $createdAt;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    protected static function getTableName(): string
    {
        return 'ktk';
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return (int) $this->authorId;
        // return User::getById($this->authorId);
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        // var_dump(User::getById($this->authorId));
        return User::getById($this->authorId);
    }


    public function setName($name): string
    {
        return $this->name=$name;
    }

    public function setText($text): string
    {
        return $this->text=$text;
    }

    public function setcreatedAt($date): string
    {
        return $this->createdAt=$date;

    }

    public function setauthorId($Id): string
    {
        return $this->authorId=$Id;

    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public static function createFromArray(array $fields, User $author): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new Article();

        $article->setAuthor($author);
        $article->setName($fields['name']);
        $article->setText($fields['text']);

        $article->save();

        return $article;
    }

    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);

        $this->save();

        return $this;
    }
}