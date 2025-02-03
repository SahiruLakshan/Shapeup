<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $primaryKey = 'id';

    protected $fillable = [
        'emp_id',
        'emp_fp_id',
        'emp_etfno',
        'service_no',
        'emp_etfno_a',
        'is_resigned',
        'emp_name_with_initial',
        'calling_name',
        'emp_first_name',
        'emp_med_name',
        'emp_last_name',
        'emp_fullname',
        'emp_nick_name',
        'emp_status',
        'emp_birthday',
        'emp_gender',
        'emp_marital_status',
        'emp_nationality',
        'emp_salary_grade',
        'emp_join_date',
        'emp_permanent_date',
        'emp_assign_date',
        'tp1',
        'tp2',
        'emp_address',
        'emp_address_2',
        'emp_addressT1',
        'emp_address_T2',
        'emp_national_id',
        'emp_con_mobile',
        'emp_work_telephone',
        'emp_mobile',
        'emp_department',
        'no_of_casual_leaves',
        'no_of_annual_leaves',
        'emp_drive_license',
        'emp_license_expire_date',
        'emp_work_phone_no',
        'emp_email',
        'emp_other_email',
        'emp_home_no',
        'emp_location',
        'emp_shift',
        'emp_city',
        'emp_province',
        'emp_country',
        'emp_postal_code',
        'emp_job_code',
        'emp_company',
        'emergency_contact_person',
        'emergency_contact_tp',
        'deleted',
        'modified_user_id',
        'created_by',
        'factory_id',
        'job_category_id',
        'work_category_id',
        'resignation_date',
        'resignation_remark',
        'ds_divition',
        'gsn_divition',
        'gsn_name',
        'gsn_contactno',
        'police_station',
        'police_contactno',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'emp_birthday' => 'date',
        'emp_join_date' => 'date',
        'emp_permanent_date' => 'date',
        'emp_assign_date' => 'date',
        'emp_license_expire_date' => 'date',
        'resignation_date' => 'date',
        'is_resigned' => 'boolean',
        'deleted' => 'boolean',
    ];

    /**
     * Get the employee's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->emp_fullname;
    }


    public function getNameWithInitialAttribute()
    {
        return $this->emp_name_with_initial;
    }

    public function scopeActive($query)
    {
        return $query->where('emp_status', 1)->where('is_resigned', 0);
    }

   
    public function scopeResigned($query)
    {
        return $query->where('is_resigned', 1);
    }
}
