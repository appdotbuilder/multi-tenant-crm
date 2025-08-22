<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Contact
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $mobile
 * @property string|null $job_title
 * @property int|null $company_id
 * @property string|null $address
 * @property string|null $birthday
 * @property string|null $notes
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deal> $deals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read string $full_name
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact active()
 * @method static \Database\Factories\ContactFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'job_title',
        'company_id',
        'address',
        'birthday',
        'notes',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the company that owns the contact.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the deals for the contact.
     */
    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class);
    }

    /**
     * Get all tasks for this contact.
     */
    public function tasks(): MorphMany
    {
        return $this->morphMany(Task::class, 'taskable');
    }

    /**
     * Get the contact's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Scope a query to only include active contacts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}