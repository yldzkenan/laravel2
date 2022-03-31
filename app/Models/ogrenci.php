<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ogrenci extends Model
{
    use HasFactory;
    protected $table= 'ogrenci';
    protected $fillable = [
		'ad', 'soyad','sifre', 'numara','email', 'fakülte','bölüm', 'sınıf','telefon', 'fotograf' ];
}
