
<div class="card bg-transparent">

    <div class="card-body text-center">
        <img src="{{  Auth::guard('mobile-user')->user()->avatar}}"
            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
        <div class=" mt-3 text-center">
            <h4 class="text-white mb-2"><strong>नाम :</strong> <span
                    class="ms-2">{{ Auth::guard('mobile-user')->user()->name }}</span>
            </h4>
            <h5 class="text-white mb-2"><strong>इमेल :</strong><span
                    class="ms-2">{{ Auth::guard('mobile-user')->user()->email }}</span></h5>
            <h5 class="text-white mb-2"><strong>फोन :</strong> <span
                    class="ms-2">{{ Auth::guard('mobile-user')->user()->phone }}</span></h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-primary mt-4 d-block w-100 py-2" href="{{ route('mobileUser.editProfile') }}"> प्रोफाइल अपडेट</a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary mt-4 d-block w-100 py-2" href="{{ route('mobileUser.editPassword') }}"> पासवर्ड अपडेट</a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-danger mt-4 d-block w-100 py-2" style="margin-left: 95px;" href="{{ route('mobileUser.logout') }}"> लग-आउट</a>
            </div>
        </div>
    </div>
</div>
