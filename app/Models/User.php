<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
// 継承クラス　　class定義にextendsと継承するクラス名を記述。
// この場合はAuthenticatableクラスを継承したUserとなる。
// 継承されたAuthenticatableクラスを親クラス、スーパークラスという。
// userは子くらす、サブクラスという。

{
    use HasApiTokens, HasFactory, Notifiable;
    // 3つ使うよという意味

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Projectsテーブルとのリレーション
     */
    public function projects()
    // メソッドは複数のプロジェクトを保持できることから複数形にしてる
    {
        return $this-> hasMany(Project::class);
        //一人のユーザに対して複数のプロジェクトを保持することができる。
        // Project::class　はproject.phpのprojectクラスのこと
    }
}
