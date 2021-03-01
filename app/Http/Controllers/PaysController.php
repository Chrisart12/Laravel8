<?php

namespace App\Http\Controllers;

use Auth;
use App\Repositories\PaysInterface;
use App\Repositories\UserInterface;
use App\Http\Requests\PaysRequest;
use Illuminate\Http\Request;

class PaysController extends Controller
{
    /**
     * @var [PaysInterface]
     */
    protected $paysInterface;
    protected $userInterface;

    /**
     *
     * @return void
     */
    public function __construct(PaysInterface $paysInterface, UserInterface $userInterface)
    {
        $this->paysInterface = $paysInterface;
        $this->userInterface = $userInterface;
    }

    public function pays()
    {
        $pays = $this->paysInterface->getAll();

        return view('pays', compact('pays'));
    }

    public function choix()
    {

        $user = Auth::user();

        return view('choix', compact('user'));
    }

    public function create(PaysRequest $request)
    {

        $user = Auth::user();

        $this->paysInterface->store($request, $user->id);

        return  redirect()->route('choix');
    }
}
