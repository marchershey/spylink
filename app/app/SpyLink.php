<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpyLink extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'spy_links';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
