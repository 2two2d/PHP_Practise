<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'employee';
    protected $fillable = [
        'name',
        'surname',
        'midlename',
        'username',
        'sex',
        'birthday',
        'adress',
        'department',
        'staff',
        'post',
        'ava'
    ];
}