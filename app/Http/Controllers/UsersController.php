<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersController extends Controller
{
	public function KarmaPosition($user, Request $request)
	{
		$result_count = $request->input('count') ?? 5;
		$high_record = $low_record = (int) ($result_count / 2);
		if ($result_count % 2 == 0) {
			$high_record = (int) ($result_count / 2) - 1;
		}

		DB::statement(DB::raw('set @rownum=0'));
		$user = DB::query()->select(['aa.id', 'username', 'karma_score', 'position'])->fromSub(
			function ($query) {
				$query->from('users')->select(DB::raw('*, @rownum  := @rownum  + 1 AS position'))->orderByDesc('karma_score');
			},
			'aa'
		)->where('aa.id', $user)->first();

		$users_count = User::count();
		if ($users_count - $user->position < $low_record) {
			$low_record = $users_count - $user->position;
			$high_record = $result_count - $low_record - 1;
		}
		if ($user->position - 1 < $high_record) {
			$high_record = $user->position - 1;
			$low_record = $result_count - $high_record - 1;
		}

		DB::statement(DB::raw('set @rownum=0'));
		DB::statement(DB::raw('set @rownum2=0'));

		$data = DB::query()->select(['aa.id', 'username', 'karma_score', 'position', 'url'])->fromSub(
			function ($query) use ($user, $low_record, $high_record) {
				$query->fromSub(function ($query) {
					$query->from('users')->select(DB::raw('*, @rownum  := @rownum  + 1 AS position'))->orderByDesc('karma_score');
				}, 'all')->where('position', '<=', $user->position)->orderBy('position', 'DESC')->take($high_record + 1)
				->when($low_record > 0, function ($query) use ($low_record, $user) {
					$query->union(DB::query()->fromSub(function ($query) {
						$query->from('users')->select(DB::raw('*, @rownum2  := @rownum2  + 1 AS position'))->orderByDesc('karma_score');
					}, 'all')->where('position', '>', $user->position)->orderBy('position', 'ASC')->limit($low_record));
				});
			},
			'aa'
		)->orderBy('position')->join('images', 'image_id', '=', 'images.id')->get();

		return view('scoreboard')->with('data', $data)->with('userId', $user->id);
	}
}
