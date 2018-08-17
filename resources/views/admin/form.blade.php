        {{ Form::open(array('route' => 'posts.store')) }}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('state', 'State') }}
            {{ Form::textarea('state', null, array('class' => 'form-controller')) }}
            <br>
            
            {{ Form::label('population', 'Population') }}
            {{ Form::text('population', null, array('class' => 'form-controller')) }}
            <br>
            
            {{ Form::label('growth2000to2013', 'Growth 2000 - 2013') }}
            {{ Form::text('growth2000to2013', null, array('class' => 'form-controller')) }}
            <br>
            
            {{ Form::label('rank', 'Rank') }}
            {{ Form::text('rank', null, array('class' => 'form-controller')) }}
            <br>
            
            {{ Form::label('latitude', 'Latitude') }}
            {{ Form::text('latitude', null, array('class' => 'form-controller')) }}
            <br>
            
            {{ Form::label('longitude', 'Longitude') }}
            {{ Form::text('longitude', null, array('class' => 'form-controller')) }}
            <br>
            
            {{ Form::submit('Create City', array('class' => 'btn btn-success btn-lg btn-block')) }}
        </div>
        {{ Form::close() }}
