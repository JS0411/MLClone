<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserReputationController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'mode' => ['required', 'string', 'in:seller,buyer'],
            'id' => ['required', 'integer', 'min:1'],
        ]);

        $user = User::findOrFail($data['id']);

        if ($data['mode'] == 'seller') {
            $reputations = $user->sellerProfile->reputations;
        } else {
            $reputations = $user->buyerProfile->reputations;
        }

        return ($reputations->map->only([
            'id',
            'classified_name',
            'classified_id',
            'description',
            'rating',
            'rater_id',
            'rater_name',
            'image',
        ]));

    }

}
