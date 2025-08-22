<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Lead
 *
 * @property int $id
 * @property string $title
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string|null $company
 * @property string|null $job_title
 * @property string $source
 * @property string $status
 * @property float|null $estimated_value
 * @property string|null $notes
 * @property int|null $assigned_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $assignedUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read string $full_name
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Lead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lead query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereEstimatedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lead whereUpdatedAt($value)
 * @method static \Database\Factories\LeadFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'job_title',
        'source',
        'status',
        'estimated_value',
        'notes',
        'assigned_to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'estimated_value' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user assigned to this lead.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all tasks for this lead.
     */
    public function tasks(): MorphMany
    {
        return $this->morphMany(Task::class, 'taskable');
    }

    /**
     * Get the lead's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}