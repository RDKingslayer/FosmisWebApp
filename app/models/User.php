<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	//protected $connection = 'mysql2';
	protected $table = 'user';
	public $timestamps =false;
	protected $fillable = ['user','l_name','initials','passowrd','role','user_role_1','user_role_2','email','remember_token','depart_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */

	public function getAuthPassword()
	{
		return $this->password;
	}
    
    public function Department()
    {
        return $this->hasOne("Department","dept_id","depart_id");
    }
    
    public function Role()
    {
        return $this->hasOne("Role","role_id","user_role_1");
    }

}
