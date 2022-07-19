<div class="form-group">
    {!! Form::label('name', '名前') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'メールアドレス') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
{{-- @guest --}}
@if (Auth::user()->role->first()->name === 'Admin')
<div class="form-group">
    <label for="role" class="col-form-label">役割</label>
    {!! Form::select('role', $roles, null, array('class' => 'form-control')); !!}
</div>
@endif
{{-- @endguest --}}
<div class="form-group">
        {!! Form::label('password', 'パスワード') !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "(password unchanged)"]) !!}
</div>
{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
{!! Form::close() !!}