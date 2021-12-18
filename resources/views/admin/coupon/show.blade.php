@extends('layouts.backend')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Show Post</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="JavaScript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Show Post</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('/admin/post') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/post/' . $post->id . '/edit') }}" title="Edit Post"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/admin/post', $post->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete Post',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Post Author :</th>
                                <td>{{ $post->user?$post->user->name:'' }}</td>
                            </tr>
                            <tr>
                                <th>Category :</th>
                                <td>{{ $post->category?$post->category->name:'' }}</td>
                            </tr>
                            <tr>
                                <th>Permalink :</th>
                                <td>{{ $post->permalink?$post->permalink:'' }}</td>
                            </tr>
                            <tr>
                                <th>Short Title :</th>
                                <td>{{ $post->short_title?$post->short_title:'' }}</td>
                            </tr>
                            <tr>
                                <th>Long Title :</th>
                                <td>{{ $post->long_title?$post->long_title:'' }}</td>
                            </tr>
                            <tr>
                                <th>Short Description :</th>
                                <td>{!! $post->short_description?$post->short_description:'' !!}</td>
                            </tr>
                            <tr>
                                <th>Long Description :</th>
                                <td>{!! $post->long_description?$post->long_description:'' !!}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td>{!! $post->tags?$post->tags:'' !!}</td>
                            </tr>
                            <tr>
                                <th>Meta Keyword :</th>
                                <td>{{ $post->meta_keyword?$post->meta_keyword:'' }}</td>
                            </tr>
                            <tr>
                                <th>Meta Title :</th>
                                <td>{{ $post->meta_title?$post->meta_title:'' }}</td>
                            </tr>
                            <tr>
                                <th>Meta Description :</th>
                                <td>{{ $post->meta_description?$post->meta_description:'' }}</td>
                            </tr>
                            <tr>
                                <th>Feature Image :</th>
                               <td> <img src="{{ asset('storage/post/'.$post->feature_img)}}" width="180" height="140" alt="{{$post->feature_img}}"></td>
                            </tr>
                            <tr>
                                <th>Status :</th>
                                <td> 
                                    @if(!empty($post->status))
                                    <a href="JavaScript:void(0)" class="btn btn-success">Active</a>
                                    @else
                                    <a href="JavaScript:void(0)" class="btn btn-danger">In Active</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Submit Status :</th>
                                <td> 
                                    @if(!empty($post->submit_status))
                                    <a href="JavaScript:void(0)" class="btn btn-info">Published</a>
                                    @else
                                    <a href="JavaScript:void(0)" class="btn btn-primary">Save To Draft</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Schedule Date :</th>
                                <td> {{ $post->sch_date}} </td>
                            </tr>
                            <tr>
                                <th>Schedule Time :</th>
                                <td> {{ $post->sch_time}} </td>
                            </tr>
                            <tr>
                                <th>Schedule Status :</th>
                                <td> 
                                    @if(!empty($post->sch_status))
                                    <a href="JavaScript:void(0)" class="btn btn-info">Yes</a>
                                    @else
                                    <a href="JavaScript:void(0)" class="btn btn-primary">Nos</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Total Viwes :</th>
                                <td> {{ $post->view_count?$post->view_count:0 }} </td>
                            </tr>
                            <tr>
                                <th>Total Likes :</th>
                                <td> {{ $likes?$likes:0 }} </td>
                            </tr>
                            <tr>
                                <th>Total Comments :</th>
                                <td> {{ $comments?$comments:0 }} </td>
                            </tr>
                            <tr>
                                <th>Created At :</th>
                                <td> {{ date('d-M-Y H:i:s', strtotime($post->created_at)) }} </td>
                            </tr>
                            <tr>
                                <th>Updated At :</th>
                                <td> {{ date('d-M-Y H:i:s', strtotime($post->updated_at)) }} </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

