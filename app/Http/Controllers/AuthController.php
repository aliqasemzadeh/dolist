<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    use PasswordValidationRules;

    public function redirect($driver)
    {
        if(config('dolist.enable_socialite_auth')) {
            return Socialite::driver($driver)->redirect();
        } else {
            return  redirect(route('login'));
        }
    }

    public function callback($driver) {
        $socialiteUser = Socialite::driver($driver)->user();
        $user = User::firstOrCreate(['email' => $socialiteUser->email]);
        $user->name = $socialiteUser->name;
        $user->google_id = $socialiteUser->id;
        $user->save();

        $this->createTeam($user);


        Auth::login($user);
        return redirect(route('home'));
    }

    public function password()
    {
        return view('auth.password');
    }

    protected function createTeam(User $user)
    {
        if($user->ownedTeams()->count() == 0) {
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]));
        }
    }

    public function setPassword(Request $request)
    {
        Validator::make($request->all(), [
            'password' => $this->passwordRules(),
        ])->validate();

        auth()->user()->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return redirect(route('home'));
    }
}
