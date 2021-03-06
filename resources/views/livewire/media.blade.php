<div> 
    @foreach (['danger', 'warning', 'success', 'info'] as $key) 
        @if(Session::has($key))
            <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get($key) }}
            </div>
        @endif 
    @endforeach

    <div class="card">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="float-left">
                        <form wire:submit.prevent="store">
                            <button class="btn btn-info" id="upload_files"><i class="fas fa-plus-circle"></i> {{count($files)}}</button>
                            <input type="file" wire:model="files" id="input_file" hidden multiple required>
                            <button type="submit" class="btn btn-primary" {{ count($files) > 0 ? '' : 'disabled'}} ><i class="fas fa-file-upload"></i></button>
                            <div wire:loading wire:target="photo">Uploading...</div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="float-right form-inline">
                        <div class="row">
    
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input wire:model="search" class="form-control" type="text" placeholder="{{__('global.search')}}">
                                    <div class="input-group-append">
                                        <button wire:click="clear"  class="btn btn-secondary my-2 my-sm-0 {{$search !== '' ? '' : "disabled"}}"><i class="fas fa-times-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($medias as $media)
                    <div class="col-md-2 mt-3 show-image">
                        <div class="card-body img-card-background loading filter image" style="background-image: url('{{ $media->getFile() }}'); ">
                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            @if ($medias->count())    
                {{ $medias->links() }}
            @else
                No se encontraron resultados en la página {{$page}}
            @endif
        </div>
    </div>
</div>