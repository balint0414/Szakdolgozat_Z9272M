<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function getHasAvatarAttribute()
    {
        return $this->avatar != null;
    }

    public function getAvatarImageAttribute()
    {
        if($this->has_avatar)
        {
            return asset("upload/users/{$this->avatar}");
        }
        
        return "https://via.placeholder.com/350";
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function sentFriends()
    {
        return $this->belongsToMany(
            User::class,
            'friend_requests',
            'sender_id',
            'receiver_id'
        )->wherePivot('is_accepted', true);
    }

    public function receivedFriends()
    {
        return $this->belongsToMany(
            User::class,
            'friend_requests',
            'receiver_id',
            'sender_id'
        )->wherePivot('is_accepted', true);
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /*
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'sender_id', 'receiver_id')
            ->select('users.id', 'users.name')
            ->wherePivot('is_accepted', true)
            ->orWhere(function ($query) {
                $query->where('receiver_id', $this->id)
                    ->where('is_accepted', true);
            });
    }
    */

    public function removeFriend(User $friend)
    {
        $this->sentFriends()->detach($friend->id);
        $this->receivedFriends()->detach($friend->id);
    }

    //időpont foglalás
    public function trainingSessions()
    {
        return $this->hasMany(TrainingSession::class, 'trainer_id');
    }

    public function bookedSessions()
    {
        return $this->hasMany(TrainingSession::class, 'student_id');
    }

}