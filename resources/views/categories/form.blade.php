
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label">Name</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($category)->name) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    <label for="description" class="control-label">Description</label>
    <textarea class="form-control" name="description" cols="50" rows="5" id="description" minlength="1" maxlength="1000">{{ old('description', optional($category)->description) }}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label for="is_active" class="control-label">Is Active</label>
    <div class="checkbox">
        <label for="is_active_1">
            <input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($category)->is_active) == '1' ? 'checked' : '' }}>
            Yes
        </label>
    </div>
    {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
</div>

