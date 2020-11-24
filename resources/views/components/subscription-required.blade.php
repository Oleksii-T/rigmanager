<div class="modal hidden sub-req" id="subscription-required">
    <div class="modal-content sub-req">
        <div class="close-bar">
            <button>
                <img src="{{asset('icons/closeRedIcon.svg')}}" alt="">
            </button>
        </div>
        <div class="sub-alert-body">
            <p class="sub-alert-intro">{{__('ui.planRequired')}}:</p>
            <h3 class="sub-alert-role">{{$role}}</h3>
            <p class="sub-alert-details">{{__('ui.planDetails')}}</p>
            <a class="def-button sub-alert-btn" href="{{loc_url(route('plans'))}}">{{__('ui.planDetailsBtn')}}</a>
        </div>
    </div>
</div>