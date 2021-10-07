<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FakturService extends Model
{
    protected $table = 'faktur_services';
    protected $primaryKey = 'id_fs';
}
