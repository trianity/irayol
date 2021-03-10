@extends('layouts.app')
@push('title', 'Setting')
@section('content')

    <div class="card mt-3">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-md-8">
                    Settings
                </div>
                <div class="col-md-4">
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="{{ route('setting.create') }}" class="btn btn-success" title="Create New Setting">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        @if(count($settings) == 0)
            <div class="panel-body text-center">
                <h4>No Settings Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr>
                            <td>{{ $setting->key }}</td>
                            <td>{{ $setting->value}}</td>
                            <td>

                                <form method="POST" action="{!! route('setting.destroy', $setting->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('setting.show', $setting->id ) }}" class="btn btn-info btn-sm" title="Show Users">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('setting.edit', $setting->id ) }}" class="btn btn-primary btn-sm" title="Edit Setting">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Setting" onclick="return confirm(&quot;Click Ok to delete Setting.&quot;)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $settings->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection