<x-layout bodyClass="subPage contactPage">

    <livewire:header/>

    <section class="header-title section-padding">
        <div class="container text-center">
            <h2 class="title">Contact</h2>
            <span class="sub-title">Home > Contact </span>
        </div>
    </section>

    <section class="map-section">
        <h2 class="hidden">na</h2>

        {!! $contact->google_map !!}
    </section>

    <section class="contact-section section-padding">
        <div class="container">
            <div class="contact-wrapper">
                <div class="section-title text-center">
                    <h2>Contact us</h2>
                    <p>Please contact us using the information below.</p>
                </div>

                <div class="row">
                    <livewire:contact-us/>

                    <div class="col-md-6">
                        <ul class="location">
                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <div class="text">{{$contact->info['address1']}} <br> {{$contact->info['address2']}} <br> {{$contact->info['address3']}}</div>
                            </li>
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <div class="text">{{$contact->info['call']}}</div>
                            </li>
                            <li>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <div class="text">{{$contact->info['email']}}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
