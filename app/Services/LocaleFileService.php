<?php
/**
 *  app/Services/LocaleFileService.php
 *
 * User: 
 * Date-Time: 18.12.20
 * Time: 11:07
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Services;


class LocaleFileService
{
    public string $lang;
    public string $file;
    public array $arrayLang = [];

    private string $path;

    public function __construct(string $lang, string $file,array $arrayLang) {
        $this->lang = $lang;
        $this->file = $file;
        $this->arrayLang = $arrayLang;
    }

    public function rescan() {
        $this->read();
        $this->save();
    }


    // Read and Check if directory not exist after automatic Create.
    private function read()
    {
        $langDirectory = base_path().'/resources/lang';
        $directory = base_path().'/resources/lang/'.$this->lang;
        if (!file_exists($langDirectory)) {
            mkdir($langDirectory,0777,false);
        }
        if (!file_exists($directory)) {
            mkdir($directory,0777,false);
        }
        $this->path = base_path().'/resources/lang/'.$this->lang.'/'.$this->file.'.php';
    }

    // Save arrayLang into file
    private function save()
    {
        $content = "<?php\n\nreturn\n[\n";

        foreach ($this->arrayLang as $this->key => $this->value)
        {
            $content .= "\t'".$this->key."' => ".'"'.$this->value.'"'.",\n";
        }

        $content .= "];";

        file_put_contents($this->path, $content);
    }
}
