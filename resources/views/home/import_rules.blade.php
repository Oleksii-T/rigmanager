@extends('layouts.page')

@section('meta')
    <title>{{__('meta.title.home')}}</title>
    <meta name="description" content="{{__('meta.description.home')}}">
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('bc')
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name">{{__('postImportRules.title')}}</span>
        <meta itemprop="position" content="2" />
    </li>
@endsection

@section('content')
    <div class="main-block">
        <x-informations-nav active='xlsx-info'/>

        <div class="content">
            <article class="article import-rules">
                <h1>{{__('postImportRules.title')}}</h1>
                <div class="content-top-text">{{__('postImportRules.intro')}} <a href="{{loc_url(route('post.import'))}}">{{__('postImportRules.introLink')}}</a> {{__('postImportRules.intro1')}}</div>
                <div class="rule">
                    <div class="rule-icon"><img src="{{asset('icons/xlsx.svg')}}" alt=""></div>
                    <div class="rule-content">
                        <h3>{{__('postImportRules.mainRulesTitle')}}</h3>
                        <ul>
                            <li>{{__('postImportRules.mainRules1')}}</li>
                            <li>{{__('postImportRules.mainRules2')}}</li>
                            <li>{{__('postImportRules.mainRules3')}}</li>
                            <li>{{__('postImportRules.mainRules4')}}</li>
                            <li>{{__('postImportRules.mainRules5')}}</li>
                            <li>{{__('postImportRules.mainRules6')}}</li>
                            <li>{{__('postImportRules.mainRules7')}}</li>
                            <li>{{__('postImportRules.mainRules8')}}</li>
                            <li>{{__('postImportRules.mainRules9')}}</li>
                            <li>{{__('postImportRules.mainRules10')}}</li>
                            <li>{{__('postImportRules.mainRules11')}}</li>
                        </ul>
                    </div>
                </div>
                <div class="article-part"> <!--title-->
                    <h3>{{__('ui.title')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.titleRule')}}</p>
                </div>
                <div class="article-part"> <!--description-->
                    <h3>{{__('ui.description')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.titleRule')}}</p>
                </div>
                <div class="article-part"> <!--amount-->
                    <h3>{{__('ui.amount')}}</h3>
                    <p><span class="yellow">{{__('postImportRules.required')}}: {{__('ui.no')}}</span>
                        {{__('ui.amountHelp')}}</p>
                </div>
                <div class="article-part"> <!--company-->
                    <h3>{{__('ui.company')}}</h3>
                    <p><span class="yellow">{{__('postImportRules.required')}}: {{__('ui.no')}}</span>
                        {{__('postImportRules.companyRule')}}</p> 
                </div>
                <div class="article-part"> <!--type-->
                    <h3>{{__('postImportRules.type')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.typeRule')}}</p> 
                </div>
                <div class="article-part"> <!--role-->
                    <h3>{{__('ui.postRole')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.roleRule')}}</p>
                </div>
                <div class="article-part"> <!--condition-->
                    <h3>{{__('ui.condition')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.conditionRule')}}</p> 
                </div>
                <div class="article-part"> <!--tag-->
                    <h3>{{__('postImportRules.tag')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.tagRule')}}</p>
                    <div class="article-buttons">
                        <a href="#popup-eq-tags" data-fancybox class="button button-blue">{{__('postImportRules.tagRuleEqBtn')}}</a>
                        <a href="#popup-se-tags" data-fancybox class="button button-blue">{{__('postImportRules.tagRuleSeBtn')}}</a>
                    </div>
                </div>
                <div class="article-part"> <!--manuf+manuf_date+pn-->
                    <h3>{{__('postImportRules.manufManufDatePN')}}</h3>
                    <p><span class="yellow">{{__('postImportRules.required')}}: {{__('ui.no')}}</span>
                        {{__('postImportRules.manufManufDatePNRule')}}</p>
                </div>
                <div class="article-part"> <!--cost-->
                    <h3>{{__('postImportRules.cost')}}</h3>
                    <p><span class="yellow">{{__('postImportRules.required')}}: {{__('ui.no')}}</span>
                        {{__('ui.costHelp')}}
                        {{__('postImportRules.currencyRule')}}</p> 
                </div>
                <div class="article-part"> <!--region-->
                    <h3>{{__('ui.region')}}</h3>
                    <p><span class="yellow">{{__('postImportRules.required')}}: {{__('ui.no')}}</span>
                        {{__('postImportRules.regionRule')}}</p>
                    <div class="article-buttons">
                        <a href="#popup-regions" data-fancybox class="button button-blue">{{__('postImportRules.regionRuleBtn')}}</a>
                    </div>
                </div>
                <div class="article-part"> <!--email-->
                    <h3>{{__('ui.email')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.emailRule')}}</p>
                </div>
                <div class="article-part"> <!--phone-->
                    <h3>{{__('ui.phone')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.phoneRule')}}</p> 
                </div>
                <div class="article-part"> <!--import-->
                    <h3>{{__('ui.importExport')}}</h3>
                    <p><span class="yellow">{{__('postImportRules.required')}}: {{__('ui.no')}}</span>
                        {{__('postImportRules.importRule')}}</p> 
                </div>
                <div class="article-part"> <!--lifetime-->
                    <h3>{{__('postImportRules.lifetime')}}</h3>
                    <p><span class="white">{{__('postImportRules.required')}}: {{__('ui.yes')}}</span>
                        {{__('postImportRules.lifetimeRule')}}</p> 
                </div>
            </article>
        </div>
    </div>
@endsection

@section('modals')
    <div id="popup-regions" class="popup">
        <div class="popup-title">{{__('postImportRules.regionsList')}}</div>
        <div class="code">
            <div class="code-item">
                <div class="code-num">0</div>
                <div class="code-text">{{__('ui.notSpecified')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">1</div>
                <div class="code-text">{{__('ui.regionCrimea')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">2</div>
                <div class="code-text">{{__('ui.regionVinnytsia')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">3</div>
                <div class="code-text">{{__('ui.regionVolyn')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">4</div>
                <div class="code-text">{{__('ui.regionDnipropetrovsk')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">5</div>
                <div class="code-text">{{__('ui.regionDonetsk')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">6</div>
                <div class="code-text">{{__('ui.regionZhytomyr')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">7</div>
                <div class="code-text">{{__('ui.regionCarpathian')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">8</div>
                <div class="code-text">{{__('ui.regionZaporozhye')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">9</div>
                <div class="code-text">{{__('ui.regionIvano-Frankivsk')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">10</div>
                <div class="code-text">{{__('ui.regionKiev')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">11</div>
                <div class="code-text">{{__('ui.regionKirovograd')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">12</div>
                <div class="code-text">{{__('ui.regionLuhansk')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">13</div>
                <div class="code-text">{{__('ui.regionLviv')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">14</div>
                <div class="code-text">{{__('ui.regionMykolaiv')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">15</div>
                <div class="code-text">{{__('ui.regionOdessa')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">16</div>
                <div class="code-text">{{__('ui.regionPoltava')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">17</div>
                <div class="code-text">{{__('ui.regionRivne')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">18</div>
                <div class="code-text">{{__('ui.regionSumy')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">19</div>
                <div class="code-text">{{__('ui.regionTernopil')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">20</div>
                <div class="code-text">{{__('ui.regionKharkiv')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">21</div>
                <div class="code-text">{{__('ui.regionKherson')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">22</div>
                <div class="code-text">{{__('ui.regionKhmelnytsky')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">23</div>
                <div class="code-text">{{__('ui.regionCherkasy')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">24</div>
                <div class="code-text">{{__('ui.regionChernivtsi')}}</div>
            </div>
            <div class="code-item">
                <div class="code-num">25</div>
                <div class="code-text">{{__('ui.regionChernihiv')}}</div>
            </div>
        </div>
    </div>
    <div id="popup-eq-tags" class="popup">
        <div class="popup-title">{{__('postImportRules.tagsEqList')}}</div>
        <p>{{__('ui.tagsCodesNotReady')}}</p>
        <div class="code">
            <div class="code-item">
                <div class="code-num">0</div>
                <div class="code-text">{{__('ui.notSpecified')}}</div>
            </div>
        </div>
    </div>
    <div id="popup-se-tags" class="popup">
        <div class="popup-title">{{__('postImportRules.tagsSeList')}}</div>
        <p>{{__('ui.tagsCodesNotReady')}}</p>
        <div class="code">
            <div class="code-item">
                <div class="code-num">0</div>
                <div class="code-text">{{__('ui.notSpecified')}}</div>
            </div>
        </div>
    </div>
@endsection