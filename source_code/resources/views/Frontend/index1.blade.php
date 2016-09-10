 @extends('Frontend.Layout.layout')
@section('title', $data['title'])
@section('content')
<section class="user_toppage__hero top_carousel_banner">
        <div class="swiper-container swiper-container-horizontal swiper-container-fade" data-autoplay="true">
            <div class="swiper-wrapper" style="transition-duration: 0ms;">
                <div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1" style="width: 1349px; transform: translate3d(0px, 0px, 0px); transition-duration: 0ms; opacity: 0;">
                    <div class="banner">
                        <a href="https://blog.qrates.com/artist-interview-rive-gauche-2998a7425266#.j82het1u1">
                            <div class="background" style="background-image: url(//d1x26sjkwh9vok.cloudfront.net/assets/top_banners/artistinterview03-cfa80168cb6a228fc76725ba9c0b5a42.jpg)"></div>
                            <div class="banner-content align-left align-bottom">
                                <div class="series-title">Interview:</div>
                                <div class="title">RIVE GAUCHE</div>
                                <div class="sub-title">- teaser is the key to success -</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="0" style="width: 1349px; transform: translate3d(-1349px, 0px, 0px); transition-duration: 0ms; opacity: 0;">
                    <div class="banner">
                        <a href="https://vinylize.it/" target="_blank">
                            <div class="background" style="background-image: url(//d1x26sjkwh9vok.cloudfront.net/assets/top_banners/bg_vinylizeit-cccc2662f2b5f57b4d2bfa42aa41368d.jpg)"></div>
                            <div class="banner-content">
                                <div class="title">
                                    <img alt="Vinylize.it" class="logo-image" src="{{ URL::asset('Frontend/styleCss/fig_vinylizeit_logo-8d8fde2a10a6769514f5d115064bb66e.svg')}}">
                                </div>
                                <div class="sub-title">Want It, Share It, Vinylize It<br>Make real vinyl records from any SoundCloud track.</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="1" style="width: 1349px; transform: translate3d(-2698px, 0px, 0px); transition-duration: 0ms; opacity: 1;">
                    <div class="banner">
                        <a href="https://blog.qrates.com/artist-interview-rive-gauche-2998a7425266#.j82het1u1">
                            <div class="background" style="background-image: url(//d1x26sjkwh9vok.cloudfront.net/assets/top_banners/artistinterview03-cfa80168cb6a228fc76725ba9c0b5a42.jpg)"></div>
                            <div class="banner-content align-left align-bottom">
                                <div class="series-title">Interview:</div>
                                <div class="title">RIVE GAUCHE</div>
                                <div class="sub-title">- teaser is the key to success -</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="swiper-slide swiper-slide-duplicate swiper-slide-next" data-swiper-slide-index="0" style="width: 1349px; transform: translate3d(-4047px, 0px, 0px); transition-duration: 0ms; opacity: 0;">
                    <div class="banner">
                        <a href="https://vinylize.it/" target="_blank">
                            <div class="background" style="background-image: url(//d1x26sjkwh9vok.cloudfront.net/assets/top_banners/bg_vinylizeit-cccc2662f2b5f57b4d2bfa42aa41368d.jpg)"></div>
                            <div class="banner-content">
                                <div class="title">
                                    <img alt="Vinylize.it" class="logo-image" src="{{ URL::asset('Frontend/styleCss/fig_vinylizeit_logo-8d8fde2a10a6769514f5d115064bb66e.svg')}}">
                                </div>
                                <div class="sub-title">Want It, Share It, Vinylize It<br>Make real vinyl records from any SoundCloud track.</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination swiper-pagination-clickable">
                <span class="swiper-pagination-bullet"></span>
                <span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
    <section class="content-whats-qrates">
        <h3>What's QRATES?</h3>
        <div class="projects_row_wrap">
            <div class="project_box">
                <div class="image_box">
                    <img alt="Image003" src="{{ URL::asset('Frontend/styleCss/image003-d11ee31931b8f3dcd83f2e197c11cba1.png')}}">
                </div>
                <h4>On Demand Vinyl</h4>
                <div class="description">Start taking pre-orders or press with crowdfunding from little as 100 copies.</div>
            </div>
            <div class="project_box">
                <div class="image_box">
                    <img alt="Image004" src="{{ URL::asset('Frontend/styleCss/image004-a813a932ffa5dd15549dc994cc4d7527.png')}}">
                </div>
                <h4>World Class Speed and Quality</h4>
                <div class="description">Average delivery in 6-8 weeks.  Shipping worldwide.</div>
            </div>
            <div class="project_box">
                <div class="image_box">
                    <img alt="Image011" src="{{ URL::asset('Frontend/styleCss/image011-1aca9e5faeb709b216bd595e21d0a731.png')}}">
                </div>
                <h4>Financial risk and free fulfilment</h4>
                <div class="description">offering multiple solutions</div>
            </div>
        </div>
        <div class="btn__learn_more">
            <a data-ga-event="Inbound|Click|WhatsQratesSectionLearnMore|https://qrates.com/about" href="https://qrates.com/about">
                <div class="btn__click_area">Learn More</div>
            </a>
        </div>
    </section>
    <div class="divider"></div>
    <div class="user_toppage__featured">
        <div class="user_toppage__featured__body">
            <h3 class="user_toppage__heading">Featured Projects
                <a class="show_more" href="https://qrates.com/items/featured">
                    <i class="qs qs_show_more"></i>
                </a>
            </h3>
            <div class="items_row_wrap">
                <div class="item_box">
                    <div class="item__body">
                        <div class="item__ribbon">
                            <div class="ribbon__body ribbon__reserve_now">Now Funding</div>
                        </div>
                        <div class="item__image">
                            <a href="https://qrates.com/artists/adamsantoya/items/12480">
                                <img alt="Small thumbnail 493d1a39 bd26 4792 b32c 7f02a55f2bdc" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_493d1a39-bd26-4792-b32c-7f02a55f2bdc.png')}}" width="220">
                            </a>
                            <img alt="Small thumbnail d616508a eecd 439c 881f 5fb875c89acb" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_d616508a-eecd-439c-881f-5fb875c89acb.png')}}" width="220">
                        </div>
                        <div class="item__rate    ">
                            <div class="item__progress">
                                <div class="progress_circle status_progress--13">
                                    <div class="circle__cap"></div>
                                    <div class="circle__mask full">
                                        <div class="circle__fill"></div>
                                    </div>
                                    <div class="circle__mask half">
                                        <div class="circle__fill"></div>
                                        <div class="circle__fill fix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item__pledge">
                                <span class="item__pledge--commit">13</span>
                                <span class="item__pledge--total">/100</span>
                            </div>
                        </div>
                        <div class="item__title">Up</div>
                        <div class="item__artist_name">Adam Santoya</div>
                        <div class="item__state item__state_divider">
                            <div class="item__left">
                                <span class="item__left--rest ">83</span>
                                <span class="item__left--format">Days Left</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item_box">
                    <div class="item__body">
                        <div class="item__ribbon">
                            <div class="ribbon__body ribbon__reserve_now indefinite">Now Funding</div>
                        </div>
                        <div class="item__image">
                            <a href="https://qrates.com/artists/11909/items/12420">
                                <img alt="Small thumbnail 15c38d03 461f 436b b129 adec9e777275" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_15c38d03-461f-436b-b129-adec9e777275.png')}}" width="220">
                            </a>
                            <img alt="Small thumbnail b25ab2eb 73a7 4290 b045 f5daf04f2fda" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_b25ab2eb-73a7-4290-b045-f5daf04f2fda.png')}}" width="220">
                        </div>
                        <div class="item__rate    indefinite">
                            <div class="item__progress">
                                <div class="progress_circle status_progress--47">
                                    <div class="circle__cap"></div>
                                    <div class="circle__mask full">
                                        <div class="circle__fill"></div>
                                    </div>
                                    <div class="circle__mask half">
                                        <div class="circle__fill"></div>
                                        <div class="circle__fill fix"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item__pledge">
                                <span class="item__pledge--commit">238</span>
                                <span class="item__pledge--total">/500</span>
                            </div>
                        </div>
                        <div class="item__title">Endless Summer (Vocal Edition)</div>
                        <div class="item__artist_name">The Midnight</div>
                        <div class="item__state item__state_divider indefinite">
                            <div class="item__left">
                                <span>Timeless</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item_box">
                    <div class="item__body">
                        <div class="item__ribbon">
                            <div class="ribbon__body ribbon__reserve_now indefinite">Now Funding</div>
                        </div>
                        <div class="item__image">
                            <a href="https://qrates.com/artists/shelter/items/12487">
                                <img alt="Small thumbnail 57ae62f7 82d8 4805 83e1 3a824afcda1f" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_57ae62f7-82d8-4805-83e1-3a824afcda1f.png')}}" width="220">
                            </a>
                            <img alt="Small thumbnail 2e563289 e98b 416e 8979 8e03cb41f744" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_2e563289-e98b-416e-8979-8e03cb41f744.png')}}" width="220">
                        </div>
                        <div class="item__rate    indefinite">
                            <div class="item__progress">
                                <div class="progress_circle status_progress--8">
                                    <div class="circle__cap"></div>
                                    <div class="circle__mask full">
                                        <div class="circle__fill"></div>
                                    </div>
                                    <div class="circle__mask half">
                                        <div class="circle__fill"></div>
                                        <div class="circle__fill fix"></div>
                                    </div>
                                </div>
                        </div>
                        <div class="item__pledge">
                            <span class="item__pledge--commit">8</span>
                            <span class="item__pledge--total">/100</span>
                        </div>
                    </div>
                    <div class="item__title">Double Yellow Lines</div>
                    <div class="item__artist_name">Shelter</div>
                    <div class="item__state item__state_divider indefinite">
                        <div class="item__left">
                            <span>Timeless</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="item__body">
                    <div class="item__ribbon">
                        <div class="ribbon__body ribbon__reserve_now">Now Funding</div>
                    </div>
                    <div class="item__image">
                        <a href="https://qrates.com/artists/djhybrid/items/12504">
                            <img alt="Small thumbnail ceb9eacf 72be 451a 8283 4825be970cfb" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_ceb9eacf-72be-451a-8283-4825be970cfb.png')}}" width="220">
                        </a>
                        <img alt="Small thumbnail 44155942 48d0 4883 85cf 2cf8a2c859cf" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_44155942-48d0-4883-85cf-2cf8a2c859cf.png')}}" width="220">
                    </div>
                    <div class="item__rate    ">
                        <div class="item__progress">
                            <div class="progress_circle status_progress--25">
                                <div class="circle__cap"></div>
                                <div class="circle__mask full">
                                    <div class="circle__fill"></div>
                                </div>
                                <div class="circle__mask half">
                                    <div class="circle__fill"></div>
                                    <div class="circle__fill fix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item__pledge">
                            <span class="item__pledge--commit">25</span>
                            <span class="item__pledge--total">/100</span>
                        </div>
                    </div>
                    <div class="item__title">Badboy / Badboy (Kartoon Remix)</div>
                    <div class="item__artist_name">DJ Hybrid</div>
                    <div class="item__state item__state_divider">
                        <div class="item__left">
                            <span class="item__left--rest ">53</span>
                            <span class="item__left--format">Days Left</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
<div class="user_toppage__achieved">
    <div class="user_toppage__achieved__body">
        <h3 class="user_toppage__heading">Recent Completed Projects</h3>
        <div class="items_row_wrap">
            <div class="item_box">
                <div class="item__body">
                    <div class="item__ribbon">
                        <div class="ribbon__body ribbon__achieved">Succeeded!</div>
                    </div>
                    <div class="item__image">
                        <a href="https://qrates.com/artists/dr_unkenbeat/items/12189">
                            <img alt="Small thumbnail 69565ef3 922c 4497 97c0 fc62a57106dd" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_69565ef3-922c-4497-97c0-fc62a57106dd.png')}}" width="220">
                        </a>
                        <img alt="Small thumbnail 79c738d8 a7a1 4f77 8f90 4c7cb23b7ce0" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_79c738d8-a7a1-4f77-8f90-4c7cb23b7ce0.png')}}" width="220">
                    </div>
                    <div class="item__rate  status_project_achieved--finished  ">
                        <div class="item__progress">
                            <div class="progress_circle status_progress--100">
                                <div class="circle__cap"></div>
                                <div class="circle__mask full">
                                    <div class="circle__fill"></div>
                                </div>
                                <div class="circle__mask half">
                                    <div class="circle__fill"></div>
                                    <div class="circle__fill fix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item__pledge">
                            <span class="item__pledge--commit">101</span>
                            <span class="item__pledge--total">/100</span>
                        </div>
                    </div>
                    <div class="item__title">You &amp; Me</div>
                    <div class="item__artist_name">Dr. Unkenbeat</div>
                    <div class="item__state item__state_divider">
                        <div class="item__finished">Project Finished</div>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="item__body">
                    <div class="item__ribbon">
                        <div class="ribbon__body ribbon__achieved">Succeeded!</div>
                    </div>
                    <div class="item__image">
                        <a href="https://qrates.com/artists/ChillhopRecords/items/12341">
                            <img alt="Small thumbnail fd6466ab 83e3 4d56 ba24 33e972fb7b99" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_fd6466ab-83e3-4d56-ba24-33e972fb7b99.png')}}" width="220">
                        </a>
                        <img alt="Small thumbnail bc1e1357 20c1 4c1b 9154 20d5ba976832" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_bc1e1357-20c1-4c1b-9154-20d5ba976832.png')}}" width="220">
                    </div>
                    <div class="item__rate  status_project_achieved--finished  indefinite">
                        <div class="item__progress">
                            <div class="progress_circle status_progress--100">
                                <div class="circle__cap"></div>
                                <div class="circle__mask full">
                                    <div class="circle__fill"></div>
                                </div>
                                <div class="circle__mask half">
                                    <div class="circle__fill"></div>
                                    <div class="circle__fill fix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item__pledge">
                            <span class="item__pledge--commit">208</span>
                            <span class="item__pledge--total">/200</span>
                        </div>
                    </div>
                    <div class="item__title">Slowmocean</div>
                    <div class="item__artist_name">Deeb</div>
                    <div class="item__state item__state_divider">
                        <div class="item__finished">Project Finished</div>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="item__body">
                    <div class="item__ribbon">
                        <div class="ribbon__body ribbon__achieved">Succeeded!</div>
                    </div>
                    <div class="item__image">
                        <a href="https://qrates.com/artists/Greenland/items/12231">
                            <img alt="Small thumbnail e14cd915 7d63 4a78 a3c2 9627c9cb454a" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_e14cd915-7d63-4a78-a3c2-9627c9cb454a.png')}}" width="220">
                        </a>
                        <img alt="Small thumbnail c78cb3ca 0f7b 4a59 87b1 544b5d179872" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_c78cb3ca-0f7b-4a59-87b1-544b5d179872.png')}}" width="220">
                    </div>
                    <div class="item__rate  status_project_achieved--finished  ">
                        <div class="item__progress">
                            <div class="progress_circle status_progress--100">
                                <div class="circle__cap"></div>
                                <div class="circle__mask full">
                                    <div class="circle__fill"></div>
                                </div>
                                <div class="circle__mask half">
                                    <div class="circle__fill"></div>
                                    <div class="circle__fill fix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item__pledge">
                            <span class="item__pledge--commit">101</span>
                            <span class="item__pledge--total">/100</span>
                        </div>
                    </div>
                    <div class="item__title">Shitty Fiction</div>
                    <div class="item__artist_name"> Greenland</div>
                    <div class="item__state item__state_divider">
                        <div class="item__finished">Project Finished</div>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="item__body">
                    <div class="item__ribbon">
                        <div class="ribbon__body ribbon__achieved">Succeeded!</div>
                    </div>
                    <div class="item__image">
                        <a href="https://qrates.com/artists/rivegauchemusic/items/12121">
                            <img alt="Small thumbnail 46ec595c 961d 4807 9cf1 25f0578f4788" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_46ec595c-961d-4807-9cf1-25f0578f4788.png')}}" width="220">
                        </a>
                        <img alt="Small thumbnail 482ca815 dbf2 4451 8c2c db607e2be40b" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_482ca815-dbf2-4451-8c2c-db607e2be40b.png')}}" width="220">
                    </div>
                    <div class="item__rate  status_project_achieved--finished  ">
                        <div class="item__progress">
                            <div class="progress_circle status_progress--100">
                                <div class="circle__cap"></div>
                                <div class="circle__mask full">
                                    <div class="circle__fill"></div>
                                </div>
                                <div class="circle__mask half">
                                    <div class="circle__fill"></div>
                                    <div class="circle__fill fix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item__pledge">
                            <span class="item__pledge--commit">201</span>
                            <span class="item__pledge--total">/200</span>

                        </div>
                    </div>
                    <div class="item__title">WALKING... (with SIMBAD &amp; GILLES PETERSON remixes)</div>
                    <div class="item__artist_name">RIVE GAUCHE</div>
                    <div class="item__state item__state_divider">
                        <div class="item__finished">Project Finished</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
<div class="user_toppage__timeline">
    <div class="user_toppage__timeline__body">
        <h3 class="user_toppage__heading">
            <i class="qs qs_plus"></i>
            Vinyl Projects You Are Following
            <a class="show_more" href="https://qrates.com/timeline">
                <i class="qs qs_show_more"></i>
            </a>
        </h3>
        <div class="items_row_wrap">
            <div class="item_box">
                <div class="item__body">
                    <div class="item__ribbon">
                        <div class="ribbon__body ribbon__reserve_now">Now Funding</div>
                    </div>
                    <div class="item__image">
                        <a href="https://qrates.com/artists/djhybrid/items/12504">
                            <img alt="Small thumbnail ceb9eacf 72be 451a 8283 4825be970cfb" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_ceb9eacf-72be-451a-8283-4825be970cfb.png')}}" width="220">
                        </a>
                        <img alt="Small thumbnail 44155942 48d0 4883 85cf 2cf8a2c859cf" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_44155942-48d0-4883-85cf-2cf8a2c859cf.png')}}" width="220">
                    </div>
                    <div class="item__rate    ">
                        <div class="item__progress">
                            <div class="progress_circle status_progress--25">
                                <div class="circle__cap"></div>
                                <div class="circle__mask full">
                                    <div class="circle__fill"></div>
                                </div>
                                <div class="circle__mask half">
                                    <div class="circle__fill"></div>
                                    <div class="circle__fill fix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item__pledge">
                            <span class="item__pledge--commit">25</span>
                            <span class="item__pledge--total">/100</span>
                        </div>
                    </div>
                    <div class="item__title">Badboy / Badboy (Kartoon Remix)</div>
                    <div class="item__artist_name">DJ Hybrid</div>
                    <div class="item__state item__state_divider">
                        <div class="item__left">
                            <span class="item__left--rest ">53</span>
                            <span class="item__left--format">Days Left</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item_box">
                <div class="item__body">
                    <div class="item__ribbon">
                        <div class="ribbon__body ribbon__achieved">Succeeded!</div>
                    </div>
                    <div class="item__image">
                        <a href="https://qrates.com/artists/Greenland/items/12231">
                            <img alt="Small thumbnail e14cd915 7d63 4a78 a3c2 9627c9cb454a" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_e14cd915-7d63-4a78-a3c2-9627c9cb454a.png')}}" width="220">
                        </a>
                        <img alt="Small thumbnail c78cb3ca 0f7b 4a59 87b1 544b5d179872" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_c78cb3ca-0f7b-4a59-87b1-544b5d179872.png')}}" width="220">
                    </div>
                    <div class="item__rate  status_project_achieved--finished  ">
                        <div class="item__progress">
                            <div class="progress_circle status_progress--100">
                                <div class="circle__cap"></div>
                                <div class="circle__mask full">
                                    <div class="circle__fill"></div>
                                </div>
                                <div class="circle__mask half">
                                    <div class="circle__fill"></div>
                                    <div class="circle__fill fix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="item__pledge">
                             <span class="item__pledge--commit">101</span>
                            <span class="item__pledge--total">/100</span>
                        </div>
                    </div>
                    <div class="item__title">Shitty Fiction</div>
                    <div class="item__artist_name"> Greenland</div>
                    <div class="item__state item__state_divider">
                        <div class="item__finished">Project Finished</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="user_toppage__news">
    <div class="user_toppage__reserved__body">
        <div class="section">
            <h3 class="user_toppage__heading">News and Updates
                <a class="show_more" href="https://blog.qrates.com/" target="_blank">
                    <i class="qs qs_show_more"></i>
                </a>
            </h3>
        </div>
        <div class="items_row_wrap">
            <div class="thumbnail">
                <article>
                    <a href="https://blog.qrates.com/new-pricing-on-qrates-9c2ba7147fe0?source=rss----b51858323644---4" style="background-image:url(https://d262ilb51hltx0.cloudfront.net/max/600/1*Puo1tZ7qUW72kpdxG_08Lg.jpeg);" target="_blank">
                        
                    </a>
                    <p class="title">New Pricing on QRATES!</p>
                    <p class="date">2016.08.24</p>
                </article>
            </div>
            <div class="thumbnail">
                <article>
                    <a href="https://blog.qrates.com/qrates-vinylize-it-%E3%83%BCget-tracks-from-soundcloud-onto-vinyl-aceb5ee0d254?source=rss----b51858323644---4" style="background-image:url(https://d262ilb51hltx0.cloudfront.net/max/600/1*ofWeRBAQgAayuCsFDPGT8A.jpeg);" target="_blank">
                        
                    </a>
                    <p class="title">QRATES × Vinylize.it ーGet tracks from SoundCloud onto Vinyl !</p>
                    <p class="date">2016.08.12</p>
                </article>
            </div>
            <div class="thumbnail">
                <article>
                    <a href="https://blog.qrates.com/dub-store-sound-inc-becomes-a-qrates-store-delivery-partner-caf04e173a80?source=rss----b51858323644---4" style="background-image:url(https://d262ilb51hltx0.cloudfront.net/max/600/1*OF-EryvXoi_lpbQIwiM-tQ.jpeg);" target="_blank">
                        
                    </a>
                    <p class="title">Dub Store Sound Inc. becomes a QRATES Store Delivery partner</p>
                    <p class="date">2016.07.29</p>
                </article>
            </div>
        </div>
    </div>
</div>
<section class="content-vinylize">
    <h3>Vinylize Your Music</h3>
    <div class="image_box">
        <img alt="Image008" src="{{ URL::asset('Frontend/styleCss/image008-6bccb32312adf9357ea473d1360ea88a.png')}}">
    </div>
    <div class="btn__start_project">
        <a data-ga-event="Inbound|Click|VinylizeSectionCTA|https://qrates.com/vinylize" href="https://qrates.com/vinylize">
            <div class="btn__click_area">Start a Project</div>
        </a>
    </div>
</section>
</div>

@endsection