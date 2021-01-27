<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Media extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'file',
        'path',
        'extension'
    ];

    public function getFile()
    {
        $image = ['gif', 'png', 'jpg', 'jpeg', 'raw', 'webp',];
        $text = ['docx', 'docm', 'xlsx', 'xlsm', 'pptx', 'pptm',];
        $video = ['mp4', 'mov', 'wmv', 'flv', 'avi', 'mkv', 'webm'];
        $audio = ['mp3', 'aac', 'ogg', 'flac', 'wav'];
        $compress = ['zip', 'rar'];

        if(in_array($this->extension, $image)){
            return $this->path;

        } elseif (in_array($this->extension, $text)) {
            return asset('manager/extension/txt.png');
            
        } elseif ($this->extension == 'pdf') {
            return asset('manager/extension/pdf.png');

        } elseif (in_array($this->extension, $video)) {
            return asset('manager/extension/mp4.png');

        } elseif (in_array($this->extension, $audio)) {
            return asset('manager/extension/mp3.png');

        } else {
            return asset('manager/extension/other.png');
        }
    }
}
