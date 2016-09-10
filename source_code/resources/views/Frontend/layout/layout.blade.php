<!DOCTYPE html>
<html class="view_top_index">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>QRATES</title>
        
        <script async="" charset="utf-8" src="{{ URL::asset('Frontend/styleCss/saved_resource.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('Frontend/styleCss/nr-974.min.js')}}"></script>
        <script async="" src="{{ URL::asset('Frontend/styleCss/analytics.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('Frontend/styleCss/qrates.js')}}"></script>
        <link href="https://d1x26sjkwh9vok.cloudfront.net/assets/favicon-01c8fdb79bae9e4528c116149e73fe59.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <link href="{{ URL::asset('Frontend/styleCss/application-qrates.css')}}" media="all" rel="stylesheet">
        <script src="{{ URL::asset('Frontend/styleCss/sdk-3.1.2.js')}}"></script>

        <script src="{{ URL::asset('Frontend/styleCss/application-bf056b6f9804002851be0eca85efb855.js')}}"></script>
        <script type="text/javascript">(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-59387537-1', 'auto');ga('send', 'pageview');
            $(function(){
              $('[data-ga-event]').click(function(e) {
                var args = $(this).data('ga-event').split('|');
                args.unshift('event');
                args.unshift('send');
                ga.apply(this, args);
              });
              $('[data-ga-pageview]').click(function(e) {
                var path = $(this).data('ga-pageview');
                ga('send', 'pageview', path);
              });
            });
        </script>
        <iframe src="javascript:false" title="" style="display: none;" src="{{ URL::asset('Frontend/styleCss/saved_resource.html')}}"></iframe>
        <script type="text/javascript">/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("//assets.zendesk.com/embeddable_framework/main.js","qrates.zendesk.com");/*]]>*/
            zE(function() {
              zE.setLocale('en');
            });
        </script>
        <style media="print" class="jx_ui_StyleSheet" __jx__id="___$_2" type="text/css">.zopim { display: none !important }</style>
    </head>
    <body class="locale_en " cz-shortcut-listen="true">
        <div class="zopim" __jx__id="___$_60 ___$_60" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; padding: 0px; border: 0px; background: transparent; overflow: hidden; position: fixed; z-index: 16000002; width: 180px; height: 30px; right: 10px; bottom: 0px; display: none;">
            <iframe frameborder="0" src="{{URL('/')}}/Frontend/styleCss/saved_resource(1).html" style="background-color: transparent; vertical-align: text-bottom; position: relative; width: 100%; height: 100%; min-width: 100%; min-height: 100%; max-width: 100%; max-height: 100%; margin: 0px; overflow: hidden; display: block;"></iframe>
        </div>
        <div class="zopim" __jx__id="___$_4 ___$_4" style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; padding: 0px; border: 0px; background: transparent; overflow: hidden; position: fixed; z-index: 16000001; right: 15px; bottom: 0px; border-top-left-radius: 5px; border-top-right-radius: 5px; display: none; width: 350px; height: 450px; box-shadow: rgba(0, 0, 0, 0.0980392) 0px 0px 3px 2px;">
            <iframe frameborder="0" src="{{URL('/')}}/Frontend/styleCss/saved_resource(2).html" style="background-color: transparent; vertical-align: text-bottom; position: relative; width: 100%; height: 100%; min-width: 100%; min-height: 100%; max-width: 100%; max-height: 100%; margin: 0px; overflow: hidden; display: block;"></iframe>
        </div>
        <div id="container">
            <header class="header_wrap">
                @include('Frontend.layout.header')
                
            </header>
            <p class="alert"></p>
            <div class="user_toppage_index">
             
                @yield('content')
            </div>
            <footer class="footer_wrap" id="footer">
                @include('Frontend.layout.footer')
            </footer>
        </div>
        <div id="cboxOverlay" style="display: none;"></div>
        <div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;">
            <div id="cboxWrapper">
                <div>
                    <div id="cboxTopLeft" style="float: left;"></div>
                    <div id="cboxTopCenter" style="float: left;"></div>
                    <div id="cboxTopRight" style="float: left;"></div>
                </div>
                <div style="clear: left;">
                    <div id="cboxMiddleLeft" style="float: left;"></div>
                    <div id="cboxContent" style="float: left;">
                        <div id="cboxTitle" style="float: left;"></div>
                        <div id="cboxCurrent" style="float: left;"></div>
                        <button type="button" id="cboxPrevious"></button>
                        <button type="button" id="cboxNext"></button>
                        <button id="cboxSlideshow"></button>
                        <div id="cboxLoadingOverlay" style="float: left;"></div>
                        <div id="cboxLoadingGraphic" style="float: left;"></div>
                    </div>
                    <div id="cboxMiddleRight" style="float: left;"></div>
                </div>
                <div style="clear: left;">
                    <div id="cboxBottomLeft" style="float: left;"></div>
                    <div id="cboxBottomCenter" style="float: left;"></div>
                    <div id="cboxBottomRight" style="float: left;"></div>
                </div>
            </div>
            <div style="position: absolute; width: 9999px; visibility: hidden; display: none; max-width: none;"></div>
        </div>
        <div>
            <iframe style="border: none; background: transparent; z-index: 999998; transform: translateZ(0px); position: absolute; bottom: auto; opacity: 1; right: 0px; width: 374px; height: 416px; top: -9999px; left: -9999px;" id="ticketSubmissionForm" class="zEWidget-ticketSubmissionForm" data-ze-reactid=".0" src="{{URL('/')}}/Frontend/styleCss/saved_resource(3).html"></iframe>
        </div>
        <div>
            <iframe style="border: none; background: transparent; z-index: 999998; transform: translateZ(0px); position: fixed; bottom: 0px; opacity: 1; right: 0px; width: 140px; height: 48px; margin-left: 20px; margin-right: 20px; margin-bottom: 10px;" id="launcher" class="zEWidget-launcher zEWidget-launcher--active" data-ze-reactid=".2" src="{{URL('/')}}/Frontend/styleCss/saved_resource(4).html">
            </iframe>
        </div>
        <div>
            <iframe style="border: none; background: transparent; z-index: 2147483647; transform: translateZ(0px); position: absolute; bottom: auto; opacity: 1; right: 0px; left: -9999px; margin-left: -310px; width: 652px; height: 193px; top: -9999px;" id="nps" class="zEWidget-nps" data-ze-reactid=".4" src="{{URL('/')}}/Frontend/styleCss/saved_resource(5).html"></iframe>
        </div>
        <div><iframe style="border: none; background: transparent; z-index: 2147483647; transform: translateZ(0px); position: absolute; bottom: auto; opacity: 1; right: 0px; top: -9999px; height: 190px; width: 412px; left: -9999px;" id="ipm" class="zEWidget-ipm" data-ze-reactid=".6" src="{{URL('/')}}/Frontend/styleCss/saved_resource(6).html">
            </iframe>
        </div>
    </body>
</html>