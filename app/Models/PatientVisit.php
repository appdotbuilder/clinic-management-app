<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PatientVisit
 *
 * @property int $id
 * @property int $patient_id
 * @property \Illuminate\Support\Carbon $visited_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientVisit whereVisitedAt($value)
 * @method static \Database\Factories\PatientVisitFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PatientVisit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'patient_id',
        'visited_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Get the patient that owns the visit.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}