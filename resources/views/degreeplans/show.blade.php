@extends('base')

@section('main')
            <h1>Showing Contact {{ $contact->first_name }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Name:</strong> {{$contact->first_name}} {{$contact->last_name}}<br>
            <strong>Email:</strong> {{$contact->email}} <br>
            <strong>Job Title:</strong> {{$contact->job_title}}
            
        </p>
    </div>
@endsection