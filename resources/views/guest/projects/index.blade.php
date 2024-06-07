@extends('layouts.app')
@section('title', 'Projects')


@section('content')
    
    <section class="mb-5 py-5 bg-purple">
        <div class="bg-light container py-4 projects-cotnainer">

            <h1 class="my-4 text-center text-danger"> My Projects</h1>


            <table class="table table-dark table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Date of Creation</th>
                        <th colspan="2" scope="col">Type of Project</th>
                        <th scope="col">Contributors</th>
                        <th scope="col">More Info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)                
                        <tr class="position-relative">
                            <td>{{$project->name}}</td>
                            <td>{{$project->slug}}</td>
                            <td>{{$project->date_of_creation}}</td>
                            <td>{{$project->is_public === 0 ? 'Public' : 'Private'}}</td>
                            <td>{{$project->type?->name ? $project->type->name : ''}}</td>
                            <td class="text-center">{{$project->contributors}}</td>
                            <td class="text-center"><a class="text-success" href="{{route('guest.projects.show', $project)}}">Info</a></td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    
@endsection