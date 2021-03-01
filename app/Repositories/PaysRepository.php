<?php

namespace App\Repositories;

use App\Models\Pay;
use App\Models\PayUser;

class PaysRepository implements PaysInterface
{
	protected $pay;

	public function __construct(Pay $pay)
	{
		$this->pay = $pay;
	}

	public function getAll()
	{
		return $this->pay->orderBy('label')->get();

	}


	public function getById($id)
	{
		return $this->pay->find($id);
	}

    public function store($request, $id)
	{
        $pays = $request->pays;

        foreach ($pays as $pay_id) {
            $payUser = new PayUser();
            $payUser->pay_id = (int)$pay_id;
            $payUser->user_id = $id;

            $payUser->save();
        }
        
        return true;
	}



}
