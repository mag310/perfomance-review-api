<?php

namespace app\interfaces;

interface CommentInterface
{
    public function toArray(): array;

    public function getPrId(): string;

    public function setPrId(?string $prId): self;

    public function getAuthorId(): string;

    public function setAuthorId(string $value): self;

    public function setId(string $value): self;

    public function setText(?string $text): self;

    public function setRating(?int $rating): self;
}