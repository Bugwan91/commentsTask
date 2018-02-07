<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Votable as VotableContract;

abstract class Votable extends Model implements VotableContract
{

    public function votes()
    {
        return $this->morphMany('App\Vote', 'votable');
    }

    public function getRatingAttribute()
    {
        return $this->votes->sum('value');
    }

    public function getVotedAttribute() {
        $vote = $this->votes->where('user_id', Auth::id())->first();
        if ($vote) {
            return $vote->value;
        } else {
            return 0;
        }
    }

    public static function setVote($votable_type, $votable_id, $vote_value) {
        if ($vote_value === -1 || $vote_value === 1) {
            $votable_class = '\\App\\' . ucfirst($votable_type);
            if (class_exists($votable_class) && is_subclass_of($votable_class, VotableContract::class)) {
                $votable = $votable_class::where('id', $votable_id)->with(['votes' => function ($query) {
                    $query->where('user_id', Auth::id());
                }])->first();
                if ($votable) {
                    $vote = null;
                    if ($votable->votes->isEmpty()) {
                        $votable->votes()->save(new Vote([
                            'value' => $vote_value,
                        ]));
                    } else {
                        $vote = $votable->votes->first();
                        $vote->value = $vote->value + $vote_value;
                        if ($vote->value === 0) {
                            $votable->votes->first()->delete();
                        } else {
                            $votable->votes()->save($vote);
                        }
                    }
                } else {
                    throw new Exception("'$votable_type' with id: $votable_id not found");
                }
            } else {
                throw new Exception("'$votable_type' is not votable");
            }
        } else {
            throw new Exception("Vote value can not be '$vote_value'");
        }
    }
}
