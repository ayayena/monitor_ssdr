<?php

namespace App;

use Patient;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuspectCase extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sample_at', 'origin', 'age', 'gender', 'result_ifd', 'result_ifd_at',
        'subtype', 'epidemiological_week', 'epivigila', 'pscr_sars_cov_2',
        'pscr_sars_cov_2_at', 'sample_type', 'validator_id', 'sent_isp_at',
        'paho_flu', 'status', 'observation', 'patient_id','gestation_week',
        'gestation','laboratory_id'
    ];

    public function patient() {
        return $this->belongsTo('App\Patient');
    }

    public function validator() {
        return $this->belongsTo('App\User','validator_id');
    }

    public function laboratory() {
        return $this->belongsTo('App\Laboratory');
    }

    public function logs() {
        return $this->morphMany('App\Log','model');
    }

    public function files() {
        return $this->hasMany('App\File');
    }

    function getCovid19Attribute(){
        switch($this->pscr_sars_cov_2) {
            case 'pending': return 'Pendiente'; break;
            case 'positive': return 'Positivo'; break;
            case 'negative': return 'Negativo'; break;
        }
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'sample_at', 'result_ifd_at', 'pscr_sars_cov_2_at', 'sent_isp_at', 'deleted_at'
    ];
}
