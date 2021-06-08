<?php
/**
 *  app/Models/Profile.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 17:53
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'birthday',
        'phone_1',
        'phone_2'
    ];


    /**
     * Get the owning profileable model.
     */
    public function profileable()
    {
        return $this->morphTo();
    }
}
