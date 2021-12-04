<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="/dashboard">
      <img src="https://www.its.ac.id/wp-content/uploads/2020/07/Logo-ITS-1-300x185.png" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">Survei Pelanggan ITS</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        @php
        $dashboard_active = '';
        @endphp

        @if ($active == "dashboard")
        @php
        $dashboard_active = 'active';
        @endphp
        @endif
        <a class="nav-link {{$dashboard_active}}" href="{{ route('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            @include('icons.box-3d')
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>


      <li class="nav-item">
        @php
        $forms_active = '';
        $forms_show = '';
        @endphp
        @if ($active == "survey-data")
        @php
        $forms_active = 'active';
        $forms_show = 'show';
        @endphp
        @endif
        <a class="nav-link {{$forms_active}}" data-bs-toggle="collapse" href="#dashboardsExamples" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
            @include('icons.shop')
          </div>
          <span class="nav-link-text ms-1">Pertanyaan</span>
        </a>
        <div class="collapse {{$forms_show}}" id="dashboardsExamples">
          <ul class="nav ms-4 ps-3">

            @php
            $survey_data_active = '';
            @endphp
            @if ($survey_data == "add")
            @php
            $survey_data_active = 'active';
            @endphp
            @endif
            <li class="nav-item {{$survey_data_active}}">
              <a class="nav-link {{$survey_data_active}}" href="{{ route('survey-data-form') }}">
                <span class="sidenav-mini-icon"> Ca </span>
                <span class="sidenav-normal"> Buat </span>
              </a>
            </li>

            @php
            $survey_data_active = '';
            @endphp
            @if ($survey_data == "all")
            @php
            $survey_data_active = 'active';
            @endphp
            @endif
            <li class="nav-item {{$survey_data_active}}">
              <a class="nav-link {{$survey_data_active}}" href="{{ route('survey-data') }}">
                <span class="sidenav-mini-icon"> Ca </span>
                <span class="sidenav-normal"> List </span>
              </a>
            </li>

          </ul>
        </div>
      </li>


      <li class="nav-item">
        @php
        $survey_result_active = '';
        @endphp

        @if ($active == "hasil-survey")
        @php
        $survey_result_active = 'active';
        @endphp
        @endif
        <a class="nav-link {{$survey_result_active}}" href="{{ route('survey-data-result') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            @include('icons.office')
          </div>
          <span class="nav-link-text ms-1">Hasil Survei</span>
        </a>
      </li>


    </ul>
  </div>
</aside>