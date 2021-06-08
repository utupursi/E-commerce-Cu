<?php
/**
 *  app/Mail/ContactEmail.php
 *
 * User: 
 * Date-Time: 21.12.20
 * Time: 13:49
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailTo = Setting::where(['key' => 'contact_email'])->first();
        if (count($mailTo->availableLanguage) > 0) {
            return $this->from($mailTo->availableLanguage[0]->value, $this->data['full_name'])->subject($this->data['subject'])->view('email.contact', ['data' => $this->data]);

        }

    }
}