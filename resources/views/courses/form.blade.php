@inject('category', 'App\Http\Controllers\CategoryController')
@php
    $categories = $category->index();
@endphp
<div class="form-group">
    {!! Form::label('title', 'タイトル') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('thumbnail', 'コースのイメージ') !!}
    {!! Form::file('thumbnail', ['class' => 'form-control', 'accept' => 'image/*']) !!}
    @if (isset($course))
        {!! Html::image('/storage/' . $course->thumbnail, 'Thumbnail') !!}
    @endif
</div>
<div class="form-group">
    <label for="category">カテゴリー</label>
    <select name="category_id" id="category" class="form-control">
        @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    {!! Form::label('description', '説明') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
{!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
{!! Form::close() !!}
