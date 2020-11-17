@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/import_rules.css') }}" />
@endsection

@section('content')
    <div id="import-rules-wraper">
        <div id="paragraphTitle">
            <h1>{{__('postImportRules.intro')}}</h1>
        </div>
        <div id="paragraphBody">
            <div class="main-rules">
                <h2 class="section-title">{{__('postImportRules.mainRulesTitle')}}</h2>
                <ul>
                    <li>{{__('postImportRules.mainRules1')}}</li>
                    <li>{{__('postImportRules.mainRules2')}}</li>
                    <li>{{__('postImportRules.mainRules3')}}</li>
                    <li>{{__('postImportRules.mainRules4')}}</li>
                    <li>{{__('postImportRules.mainRules5')}}</li>
                    <li>{{__('postImportRules.mainRules6')}}</li>
                    <li>{{__('postImportRules.mainRules7')}}</li>
                    <li>{{__('postImportRules.mainRules8')}}</li>
                </ul>
            </div>
            <div class="detailed-rules">
                <h2 class="section-title">{{__('postImportRules.detailedRules')}}</h2>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.title')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.titleRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.description')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.descRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.thread')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.threadRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.company')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.no')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.companyRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('postImportRules.type')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.typeRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.postRole')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.roleRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.condition')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.conditionRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('postImportRules.tag')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.tagRule')}}</p>
                    <button class="def-button open-modal-btn" id="tags-eq-list-show">{{__('postImportRules.tagRuleEqBtn')}}</button>
                    <button class="def-button open-modal-btn" id="tags-se-list-show">{{__('postImportRules.tagRuleSeBtn')}}</button>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('postImportRules.manufManufDatePN')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.no')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.manufManufDatePNRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.cost')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.no')}}</p>
                    <p class="field-rule-text">{{__('ui.costHelp')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('postImportRules.currency')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.no')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.currencyRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.region')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.no')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.regionRule')}}</p>
                    <button class="def-button open-modal-btn" id="regions-list-show">{{__('postImportRules.regionRuleBtn')}}</button>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.locationTown')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.no')}}</p>
                    <p class="field-rule-text">{{__('ui.town')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.email')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.emailRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('ui.phone')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.phoneRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('postImportRules.VTW')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.no')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.VTWRule')}}</p>
                </div>
                <div class="field-rule">
                    <h3 class="field-name">{{__('postImportRules.lifetime')}}</h3>
                    <p class="field-rule-text">{{__('postImportRules.required')}}: {{__('ui.yes')}}</p>
                    <p class="field-rule-text">{{__('postImportRules.lifetimeRule')}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal hidden" id="tags-eq-list">
        <div class="modal-content">
            <p>TODO</p>
        </div>
    </div>
    <div class="modal hidden" id="tags-se-list">
        <div class="modal-content">
            <p>TODO</p>
        </div>
    </div>
    <div class="modal hidden" id="regions-list">
        <div class="modal-content">
            <table class="regions-table">
                <thead>
                    <tr class="table-header-row">
                        <td class="table-header-item">Код области
                             для ввода</td>
                        <td class="table-header-item">Область</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row">
                        <td class="table-item region-code">0</td>
                        <td class="table-item">Не выбрано</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">1</td>
                        <td class="table-item">Автономная Республика Крым</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">2</td>
                        <td class="table-item">Винницкая область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">3</td>
                        <td class="table-item">Волынская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">4</td>
                        <td class="table-item">Днепропетровская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">5</td>
                        <td class="table-item">Донецкая область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">6</td>
                        <td class="table-item">Житомирская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">7</td>
                        <td class="table-item">Закарпатская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">8</td>
                        <td class="table-item">Запорожская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">9</td>
                        <td class="table-item">Ивано-Франковская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">10</td>
                        <td class="table-item">Киевская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">11</td>
                        <td class="table-item">Кировоградская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">12</td>
                        <td class="table-item">Луганская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">13</td>
                        <td class="table-item">Львовская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">14</td>
                        <td class="table-item">Николаевская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">15</td>
                        <td class="table-item">Одесская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">16</td>
                        <td class="table-item">Полтавская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">17</td>
                        <td class="table-item">Ровенская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">18</td>
                        <td class="table-item">Сумская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">19</td>
                        <td class="table-item">Тернопольская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">20</td>
                        <td class="table-item">Харьковская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">21</td>
                        <td class="table-item">Херсонская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">22</td>
                        <td class="table-item">Хмельницкая область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">23</td>
                        <td class="table-item">Черкасская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">25</td>
                        <td class="table-item">Черниговская область</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item region-code">24</td>
                        <td class="table-item">Черновицкая область</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tags-eq-list-show').click(function(){
                $('#tags-eq-list').removeClass('hidden');
            });

            $('#tags-se-list-show').click(function(){
                $('#tags-se-list').removeClass('hidden');
            });

            $('#regions-list-show').click(function(){
                $('#regions-list').removeClass('hidden');
            });

            //make any click beyong the modal to close modal
            window.onclick = function(event) {
                var regionsModal = document.getElementById("regions-list");
                var tagsEqModal = document.getElementById("tags-eq-list");
                var tagsSeModal = document.getElementById("tags-se-list");
                if (event.target == regionsModal) {
                    $('#regions-list').addClass('hidden');
                } else if (event.target == tagsEqModal) {
                    $('#tags-eq-list').addClass('hidden');
                } else if (event.target == tagsSeModal) {
                    $('#tags-se-list').addClass('hidden');
                }
            }
        });
    </script>
@endsection