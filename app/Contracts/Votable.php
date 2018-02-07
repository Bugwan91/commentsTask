<?php

namespace App\Contracts;

interface Votable
{
    public function votes();

    public function getRatingAttribute();

    public function getVotedAttribute();

    public static function setVote($votable_type, $votable_id, $vote_value);
}
