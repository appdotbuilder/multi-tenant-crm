<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Deal
 *
 * @property int $id
 * @property string $name
 * @property float $value
 * @property int|null $company_id
 * @property int|null $contact_id
 * @property string $stage
 * @property int $probability
 * @property string $expected_close_date
 * @property string|null $description
 * @property int|null $assigned_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\User|null $assignedUser
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Deal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereExpectedCloseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereProbability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deal whereValue($value)
 * @method static \Database\Factories\DealFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Deal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'value',
        'company_id',
        'contact_id',
        'stage',
        'probability',
        'expected_close_date',
        'description',
        'assigned_to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'decimal:2',
        'probability' => 'integer',
        'expected_close_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the company that owns the deal.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the contact that owns the deal.
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the user assigned to this deal.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get all tasks for this deal.
     */
    public function tasks(): MorphMany
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}