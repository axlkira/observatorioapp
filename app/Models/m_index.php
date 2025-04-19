<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_index extends Model
{
    use HasFactory;
    protected $table = 'colillasdepago';
    public $incrementing = false; 
    protected $primaryKey = null;
    protected $guarded = [];
}
