<?php
class Car extends Vehicle
{
    protected string $model;

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    protected function getEngine(): string
    {
        return 'electric';
    }
}