<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {



	protected $primaryKey = "id";


	protected $table = "users";


	protected $fillable = [
		"username",
		"email",
		"password"
	];

}