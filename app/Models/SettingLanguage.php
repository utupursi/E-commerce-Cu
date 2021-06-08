<?php
/**
 *  app/Models/SettingLanguage.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'setting_id',
        'language_id',
        'value'
    ];

}
