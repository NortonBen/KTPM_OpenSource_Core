<?php

namespace App\Http\Controllers\Apiv3;

use App\Http\Handlers\DataHandler;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __construct()
    {
        $this->handler = new DataHandler();
    }

    public function sexs()
    {
        $this->handler->sex();
        return $this->getResuft();
    }

    public function typeactions()
    {
        $this->handler->actions();
        return $this->getResuft();
    }

    public function relationships()
    {
        $this->handler->relationships();
        return $this->getResuft();
    }
}
