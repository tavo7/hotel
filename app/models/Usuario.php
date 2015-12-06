<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends \Eloquent implements UserInterface, RemindableInterface{
	protected $table = 'usuario';
	protected $guarded = array();
	protected $fillable = array('hotel_id' , 'perfil_id' , 	'persona_id' ,'login' , 
						'password',	'estado');

	public static $rules = array();

	// este metodo se debe implementar por la interfaz
	public function getAuthIdentifier() {
		return $this->getKey();
	}

	//este metodo se debe implementar por la interfaz
	// y sirve para obtener la clave al momento de validar el inicio de sesión
	public function getAuthPassword() {
		return $this->password;
	}
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public function perfil(){
		return $this->belongsTo('Perfil', 'perfil_id');
	}

	public function persona(){
		return $this->belongsTo('Persona', 'persona_id');
	}

	public function detallecaja(){
		return $this->hasMany('Detallecaja', 'usuario_id');
	}
}