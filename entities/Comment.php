<?php


namespace app\entities;

use app\interfaces\CommentInterface;

/**
 * Сущность комментария
 */
class Comment implements CommentInterface
{
    public $id;
    public $prId;
    public $authorId;
    public $rating;
    public $text;
    public $hidden = false;
    public $status = 'add';
    public $date;

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return int
     */
    public function getPrId(): string
    {
        return $this->prId;
    }

    /**
     * @param string|null $prId
     * @return CommentInterface
     */
    public function setPrId(?string $prId): CommentInterface
    {
        $this->prId = $prId;

        return $this;
    }

    /**
     * @return int
     */
    public function getAuthorId(): string
    {
        return $this->authorId;
    }

    public function setAuthorId(?string $value): CommentInterface
    {
        $this->authorId = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId(string $value): CommentInterface
    {
        $this->id = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return CommentInterface
     */
    public function setText(?string $text): CommentInterface
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int|null $rating
     * @return CommentInterface
     */
    public function setRating(?int $rating): CommentInterface
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


    public function setDate(string $date): CommentInterface
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     * @return CommentInterface
     */
    public function setHidden(bool $hidden): CommentInterface
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return CommentInterface
     */
    public function setStatus(string $status): CommentInterface
    {
        $this->status = $status;

        return $this;
    }
}