<!--[Header]-->

<div class="box-header" style="z-index:99;">
   
        <!-- <div class="box-icon-sub-moon">
            <i class="fa-solid fa-sun"></i>
            <i class="fa-solid fa-moon"></i>
        </div>
   -->
    <div class="container-fluid" >
        <div class="box-language">
            <div class="dropdown ml-5 mt-4">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- @lang('translate.language') -->
                    <img style="width: 40px;height:40px;border-radius: 50%; margin-top: -5px;object-fit: cover;" src="/profile/{{ $userLogin->profile }}" alt="">
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('store_RegisterEdit',$userLogin->id) }} "><i class="fa-solid fa-user" style="color: #000000;"></i> Edit Profile</a>
                    <a class="dropdown-item" href="{{ route('logout',$userLogin->id) }}"><i class="fa-solid fa-right-from-bracket" style="color: #000000;"></i> ចាកចេញ</a>
                </div>
            </div>
        </div>
    </div>
</div>

