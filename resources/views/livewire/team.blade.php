<?php

use App\Models\FrontPage\Team;
use Illuminate\Support\Facades\Cache;
use function Livewire\Volt\{state};

state([
    'teams' => function () {
        return Cache::remember('TEAM', now()->addHours(24), function () {
            return Team::get();
        });
    }
])

?>

<div class="row">
    <div class="section-wrapper">
        @foreach($teams as $team)
            <div class="col-sm-3">
                <div class="team-wrapper">
                    <div class="caption">
                        <img src="{{env('STORAGE_PREFIX', '').$team->image}}" alt="">

                        <ul class="hover-view">
                            <li><a href="http://facebook.com/{{$team->socials['fb']}}" target="_blank"><i
                                        class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="http://instagram.com/{{$team->socials['insta']}}" target="_blank"><i
                                        class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="http://linkedin.com/{{$team->socials['linkedin']}}" target="_blank"><i
                                        class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                    <div class="contact-wrapper">
                        <h4><a href="#">{{$team->name}}</a></h4>
                        <span class="position">{{$team->designation}}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
