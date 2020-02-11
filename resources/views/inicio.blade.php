@extends('layout.base')

@section('header')

@endsection


@section('content')
        <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Panel Principal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Panel Principal</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        @php
                            $user = $profile->getUser();
                        @endphp
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ $user->getProfileImageUrl() }}"
                                 alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->getName() }}</h3>
                        <p class="text-muted text-center">Se unió el {{ Utilidades::twitterDateFormat($user->getCreatedAt()) }}</p>
                        <p class="text-muted text-center">{{ $user->getDescription() }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Seguidores</b> <a class="float-right">{{ $user->getFollowersCount() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Siguiendo</b> <a class="float-right">{{ $user->getFriendsCount() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tweets</b> <a class="float-right">{{ $user->getStatusesCount() }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Likes</b> <a class="float-right">{{ $user->getFavouritesCount() }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-2">

                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $user->getStatusesCount() }}</h3>

                            <p>Tweets</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-comment-dots"></i>
                        </div>
                        <a href="/mytweets" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>

                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $user->getFavouritesCount() }}</h3>

                            <p>Me Gusta</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-heart"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>

                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $user->getFollowersCount() }}</h3>
                            <p>Seguidores</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>

                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $user->getFriendsCount() }}</h3>
                            <p>Seguidos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Ver más <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>

            </div>
            <div class="col-md-7">
                <div class="card">
                    @php
                        // TODO: Esto puede ser una configuración del perfil. 
                        // El numero de estados se puede recuperar de las configuraciones de la applicación.
                        $numStatuses = 12;
                        $lastStatuses = $profile->getLastsStatuses($numStatuses);
                    @endphp
                    <div class="card-header p-2">
                        Ultimos {{ $numStatuses }} Tweets
                    </div><!-- /.card-header -->
                    <div class="card-body">

                        <!-- Post -->
                        

                        @foreach ($lastStatuses as $tweet)
                        <div class="post clearfix">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="{{ $tweet->getUser()->getProfileImageUrl() }}" alt="user image">
                                <span class="username">
                                <a href="#">{{ $tweet->getUser()->getName() }}</a>
                                </span>
                                <span class="description">{{ Utilidades::twitterDateFormatHumans($tweet->getCreatedAt()) }}</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                {{ $tweet->getText() }}
                            </p>

                            <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                <span class="float-right">
                                    <span class="pr-2"><i class="fas fa-retweet"></i> {{ $tweet->getRetweetCount() }} </span> | 
                                    <span class="pr-2"><i class="fas fa-heart pl-2"></i> {{ $tweet->getFavoriteCount() }} </span> |
                                    <i class="far fa-comments pl-2"></i> 5
                                </span>
                            </p>
                        </div>
                        <!-- /.post -->
                        @endforeach
                
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">

            <!-- ./col -->
        </div>

        {{-- <div class="row">
            {{ print_r($credentials) }}
        </div> --}}

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection

@section('footer')

@endsection