<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Billboard extends Model
{
    public function contributor(): BelongsTo {
        return $this->belongsTo(Contributor::class);
    }

    public function zone(): BelongsTo {
        return $this->belongsTo(Zone::class);
    }
}
