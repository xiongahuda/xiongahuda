<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class Invest extends Model
{
	protected $table="borrow";

	public $timestamps=true;
	
	protected function getDateFormat()
	{
		return time();
	}
	protected function asDateTime($val)
	{
		return $val;
	}
}