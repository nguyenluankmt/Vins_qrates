@extends('Frontend.Layout.layout')
@section('title', $data['title'])
@section('content')

<div class="header__ordinary_wrap header__list">
    <div class="header__ordinary">
        <div class="header__ordinary_inner">
            <div class="header__ordinary--title">
                <h2 class="header__ordinary--title__body">
                    <span class="header__ordinary--title__key">Featured Projects</span>
                </h2>
            </div>
            <div class="header__ordinary--show_all_btn">
                <div class="btn__show_all">
                    <a href="https://qrates.com/items"><div class="btn__click_area__icon">Show All Projects<i class="qs qs_arrow_right"></i></div></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="items_wrap">
    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__soldout">SOLD OUT</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/DUGINFINITE/items/11758">
                    <img alt="Small thumbnail 8eba734e 8917 496a 8e06 61dc4ab43325" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_8eba734e-8917-496a-8e06-61dc4ab43325.png')}}" width="220"></a>
                    <img alt="Small thumbnail 59a494a7 2851 421f 9227 04e4876012f6" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_59a494a7-2851-421f-9227-04e4876012f6.png')}}" width="220">
            </div>
            <div class="item__title">THE SAMPLER  VOL. 2</div>
            <div class="item__artist_name">DUG INFINITE</div>
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
                <a href="https://qrates.com/artists/mecca73/items/11928"><img alt="Small thumbnail 94b1f445 61f1 4143 90a6 f3c0aabf5ec5" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_94b1f445-61f1-4143-90a6-f3c0aabf5ec5.png')}}" width="220"></a><img alt="Small thumbnail 765da877 1159 4028 b3f9 9698cd3fd944" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_765da877-1159-4028-b3f9-9698cd3fd944.png')}}" width="220">
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
                    <span class="item__pledge--commit">102</span>
                    <span class="item__pledge--total">/100</span>
                </div>
            </div>
            <div class="item__title">Life Sketches: 5yr anniversary 7"</div>
            <div class="item__artist_name">Mecca:83</div>
            <div class="item__state item__state_divider">
                <div class="item__finished">Project Finished</div>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__reserve_now indefinite">Now Funding</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/kyonpalm/items/11848"><img alt="Small thumbnail 772f6576 3d07 4e95 93af f6d27aaf504f" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_772f6576-3d07-4e95-93af-f6d27aaf504f.png')}}" width="220"></a><img alt="Small thumbnail 6250ae57 fcbb 49f2 837f dbae712bb37a" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_6250ae57-fcbb-49f2-837f-dbae712bb37a.png')}}" width="220">
            </div>
            <div class="item__rate    indefinite">
                <div class="item__progress">
                    <div class="progress_circle status_progress--5">
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
                    <span class="item__pledge--commit">10</span>
                    <span class="item__pledge--total">/200</span>
                </div>
            </div>
            <div class="item__title">ＬＩＭＥＲＥＮＣＥ</div>
            <div class="item__artist_name">kyonpalm</div>
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
                <a href="https://qrates.com/artists/TurntablistDISK/items/11430"><img alt="Small thumbnail d42e35c5 705f 4d2b 98d8 2df660a1e7dc" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_d42e35c5-705f-4d2b-98d8-2df660a1e7dc.png')}}" width="220"></a><img alt="Small thumbnail 1ccd8754 0007 4669 820b 9c51860fc195" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_1ccd8754-0007-4669-820b-9c51860fc195.png')}}" width="220">
            </div>
            <div class="item__rate    indefinite">
                <div class="item__progress">
                    <div class="progress_circle status_progress--9">
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
                    <span class="item__pledge--commit">9</span>
                    <span class="item__pledge--total">/100</span>
                </div>
            </div>
            <div class="item__title">Turntablist Breaks Vol.1</div>
            <div class="item__artist_name">TurntablistDISK Scarecrow Music</div>
            <div class="item__state item__state_divider indefinite">
                <div class="item__left"><span>Timeless</span></div>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__soldout">SOLD OUT</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/faxthefox/items/11819"><img alt="Small thumbnail 8304b602 5872 4b19 a98f 38fbac640db1" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_8304b602-5872-4b19-a98f-38fbac640db1.png')}}" width="220"></a><img alt="Small thumbnail 74b163c6 fe25 48d5 9832 b933684c3966" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_74b163c6-fe25-48d5-9832-b933684c3966.png')}}" width="220">
            </div>
            <div class="item__title">Tempus Fugit</div>
            <div class="item__artist_name">Andy Fox</div>
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
                <a href="https://qrates.com/artists/11016/items/11747"><img alt="Small thumbnail e998e4e9 62a7 491b b80a 09595b10aa59" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_e998e4e9-62a7-491b-b80a-09595b10aa59.png')}}" width="220"></a><img alt="Small thumbnail d8130ecc d14d 4baa a422 4172d9a6b3fe" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_d8130ecc-d14d-4baa-a422-4172d9a6b3fe.png')}}" width="220">
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
                    <span class="item__pledge--commit">123</span>
                    <span class="item__pledge--total">/100</span>
                </div>
            </div>
            <div class="item__title">Szédülés</div>
            <div class="item__artist_name">Péterfy Bori &amp; Love Band</div>
            <div class="item__state item__state_divider">
                <div class="item__finished">Project Finished</div>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__onsale">ON SALE</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/baldellirocca/items/11711"><img alt="Small thumbnail 98caeb2f 645a 449f 9ed5 5a1fd6c4c94a" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_98caeb2f-645a-449f-9ed5-5a1fd6c4c94a.png')}}" width="220"></a><img alt="Small thumbnail b04309a7 8ec1 4a0e b5b4 a880a2cece02" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_b04309a7-8ec1-4a0e-b5b4-a880a2cece02.png')}}" width="220">
            </div>
            <div class="item__title">Mischio Dischi Disco MIX 100</div>
            <div class="item__artist_name">Daniele Baldelli &amp; Dj Rocca</div>
            <div class="item__state item__state_divider">
                <span class="item__released">2014.05.15</span>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__soldout">SOLD OUT</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/zainichifunk/items/11478"><img alt="Small thumbnail a6d0e8b1 c7e4 4e97 8533 3d1866a7148e" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_a6d0e8b1-c7e4-4e97-8533-3d1866a7148e.png')}}" width="220"></a><img alt="Small thumbnail 79d43775 b80b 455e b248 dbc2400ebdb6" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_79d43775-b80b-455e-b248-dbc2400ebdb6.png')}}" width="220">
            </div>
            <div class="item__title">場(MURO'S GENBA REMIX)</div>
            <div class="item__artist_name">在日ファンク</div>
            <div class="item__state item__state_divider">
                <div class="item__finished">Project Finished</div>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__soldout">SOLD OUT</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/faxthefox/items/11819"><img alt="Small thumbnail 8304b602 5872 4b19 a98f 38fbac640db1" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_8304b602-5872-4b19-a98f-38fbac640db1.png')}}" width="220"></a><img alt="Small thumbnail 74b163c6 fe25 48d5 9832 b933684c3966" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_74b163c6-fe25-48d5-9832-b933684c3966.png')}}" width="220">
            </div>
            <div class="item__title">Tempus Fugit</div>
            <div class="item__artist_name">Andy Fox</div>
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
                <a href="https://qrates.com/artists/11016/items/11747"><img alt="Small thumbnail e998e4e9 62a7 491b b80a 09595b10aa59" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_e998e4e9-62a7-491b-b80a-09595b10aa59.png')}}" width="220"></a><img alt="Small thumbnail d8130ecc d14d 4baa a422 4172d9a6b3fe" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_d8130ecc-d14d-4baa-a422-4172d9a6b3fe.png')}}" width="220">
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
                    <span class="item__pledge--commit">123</span>
                    <span class="item__pledge--total">/100</span>
                </div>
            </div>
            <div class="item__title">Szédülés</div>
            <div class="item__artist_name">Péterfy Bori &amp; Love Band</div>
            <div class="item__state item__state_divider">
                <div class="item__finished">Project Finished</div>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__onsale">ON SALE</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/baldellirocca/items/11711"><img alt="Small thumbnail 98caeb2f 645a 449f 9ed5 5a1fd6c4c94a" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_98caeb2f-645a-449f-9ed5-5a1fd6c4c94a.png')}}" width="220"></a><img alt="Small thumbnail b04309a7 8ec1 4a0e b5b4 a880a2cece02" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_b04309a7-8ec1-4a0e-b5b4-a880a2cece02.png')}}" width="220">
            </div>
            <div class="item__title">Mischio Dischi Disco MIX 100</div>
            <div class="item__artist_name">Daniele Baldelli &amp; Dj Rocca</div>
            <div class="item__state item__state_divider">
                <span class="item__released">2014.05.15</span>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__soldout">SOLD OUT</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/zainichifunk/items/11478"><img alt="Small thumbnail a6d0e8b1 c7e4 4e97 8533 3d1866a7148e" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_a6d0e8b1-c7e4-4e97-8533-3d1866a7148e.png')}}" width="220"></a><img alt="Small thumbnail 79d43775 b80b 455e b248 dbc2400ebdb6" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_79d43775-b80b-455e-b248-dbc2400ebdb6.png')}}" width="220">
            </div>
            <div class="item__title">場(MURO'S GENBA REMIX)</div>
            <div class="item__artist_name">在日ファンク</div>
            <div class="item__state item__state_divider">
                <div class="item__finished">Project Finished</div>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__soldout">SOLD OUT</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/faxthefox/items/11819"><img alt="Small thumbnail 8304b602 5872 4b19 a98f 38fbac640db1" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_8304b602-5872-4b19-a98f-38fbac640db1.png')}}" width="220"></a><img alt="Small thumbnail 74b163c6 fe25 48d5 9832 b933684c3966" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_74b163c6-fe25-48d5-9832-b933684c3966.png')}}" width="220">
            </div>
            <div class="item__title">Tempus Fugit</div>
            <div class="item__artist_name">Andy Fox</div>
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
                <a href="https://qrates.com/artists/11016/items/11747"><img alt="Small thumbnail e998e4e9 62a7 491b b80a 09595b10aa59" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_e998e4e9-62a7-491b-b80a-09595b10aa59.png')}}" width="220"></a><img alt="Small thumbnail d8130ecc d14d 4baa a422 4172d9a6b3fe" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_d8130ecc-d14d-4baa-a422-4172d9a6b3fe.png')}}" width="220">
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
                    <span class="item__pledge--commit">123</span>
                    <span class="item__pledge--total">/100</span>
                </div>
            </div>
            <div class="item__title">Szédülés</div>
            <div class="item__artist_name">Péterfy Bori &amp; Love Band</div>
            <div class="item__state item__state_divider">
                <div class="item__finished">Project Finished</div>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__onsale">ON SALE</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/baldellirocca/items/11711"><img alt="Small thumbnail 98caeb2f 645a 449f 9ed5 5a1fd6c4c94a" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_98caeb2f-645a-449f-9ed5-5a1fd6c4c94a.png')}}" width="220"></a><img alt="Small thumbnail b04309a7 8ec1 4a0e b5b4 a880a2cece02" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_b04309a7-8ec1-4a0e-b5b4-a880a2cece02.png')}}" width="220">
            </div>
            <div class="item__title">Mischio Dischi Disco MIX 100</div>
            <div class="item__artist_name">Daniele Baldelli &amp; Dj Rocca</div>
            <div class="item__state item__state_divider">
                <span class="item__released">2014.05.15</span>
            </div>
        </div>
    </div>

    <div class="item_box">
        <div class="item__body">
            <div class="item__ribbon">
                <div class="ribbon__body ribbon__soldout">SOLD OUT</div>
            </div>
            <div class="item__image">
                <a href="https://qrates.com/artists/zainichifunk/items/11478"><img alt="Small thumbnail a6d0e8b1 c7e4 4e97 8533 3d1866a7148e" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_a6d0e8b1-c7e4-4e97-8533-3d1866a7148e.png')}}" width="220"></a><img alt="Small thumbnail 79d43775 b80b 455e b248 dbc2400ebdb6" class="item__vinyl" height="220" src="{{ URL::asset('Frontend/styleCss/small_thumbnail_79d43775-b80b-455e-b248-dbc2400ebdb6.png')}}" width="220">
            </div>
            <div class="item__title">場(MURO'S GENBA REMIX)</div>
            <div class="item__artist_name">在日ファンク</div>
            <div class="item__state item__state_divider">
                <div class="item__finished">Project Finished</div>
            </div>
        </div>
    </div>
</div>


<div class="paginate">
    <div class="pagination_wrap">
        <nav class="pagination">
            <span class="prev"><a href="https://qrates.com/items/featured" rel="prev">Prev</a></span>
             <div class="per-page">
                 <span class="page"><a href="https://qrates.com/items/featured" rel="prev">1</a></span>
                 <span class="page current">2</span>
             </div>
             <span class="next last">Next</span>
         </nav>
     </div>
</div>
@endsection