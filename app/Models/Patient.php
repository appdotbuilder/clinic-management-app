<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Patient
 *
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon $tanggal_lahir
 * @property string $jenis_kelamin
 * @property string|null $kontak
 * @property string|null $alamat
 * @property string|null $alergi
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientVisit> $visits
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereAlergi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereKontak($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereTanggalLahir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Database\Factories\PatientFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'kontak',
        'alamat',
        'alergi',
        'catatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the patient visits.
     */
    public function visits(): HasMany
    {
        return $this->hasMany(PatientVisit::class);
    }

    /**
     * Get the patient's age.
     */
    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }
}