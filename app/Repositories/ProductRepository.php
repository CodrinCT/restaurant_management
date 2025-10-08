<?php

namespace App\Repositories;

interface ProductRepository
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);  // 👈 new
    public function delete($id);
}
