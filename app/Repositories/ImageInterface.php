<?php

namespace App\Repositories;

interface ImageInterface
{
    public function getAll();
    public function store($request, $id);
    public function storeBase64Image($request, $id);
    // public function showImage($id);

}
