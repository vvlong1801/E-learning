<div class="form-group">
    {!! Form::label('name', 'Name: ') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email: ') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
{{-- @guest --}}
@if (Auth::user()->role->first()->name === 'Admin')
<div class="form-group">
    <label for="role" class="col-form-label">Select Role: </label>
    {!! Form::select('role', $roles, null, array('class' => 'form-control')); !!}
</div>
@endif
{{-- @endguest --}}
<div class="form-group">
        {!! Form::label('password', 'Password: ') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "(password unchanged)"]) !!}
</div>
{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
{!! Form::close() !!}