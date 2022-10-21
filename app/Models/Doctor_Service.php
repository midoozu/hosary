<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Service extends Model
{

    use Auditable;


    public $table = 'doctor_service';


    protected $fillable = [
        'doctor_id', 'service_id', 'percent'
    ];


    public function doctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }

    public function clinics()
    {
        return $this->belongsToMany(Clinic::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
