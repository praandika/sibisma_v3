<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
	protected $table = 'dealers';
    protected $primaryKey = 'id_dealer';
    protected $fillable = ['kode_dealer','nama_dealer','alamat','telp','koordinat','qrcode'];
}
