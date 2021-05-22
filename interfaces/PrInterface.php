<?php

namespace app\interfaces;

interface PrInterface
{
    public function getId();

    public function getUserId(): ?string;

    public function setUserId(?string $userId): self;

    public function getManagerId(): ?string;

    public function setManagerId(?string $managerId): self;

    public function setResume(?string $resume): self;

    public function getResume(): ?string;

    public function toArray(): array;
}