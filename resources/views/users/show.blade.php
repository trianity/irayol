@extends('layouts.app')
@push('title', 'Show User')
@section('content')

@foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(Session::has($key))
        <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get($key) }}
        </div>
    @endif
@endforeach

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center">{{ $users->name }}</h3>
                        <p class="text-muted text-center"><a href="mailto:{{ $users->email }}">{{ $users->email }}</a></p>
                        <hr>
                        <p><b>Created At:</b> {{ \Carbon\Carbon::parse($users->created_at)->diffForHumans() }}</p>
                        <p><b>Updated At:</b> {{ \Carbon\Carbon::parse($users->updated_at)->diffForHumans() }}</p>

                        <form method="POST" action="{!! route('users.destroy', $users->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            {{ csrf_field() }}
                            <div class="btn-group btn-block btn-group-sm" role="group">
                                <a href="{{ route('users.index') }}" class="btn btn-primary" title="Show All Users">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>

                                <a href="{{ route('users.create') }}" class="btn btn-success" title="Create New Users">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </a>

                                <a href="{{ route('users.edit', $users->id ) }}" class="btn btn-primary" title="Edit Users">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <button type="submit" class="btn btn-danger" title="Delete Users" onclick="return confirm(&quot;Click Ok to delete Users.?&quot;)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Blogs
                        <span class="badge badge-primary badge-pill">{{count($users->blog)}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pages
                        <span class="badge badge-primary badge-pill">{{count($users->page)}}</span>
                    </li>
                </ul>
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#blog" data-toggle="tab">Blogs</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pages" data-toggle="tab">Pages</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="blog">
                                @if(count($users->blog) >= 1)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Published Date</th>
                                            <th colspan="3">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users->blog as $blog)
                                            <tr>
                                                <td>{{ $blog->title }}</td>

                                                <td>{{ \Carbon\Carbon::parse($blog->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    <form method="POST" action="{!! route('blog.destroy', $blog->id) !!}" accept-charset="UTF-8">
                                                        <input name="_method" value="DELETE" type="hidden">
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs float-right" role="group">
                                                            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-info btn-sm" title="Show Users">
                                                                <i class="far fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary btn-sm" title="Edit Page">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Page" onclick="return confirm(&quot;Click Ok to delete Page.&quot;)">
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
                                @else
                                    <div class="alert alert-dismissible alert-warning">
                                        <h4 class="alert-heading text-center">No blogs associated with the user were found!</h4>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="pages">
                                @if(count($users->page) >= 1)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Published Date</th>
                                            <th colspan="3">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users->page as $page)
                                            <tr>
                                                <td>{{ $page->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($page->updated_at)->diffForHumans() }}</td>
                                                <td>
                                                    <form action="{{route('page.active')}}" method="POST">
                                                        @csrf
                                                        <input type="text" hidden name="main_page" id="main_page" value="{{ $page->id }}">
                                                        <button type="submit" class="btn btn-{{ $page->id == setting('main_page') ? 'success' : 'secondary' }} btn-sm">{{ $page->id == setting('main_page') ? 'Active' : 'Inactive' }}</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{!! route('page.destroy', $page->id) !!}" accept-charset="UTF-8">
                                                        <input name="_method" value="DELETE" type="hidden">
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs float-right" role="group">
                                                            <a href="{{ route('page.show', $page->slug) }}" target="_blank" class="btn btn-info btn-sm" title="Show Users">
                                                                <i class="far fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{ route('page.edit', $page->id) }}" class="btn btn-primary btn-sm" title="Edit Page">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Page" onclick="return confirm(&quot;Click Ok to delete Page.&quot;)">
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
                                @else
                                    <div class="alert alert-dismissible alert-warning">
                                        <h4 class="alert-heading text-center">No pages associated with the user were found!</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
