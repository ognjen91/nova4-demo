<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Nova\Notifications\NovaNotification;
use App\Models\User;

class HomepageController extends Controller
{
    public function __invoke() {

        // foreach (User::get() as $user){
        //    $user->notify(
        //         NovaNotification::make()
        //         ->message('New app view.')
        //         ->icon('eye')
        //         ->type('info')
        //     );
        // }

        return view('welcome');
    }
}
