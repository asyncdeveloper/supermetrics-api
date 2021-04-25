<?php


namespace App\Controllers;

class DataController {

    public function index() {
        $data = [];

        return response()
          ->httpCode(200)
          ->json([ 'data' => $data ]);
    }

}
