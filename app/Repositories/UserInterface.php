<?php

namespace App\Repositories;

interface UserInterface
{
    public function getAll();
    public function getById($id);

}
