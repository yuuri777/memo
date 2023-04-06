<?php
//新規登録用のコントローラー
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            //バリデーションに関するコード
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
                                                    //↑デフォルトのパスワードルール
                                                    // を設定できる機能。
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        //laravelのユーザー認証機能であるIlluminate\Foundation\Auth\RegistersUsersとレイトが提供するregisterメソッド内で実行される。
        //ユーザー登録が完了したことを示すregisterdイベントを発火するためのコード
        // Registerdイベントは新しいユーザーが登録されたことを示すイベント
        Auth::login($user);
        //laravelにおいてログイン処理を行うための関数の一つ。
        // $userにユーザー情報が入っている

        return redirect(RouteServiceProvider::HOME);
        //ここでRouteServiceProviderの定数HOMEの値にリダイレクトしますよという意味
    
    }
}
