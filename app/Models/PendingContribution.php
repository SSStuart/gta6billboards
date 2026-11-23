<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['username', 'coordinates', 'comment', 'filename'])]
class PendingContribution extends Model
{
    //
}
