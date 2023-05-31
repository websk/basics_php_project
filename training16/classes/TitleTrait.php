<?php
trait TitleTrait
{
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getShortName(): string
    {
        return $this->short_name;
    }
}