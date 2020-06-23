@extends('layouts.app')
@push('title', 'Upload Themes')
@section('content')


    <div class="row">

        <div class="col-sm-6">

          <div class="panel panel-default">
              <div class="panel-body">

                  {{ Form::open(array('route' => 'themes.store', 'files' => true)) }}

                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-paint-brush" aria-hidden="true"></i></span>
                      </div>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="theme" accept=".zip" id="inputGroupFile01">
                          <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                      </div>
                  </div>

                  {{ Form::submit('Upload now', ['class' => 'btn btn-primary']) }}

                  {{ Form::close() }}

              </div>
            </div>
    </div>

        <script>
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
            });
        </script>
@endsection
