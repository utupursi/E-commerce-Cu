<?php
/**
 *  app/Breadcrumbs/Segment.php
 *
 * User: 
 * Date-Time: 16.12.20
 * Time: 17:13
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Breadcrumbs;





use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Segment
{
    protected $request;
    protected $segment;

    public function __construct(Request $request, $segment)
    {
        $this->request = $request;
        $this->segment = $segment;
    }

    public function name()
    {
        return ($this->segment == 'admin') ? 'dashboard' : $this->segment;
    }

    public function model()
    {
        // Todo get route parameter model
        return collect($this->request->route()->parameters());
    }

    public function url()
    {
        return url(implode('/', array_slice($this->request->segments(), 0, $this->position() + 1)));
    }

    public function method() {
        dd($this->request->route());

        return $this->request->route();
    }

    public function position()
    {
        return array_search($this->segment, $this->request->segments());
    }

}