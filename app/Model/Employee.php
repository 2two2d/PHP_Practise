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

    public function setAva($img){
        $imgUniqueName = md5(time()).'.'.explode('/',$img['type'])[1];
        $this->ava = $imgUniqueName;
        move_uploaded_file($img['tmp_name'], __DIR__ . '/../../public/Images/' . $imgUniqueName);
    }
}