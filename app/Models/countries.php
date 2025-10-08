<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
class countries extends Model {
  use SoftDeletes;
  protected $guarded = [];
  public function departments(){ return $this->hasMany(departament::class, 'id_country'); }
}