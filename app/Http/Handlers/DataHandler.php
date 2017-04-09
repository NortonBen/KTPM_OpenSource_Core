<?php
/**
 * Created by PhpStorm.
 * User: wind
 * Date: 10/04/2017
 * Time: 12:26 SA
 */

namespace App\Http\Handlers;


use App\Action;
use App\Relationships;
use App\Sex;
use App\TypeAction;

class DataHandler extends  Handler
{
    public function sex(){
        $data = Sex::all();
        $this->resuft = ['success' => $data];
    }

    public function actions(){
        $data = TypeAction::all();
        $this->resuft = ['success' => $data];
    }

    public function relationships(){
        $data = Relationships::all();
        $this->resuft = ['success' => $data];
    }
}