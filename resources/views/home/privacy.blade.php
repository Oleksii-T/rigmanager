@extends('layouts.app')

@section('styles')
<style>
    #policyWraper {
        padding: 20px 40px;
        margin-bottom: 20px
    }
    h1.page-header {
        font-size: 200%;
        display: inline-block;
        border-bottom: 2px solid #FE9042;
        margin: 0;
    }
    div.p {
        margin: 40px 0px;
    }
    h2.ph {
        font-size: 150%;
        margin-bottom: 20px;
    }
    p.pb {
        font-size: 120%;
        margin-left: 30px;
        line-height: 1.4em;
        margin-bottom: 10px;
    }
    p.psb {
        font-size: 130%;
        margin-left: 60px;
        line-height: 1.4em;
        margin-bottom: 10px;
    }
    span.pn {
        color: #FE9042;
        font-size: inherit;
    }
</style>
@endsection

@section('content')
    <div id="policyWraper">
        <h1 class="page-header">{{__('ui.footerPrivacy')}}</h1>
        <div class="p">
            <h2 class="ph"><span class="pn">1</span> {{__('privacy.P1')}}</h2>
            <p class="pb"><span class="pn">1.1</span> {{__('privacy.P1.1')}}</p>
            <p class="pb"><span class="pn">1.2</span> {{__('privacy.P1.2')}}</p>
            <p class="pb"><span class="pn">1.3</span> {{__('privacy.P1.3')}}</p>
            <p class="pb"><span class="pn">1.4</span> {{__('privacy.P1.4')}}</p>
            <p class="pb"><span class="pn">1.5</span> {{__('privacy.P1.5')}}</p>
        </div>
        <div class="p">
            <h2 class="ph"><span class="pn">2</span> {{__('privacy.P2')}}</h2>
            <p class="pb"><span class="pn">2.1</span> {{__('privacy.P2.1')}}</p>
            <p class="pb"><span class="pn">2.2</span> {{__('privacy.P2.2')}}</p>
            <p class="pb"><span class="pn">2.3</span> {{__('privacy.P2.3')}}</p>
            <p class="pb"><span class="pn">2.4</span> {{__('privacy.P2.4')}}</p>
        </div>
        <div class="p">
            <h2 class="ph"><span class="pn">3</span> {{__('privacy.P3')}}</h2>
            <p class="pb"><span class="pn">3.1</span> {{__('privacy.P3.1')}}</p>
            <p class="pb"><span class="pn">3.2</span> {{__('privacy.P3.2')}}</p>
            <p class="pb"><span class="pn">3.3</span> {{__('privacy.P3.3')}}</p>
            <p class="pb"><span class="pn">3.4</span> {{__('privacy.P3.4')}}</p>
        </div>
        <div class="p">
            <h2 class="ph"><span class="pn">4</span> {{__('privacy.P4')}}</h2>
            <p class="pb"><span class="pn">4.1</span> {{__('privacy.P4.1')}}</p>
            <p class="psb"><span class="pn">4.1.1</span> {{__('privacy.P4.1.1')}}</p>
            <p class="psb"><span class="pn">4.1.2</span> {{__('privacy.P4.1.2')}}</p>
            <p class="psb"><span class="pn">4.1.3</span> {{__('privacy.P4.1.3')}}</p>
            <p class="psb"><span class="pn">4.1.4</span> {{__('privacy.P4.1.4')}}</p>
            <p class="psb"><span class="pn">4.1.5</span> {{__('privacy.P4.1.5')}}</p>
            <p class="psb"><span class="pn">4.1.6</span> {{__('privacy.P4.1.6')}}</p>
            <p class="pb"><span class="pn">4.2</span> {{__('privacy.P4.2')}}</p>
        </div>
        <div class="p">
            <h2 class="ph"><span class="pn">5</span> {{__('privacy.P5')}}</h2>
            <p class="pb"><span class="pn">5.1</span> {{__('privacy.P5.1')}}</p>
            <p class="pb"><span class="pn">5.2</span> {{__('privacy.P5.2')}}</p>
            <p class="pb"><span class="pn">5.3</span> {{__('privacy.P5.3')}}</p>
            <p class="pb"><span class="pn">5.4</span> {{__('privacy.P5.4')}}</p>
            <p class="pb"><span class="pn">5.5</span> {{__('privacy.P5.5')}}</p>
            <p class="pb"><span class="pn">5.6</span> {{__('privacy.P5.6')}}</p>
            <p class="pb"><span class="pn">5.7</span> {{__('privacy.P5.7')}}</p>
        </div>
        <div class="p">
            <h2 class="ph"><span class="pn">6</span> {{__('privacy.P6')}}</h2>
            <p class="pb"><span class="pn">6.1</span> {{__('privacy.P6.1')}}</p>
            <p class="pb"><span class="pn">6.2</span> {{__('privacy.P6.2')}}</p>
            <p class="pb"><span class="pn">6.3</span> {{__('privacy.P6.3')}}</p>
            <p class="psb"><span class="pn">6.3.1</span> {{__('privacy.P6.3.1')}}</p>
            <p class="psb"><span class="pn">6.3.2</span> {{__('privacy.P6.3.2')}}</p>
            <p class="psb"><span class="pn">6.3.3</span> {{__('privacy.P6.3.3')}}</p>
            <p class="psb"><span class="pn">6.3.4</span> {{__('privacy.P6.3.4')}}</p>
            <p class="psb"><span class="pn">6.3.5</span> {{__('privacy.P6.3.5')}}</p>
            <p class="psb"><span class="pn">6.3.6</span> {{__('privacy.P6.3.6')}}</p>
            <p class="psb"><span class="pn">6.3.7</span> {{__('privacy.P6.3.7')}}</p>
            <p class="psb"><span class="pn">6.3.8</span> {{__('privacy.P6.3.8')}}</p>
        </div>
        <div class="p">
            <h2 class="ph"><span class="pn">7</span> {{__('privacy.P7')}}</h2>
            <p class="pb"><span class="pn">7.1</span> {{__('privacy.P7.1')}}</p>
        </div>
        <div class="p">
            <h2 class="ph"><span class="pn">8</span> {{__('privacy.P8')}}</h2>
            <p class="pb"><span class="pn">8.1</span> {{__('privacy.P8.1')}}</p>
            <p class="pb"><span class="pn">8.2</span> {{__('privacy.P8.2')}}</p>
        </div>
    </div>
@endsection

@section('scripts')
@endsection