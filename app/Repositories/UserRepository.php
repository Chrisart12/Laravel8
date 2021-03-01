<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserInterface
{
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getAll()
	{
		return $this->user->orderBy('firstname')->get();

	}


	public function getById($id)
	{
		return $this->user->find($id);
	}

}
