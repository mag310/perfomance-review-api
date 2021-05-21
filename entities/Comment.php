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
    public $hidden;
    public $status;
    public $date;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}