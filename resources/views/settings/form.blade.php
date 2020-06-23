
<div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
    <label for="key" class="control-label">Key</label>
    <input class="form-control" name="key" type="text" id="key" value="{{ old('key', optional($setting)->key) }}" minlength="1" maxlength="191" required="true" placeholder="Enter key here..." {{ optional($setting)->key ? "readonly" : ''}} >
    {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
    <label for="value" class="control-label">Value</label>
    <input class="form-control" name="value" type="text" id="value" value="{{ old('value', optional($setting)->value) }}" minlength="1" maxlength="191" required="true" placeholder="Enter value here...">
    {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
</div>
