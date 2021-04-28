<?php


namespace App\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;

class DataController {

    public function index() {

        $posts = DB::table((new Post)->getTable())
            ->select(DB::raw('external_id as `id`'), 'from_name', 'from_id', 'message', 'created_time','type',
                DB::raw('LENGTH(message) as `message_character_count`'))
            ->get();

        $groupedPosts = $posts->groupBy(function($d) {
            return Carbon::parse($d->created_time)->format('F Y');
        });

        // a. Average character length of posts per month
        $data['avg_character_len_of_posts'] = $groupedPosts->map(function ($monthPosts) {
            return $monthPosts->sum('message_character_count') / $monthPosts->count();
        });

        //b. Longest post by character length per month
        $data['longest_post_by_character_len'] = $groupedPosts->map(function ($monthPosts) {
            return $monthPosts->sortByDesc('message_character_count')->first();
        });

        //c. Total posts split by week number
        $data['total_posts_by_week_number'] = $posts->groupBy(function($d) {
            return Carbon::parse($d->created_time)->format('W');
        })->map(function ($weekPosts) {
            return $weekPosts->count();
        });

        //d. - Average number of posts per user per month
        $totalNumberOfUsers = $posts->unique('from_id')->pluck('from_id')->count();
        $data['avg_posts_by_user'] = $groupedPosts->map(function ($monthPosts) use ($totalNumberOfUsers) {
            return $monthPosts->count() / $totalNumberOfUsers;
        });

        return response()
            ->httpCode(200)
          ->json([ 'stats' => $data ]);
    }

}
