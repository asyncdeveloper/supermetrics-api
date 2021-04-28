<?php

use App\Core\Database as DB;
use App\Models\Post;
use Crunz\Schedule;
use GuzzleHttp\Client;

$schedule = new Schedule();

$task = $schedule->run(function() {
    $dotenv = Dotenv\Dotenv::createImmutable(getcwd());
    $dotenv->load();

    $API_URL = $_ENV['API_URL'];
    $CLIENT_ID = $_ENV['CLIENT_ID'];

    $client = new Client();

    $response = $client->post("{$API_URL}/register", [
        'json' => [
            'client_id' => $CLIENT_ID,
            'email' => 'sheyilaaw98@gmail.com',
            'name' => 'Oluwaseyi Adeogun'
        ]
    ])->getBody()
    ->getContents();

    $data = json_decode($response, true);

    $token = $data['data']['sl_token'] ?? null;

    for ($pageNumber = 1; $pageNumber <=10 ; $pageNumber++) {
        $response = $client->get("{$API_URL}/posts", [
            'query' => [ 'sl_token' => $token,  'page' => $pageNumber ]
        ])->getBody()
        ->getContents();

        $data =  json_decode($response, true);

        $posts = $data['data']['posts'] ?? [];
        (new DB())->capsule->getConnection();;
        collect($posts)->each(function ($post) {
            $post['external_id'] = $post['id'];
            Post::firstOrCreate(['external_id' => $post['external_id'] ], $post);
        });

    }
});

$task->everyTwoHours()
    ->description('Fetch Posts From External API');

return $schedule;
