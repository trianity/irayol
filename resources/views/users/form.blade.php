
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email" class="control-label">Email</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($users)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email here...">
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Name</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($users)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
    <label class="control-label" for="menu">Roles</label>
    <select multiple="" class="form-control select2" id="roles" name="roles[]">
        @foreach ($roles as $key => $role)
            <option value="{{ $role }}" {{ old('roles[]', optional($users)->roles->contains($key)) == $key ? 'selected' : '' }}>
        		{{ $role }}
        	</option>
        @endforeach
    </select>
    {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
</div>

