<?php
/**
 *  app/Models/PageLanguage.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_id',
        'language_id',
        'title',
        'meta_title',
        'description',
        'content',
        'content_2',
        'content_3',
        'content_4',
    ];

}
