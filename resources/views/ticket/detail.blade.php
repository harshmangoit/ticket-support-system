@extends('layouts.default')

@section('title', 'Ticket Detail')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.css' )}}" media="screen" />
<link rel="stylesheet" href="{{ asset('assets/style.css' )}}" />
@endpush

@section('content')

@php $user = auth()->user() @endphp
<div class="container">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Ticket Number : {{$ticket->ticket_no}}</h3>
                            @if($user->role != '3' && $ticket->status == '0')
                            <a href="{{ route('ticket.close', ['id'=>$ticket->id, 'user_id'=>$user->id]) }} "><input type="button" onclick="return confirm('Are you really want to close this ticket..!')" class="btn ml-3 btn-sm btn-danger" value="Close Ticket"></input></a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Details
                                        </h3>
                                    </div>
                                    <!-- ./card-header -->
                                    <div class="card-body">
                                        <blockquote>
                                            <p>Title: {{$ticket->title}}</p>
                                            <p>Category: {{$ticket->category->name}}</p>
                                            <p>Detail: {{$ticket->detail}}</p>
                                        </blockquote>
                                        @foreach($ticket->images as $image)
                                        <a id="example1" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" class="mr-3" alt="img" style="width: 100px"></a>
                                        @endforeach
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- ./col -->
                        </div>
                        <!-- /.row -->

                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header">
                                <h3 class="card-title">Chats</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    @foreach($ticket->comments as $comment)
                                    @if($comment->user->role != $user->role)
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">{{ $comment->user->name }}</span>
                                            <span class="direct-chat-timestamp float-right">{{ $comment->created_at->format('j M g:i A') }}</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="{{asset('dist/img/user1-128x128.jpg')}}" alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{$comment->message}}
                                        </div>
                                        @foreach($comment->images as $image)
                                        <a id="example1" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" class="mr-3" alt="img" style="width:100px"></a>
                                        @endforeach
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                    @else
                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-right">{{ $comment->user->name }}</span>
                                            <span class="direct-chat-timestamp float-left">{{ $comment->created_at->format('j M g:i A') }}</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="{{asset('dist/img/user2-160x160.jpg')}}" alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{$comment->message}}
                                        </div>
                                        @foreach($comment->images as $image)
                                        <a id="example1" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" class="mr-3" alt="" style="width:100px"></a>
                                        @endforeach
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                    @endif
                                    @endforeach
                                </div>
                                <!-- Chat of admin lte3 -->
                            </div>
                        </div>

                        @if($ticket->status == 0)
                        <!-- form start -->
                        <form id="commentForm" action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <div class="form-group">
                                    <label for="message">Comment:</label>
                                    <div class="input-group">
                                        <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control @error('message') is-invalid @enderror">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </span>
                                        @error('message')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="images">Image:</label>
                                    <input type="file" name="images[]" id="images" class="@error('images.*') is-invalid @enderror" multiple>
                                    @error('images.*')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                        @endif
                        <div class="card-footer">
                            <a href="{{ route('ticket.index') }} "><input type="button" class="btn btn-primary" value="Back"></input></a>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection

    @push('scripts')
    <!-- jquery-validation -->
    <!-- <script src="{{ asset('assets/js/script.js') }}"></script> -->
    <!-- <script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script> -->
    <!-- <script src="{{ asset('../../plugins/jquery-validation/jquery.validate.min.js') }}"></script> -->
    
    <!-- jquery-fancybox -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/fancybox/jquery.mousewheel-3.0.4.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/fancybox/jquery.fancybox-1.3.4.pack.js') }}"></script>
    @endpush