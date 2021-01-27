<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Media as ModelsMedia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Media extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search' => ['except' => ''],];
    public $files = [];
    public $search = '';

    public function render()
    {
        $medias = ModelsMedia::where('file', 'LIKE', "%{$this->search}%")->orderBy('id', 'desc')->paginate(18);
        return view('livewire.media', ['medias' => $medias]);
    }

    public function store()
    {
        try {
            
            $this->validate([
                'files' => 'required', // 1MB Max
            ]);

            if (count($this->files) > 0) {
                $destinationPath = '/uploads/' . date('Y') . '/' . date('m') . '/' . date('d'); //chmod 0777

                foreach ($this->files as $file) {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();

                    if (File::exists($destinationPath . "/" . $filename)) {
                        session()->flash('warning', 'El archivo ya fue almacenado');
                    } else {
                        ModelsMedia::create([
                            'user_id' => Auth::id(),
                            'file' => $filename,
                            'path' => "/storage/" .  $destinationPath . '/' . $filename,
                            'extension' => $extension,
                        ]);
                        $file->storeAs($destinationPath, $filename, 'public'); //save to path          
                    }
                }

                session()->flash('success', 'El archivo se subio con exito');

                $this->reset('files');
            } else {
                session()->flash('warning', 'No se adjunto ningun archivo');
            }
            
        } catch (\Throwable $th) {
            session()->flash('danger', "Error: " . $th->getMessage());
        }

    }

    public function clear()
    {
        $this->search = '';
        $this->page = 1;
    }
}
