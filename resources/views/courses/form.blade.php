            <div class="form-group">
                {!! Form::label('title', 'タイトル') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('thumbnail', 'コースのイメージ' ) !!}
                {!! Form::file('thumbnail', array('class' => 'form-control', 'accept'=> 'image/*')) !!}
                @if (isset($course))
                    {!! Html::image('/storage/'.$course->thumbnail, 'Thumbnail') !!}
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('description', '説明') !!}
                {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
            </div>
            {!! Form::submit($submitbuttontext, ['class' => 'btn']) !!}
            {!! Form::close() !!}
