<?php

namespace Learning\JobManager\Api\Data;

interface DepartmentInterface
{
    const TABLE_NAME = 'learning_department';
    const FIELD_ID = 'entity_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';

    public function getId(): ?int;
    public function setId(int $id): DepartmentInterface;

    public function getName(): string;
    public function setName(string $name): DepartmentInterface;

    public function getDescription(): string;
    public function setDescription(string $description): DepartmentInterface;
}
