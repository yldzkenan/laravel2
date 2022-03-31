<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ogrenciikik extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table= 'onayliogrenci';
    protected $fillable = [
		'ad', 'soyad','sifre', 'numara','email', 'fakülte','bölüm', 'sınıf','telefon', 'fotograf' ];
}
