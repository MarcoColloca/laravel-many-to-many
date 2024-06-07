@extends('layouts.app')

@section('content')
    
    <section class="mb-5 py-5 bg-purple">
        <div class="bg-light container py-4 projects-cotnainer">

            <h1 class="my-4 text-center text-danger"> My Projects</h1>
            <div class="text-end me-3">
                <a class="btn btn-dark mb-5" href="{{route('admin.projects.create')}}">Aggiungi Progetto</a>
            </div>

            <table class="table table-dark table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Date of Creation</th>
                        <th colspan="2" scope="col">Type of Project</th>
                        <th scope="col">Contributors</th>
                        <th scope="col">More Info</th>
                        <th scope="col">Modify</th>
                        <th scope="col">Delete</th>
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
                            <td class="text-center"><a class="text-success" href="{{route('admin.projects.show', $project)}}">Info</a></td>
                            <td class="text-center"><a class="text-primary" href="{{route('admin.projects.edit', $project)}}">Edit</a></td>
                            <td class="text-center">
                                <form class="item-delete-form" action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
    
                                    <button class="btn link-danger">X</button>
    
                                    <div class="my-modal">
                                        <div class="my-modal__box">
                                            <h5 class="text-center me-5">Do you really want to delete this Project?!</h5>
                                            <span class="link link-danger my-modal-yes mx-5">Yes</span>
                                            <span class="link link-success my-modal-no">No</span>
                                        </div>
                                    </div>
    
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    
@endsection