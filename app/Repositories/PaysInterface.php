<?php

namespace App\Repositories;

interface PaysInterface
{
    public function getAll();
    public function store($request, $id);

}
