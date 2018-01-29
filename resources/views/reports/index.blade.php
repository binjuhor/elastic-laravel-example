@extends('layouts.app')

@section('header')
<a class="navbar-brand" href="{{ url('/') }}"> Reports</a>
@endsection




@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">
                World Map<br />
                <small>
                    Looks great on any resolution. Made by our friends from <a target="_blank" href="http://jvectormap.com/">jVector Map</a>.
                </small>
            </h3>
            <div class="card card-plain">
                <div class="content">
                    <div id="worldMap" class="map map-big"></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('extrajs')
<script type="text/javascript">
    $(document).ready(function(){
        demo.initVectorMap();
    });
</script>
@endsection
