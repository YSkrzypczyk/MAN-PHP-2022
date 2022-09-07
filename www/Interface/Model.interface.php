<?php
namespace App\Interface;

interface Model
{
    public function setId(?Int $id): object;
    public function getId(): ?Int;
    public function getDateInserted(): ?String;
    public function getDateUpdated(): ?String;
}