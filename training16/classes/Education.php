<?php
class Education implements TitleInterface
{
    use TitleTrait;

    const EDUCATION_SCHOOL = 'school';

    public string $title;

    public string $short_name;
}