@extends('layouts.app')
@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="content">

                <form action="/media" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="media[]" multiple>
                    <input type="submit" name="Submit">
                </form>



            </div>
        </div> <!-- end card -->
    </div>
@endsection