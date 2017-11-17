<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Message extends Model
{
    use Sortable;

    protected $sortable = ['username', 'email', 'created_at'];
}
