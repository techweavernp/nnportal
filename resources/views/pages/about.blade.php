<x-layout bodyClass="subPage aboutPage">
    <livewire:header/>
    <section class="header-title section-padding">
        <div class="container text-center">
            <h2 class="title">About</h2>
            <span class="sub-title">Home > About</span>
        </div>
    </section> <!-- header-title -->

    <section class="about-office-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="content">
                        <h3>{!! $about->title !!}</h3>

                        {!! $about->description !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="caption text-center wow slideInRight">
                        <img src="{{env('STORAGE_PREFIX', '').$about->image}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="counting-section section-padding">
        <div class="container">
            <h2 class="hidden">na</h2>

            <div class="counting-pusher">
                <div class="counting-wrapper">
                    <span class="icon pull-left"><img src="{{asset('assets/images/about/1.png')}}" alt=""></span>

                    <div class="content">
                        <div class="count-description">
                            <span class="timer">{{$about->counter['team_member']}}</span>
                        </div>
                        <p>Team Members</p>
                    </div>
                </div>

                <div class="counting-wrapper">
                    <span class="icon pull-left"><img src="{{asset('assets/images/about/2.png')}}" alt=""></span>

                    <div class="content">
                        <div class="count-description">
                            <span class="timer">{{$about->counter['satisfied_client']}}</span>
                        </div>
                        <p>Satisfied Clients</p>
                    </div>
                </div>

                <div class="counting-wrapper">
                    <span class="icon pull-left"><img src="{{asset('assets/images/about/3.png')}}" alt=""></span>

                    <div class="content">
                        <div class="count-description">
                            <span class="timer">{{$about->counter['case_files']}}</span>
                        </div>
                        <p>Case files</p>
                    </div>
                </div>

                <div class="counting-wrapper">
                    <span class="icon pull-left"><img src="{{asset('assets/images/about/4.png')}}" alt=""></span>

                    <div class="content">
                        <div class="count-description">
                            <span class="timer">{{$about->counter['projects']}}</span>
                        </div>
                        <p>Successful Projects</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-layout>
