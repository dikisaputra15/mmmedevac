@extends('layouts.master')

@section('title','Detail Clinic')
@section('page-title', 'Papua New Guinea Medical Facility')

@push('styles')

<style>
     .btn-danger{
        background-color:#395272;
        border-color: transparent;
    }

      .btn-danger:hover{
        background-color:#5686c3;
        border-color: transparent;
    }

    .btn.active {
        background-color: #5686c3 !important;
        border-color: transparent !important;
        color: #fff !important;
    }

    .p-3{
        padding: 10px !important;
        margin: 0 3px;
    }

    .btn-outline-danger{
        color: #FFFFFF;
        background-color:#395272;
        border-color: transparent;
    }

    .btn-outline-danger:hover{
        background-color:#5686c3;
        border-color: transparent;
    }

    .fa,
    .fab,
    .fad,
    .fal,
    .far,
    .fas {
        color: #346abb;
    }

    .clinical-service-table{

    }

    .clinical-service-table td{
        padding: 6px 0;
        border-bottom: 1px solid #dee2e6;
        border-top:none;
        line-height: 18px;
    }

    .card-header{
        padding: 0.25rem 1.25rem;
        color: #3c66b5;
        font-weight: bold;
    }

    .mb-4{
        margin-bottom: 0.5rem !important;
    }

    .clinical-service-table td{
        padding: 6px;
    }

    /* Classification */
    .classification {
      display: flex;
      width: 100%;
    }

    .class-column {
      flex: 1;
      text-align: center;

    }
    .class-column:last-child {
      border-right: none;
    }

    .class-header {
      font-weight: 600;
      padding: 0.1rem 0;
    }

    /* Color bars */
    .class-medical-classification {border: none; text-align: center;}
    .class-airport-category {border: none;}
    .class-advanced { border-bottom: 3px solid #0070c0; }
    .class-intermediate { border-bottom: 3px solid #00b050; }
    .class-basic { border-bottom: 3px solid #ffc000; }

    /* Hospital layout */
    .hospital-list {
      display: flex;
      flex-direction: column;
      align-items: center;

    }

    /* For side-by-side classes */
    .hospital-row {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0;
    }

    .hospital-item {
      display: flex;
      align-items: center;
      gap: 0;
      font-size: 0.9rem;
      white-space: nowrap;
    }

    .hospital-icon {
      width: 18px;
      height: 18px;
      border-radius: 3px;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    /* Image inside icon box */
    .hospital-icon img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    /* Airfield icons */
    .category-item img {
      width: 16px;
      height: 16px;
      object-fit: contain;
    }
</style>

@endpush

@section('conten')

<div class="card">

     <div class="d-flex justify-content-between p-3" style="background-color: #dfeaf1;">
        <div class="d-flex flex-column gap-1">
            <h2 class="fw-bold mb-0">{{ $hospital->name }}</h2>
            <span class="fw-bold"><b>Global Classification:</b> {{ $hospital->facility_category }} | <b>Country Classification:</b> {{ $hospital->facility_level }}</span>
        </div>

        <div class="d-flex gap-2 ms-auto">
            <!-- Button 2 -->
            <a href="{{ url('hospitals') }}/{{$hospital->id}}" class="btn btn-outline-danger d-flex flex-column align-items-center p-3 {{ request()->is('hospitals/'.$hospital->id) ? 'active' : '' }}">
                <img src="{{ asset('images/icon-menu-general-info.png') }}" style="width: 18px; height: 24px;">
                <small>General</small>
            </a>

            <!-- Button 3 -->
            <a href="{{ url('hospitals/clinic') }}/{{$hospital->id}}" class="btn btn-outline-danger d-flex flex-column align-items-center p-3 {{ request()->is('hospitals/clinic/'.$hospital->id) ? 'active' : '' }}">
                <img src="{{ asset('images/icon-menu-medical-facility-white.png') }}" style="width: 18px; height: 24px;">
                <small>Clinical</small>
            </a>

            <!-- Button 4 -->
            <a href="{{ url('hospitals/emergency') }}/{{$hospital->id}}" class="btn btn-outline-danger d-flex flex-column align-items-center p-3 {{ request()->is('hospitals/emergency/'.$hospital->id) ? 'active' : '' }}">
                <img src="{{ asset('images/icon-emergency-support-white.png') }}" style="width: 24px; height: 24px;">
                <small>Emergency</small>
            </a>

            <a href="{{ url('hospital') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('hospital') ? 'active' : '' }}">
                 <img src="{{ asset('images/icon-medical.png') }}" style="width: 24px; height: 24px;">
                <small>Medical</small>
            </a>
            <!-- Button 5 -->
            <a href="{{ url('airports') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('airports') ? 'active' : '' }}">
                <i class="bi bi-airplane fs-3"></i>
                <small>Airports</small>
            </a>

            <a href="{{ url('aircharter') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('aircharter') ? 'active' : '' }}">
                 <img src="{{ asset('images/icon-air-charter.png') }}" style="width: 48px; height: 24px;">
                <small>Air Charter</small>
            </a>

            <a href="{{ url('police') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('police') ? 'active' : '' }}">
                <i class="bi bi-person-badge" style="width: 24px; height: 24px;"></i>
                <small>Police</small>
            </a>

            <!-- Button 7 -->
            <a href="{{ url('embassiees') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('embassiees') ? 'active' : '' }}">
            <img src="{{ asset('images/icon-embassy.png') }}" style="width: 24px; height: 24px;">
                <small>Embassies</small>
            </a>
        </div>
    </div>

     <div class="card mb-4 position-relative">
        <div class="card-body" style="padding:0 7px;">
            <small><i>Last Updated {{ $hospital->created_at->format('M Y') }}</i></small>

            @role('admin')
            <a href="{{ route('hospitaldata.edit', $hospital->id) }}"
            style="position:absolute; right:7px;" title="edit">
                <i class="fas fa-edit"></i>
            </a>
            @endrole
        </div>
    </div>

<div class="row">
    <div class="col-sm-5">
        <div class="card">

            <div style="flex-direction: column;">
                        <!-- Title -->
                        <div>
                            <div class="class-header class-medical-classification">Medical Facility Classification</div>
                        </div>
                        <div style="display: flex; flex-direction: row;">
                            <!-- Advanced -->
                            <div class="class-column">
                              <div class="class-header class-advanced">&nbsp</div>
                              <div class="hospital-list">
                                <div class="hospital-item">
                                  <button class="btn p-1">
                                    Public
                                  </button>
                                </div>
                                <div class="hospital-item">
                                    <button class="btn p-1">
                                      Private
                                    </button>
                                  </div>
                              </div>
                            </div>

                             <!-- Advanced -->
                            <div class="class-column">
                              <div class="class-header class-advanced">Advanced</div>
                              <div class="hospital-list">
                                <div class="hospital-item">
                                  <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level66Modal">
                                    <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital-pin-red.png" style="width:24px; height:24px;">
                                    <small>Tertiary</small>
                                  </button>
                                </div>
                                <div class="hospital-item">
                                    <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level55Modal">
                                      <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-blue.png" style="width:24px; height:24px;">
                                      <small>Large Private</small>
                                    </button>
                                  </div>
                              </div>
                            </div>

                            <!-- Intermediate -->
                            <div class="class-column">
                              <div class="class-header class-intermediate">Intermediate</div>
                              <div class="hospital-list">
                                  <div class="hospital-item">
                                    <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level44Modal">
                                      <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-purple.png" style="width:24px; height:24px;">
                                      <small>Secondary</small>
                                    </button>
                                  </div>
                                  <div class="hospital-item">
                                    <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level33Modal">
                                      <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-green.png" style="width:24px; height:24px;">
                                      <small>Medium Private</small>
                                    </button>
                                  </div>
                              </div>
                            </div>

                            <!-- Basic -->
                            <div class="class-column">
                              <div class="class-header class-basic">Basic</div>
                              <div class="hospital-list">
                                  <div class="hospital-item">
                                    <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level22Modal">
                                        <img src="https://id.concordreview.com/wp-content/uploads/2026/02/hospital_pin-orange.png" style="width:24px; height:24px;">
                                        <small>Primary</small>
                                    </button>
                                  </div>
                                   <div class="hospital-item">
                                    <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level11Modal">
                                        <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-tosca.png" style="width:24px; height:24px;">
                                        <small>Small Private</small>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

        </div>
    </div>
</div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header fw-bold"><img src="{{ asset('images/icon-menu-medical-facility.png') }}" style="width: 24px; height: 24px;"> Clinical Services</div>
              <div class="card-body overflow-auto">
                <div class="row">
                <div class="col-sm-6">
                    <table class="table table-hover clinical-service-table">
                        <tr>
                            <td>Inpatient</td>
                            <td>{{ $hospital->inpatient_services }}</td>
                        </tr>
                        <tr>
                            <td>Outpatient</td>
                            <td>{{ $hospital->outpatient_services }}</td>
                        </tr>
                        <tr>
                            <td>24 hr ER</td>
                            <td>{{ $hospital->hour_emergency_services }}</td>
                        </tr>
                        <tr>
                            <td>Ambulance</td>
                            <td>{{ $hospital->ambulance }}</td>
                        </tr>
                        <tr>
                            <td>Helipad</td>
                            <td>{{ $hospital->helipad }}</td>
                        </tr>

                        @if (!empty($hospital->comments))
                        <tr>
                            <td>Note</td>
                            <td>{{ $hospital->comments }}</td>
                        </tr>
                        @endif

                        <tr>
                            <td>ICU</td>
                            <td>{{ $hospital->icu }}</td>
                        </tr>
                        <tr>
                            <td>Medical</td>
                            <td>{{ $hospital->medical }}</td>
                        </tr>
                        <tr>
                            <td>Pediatric</td>
                            <td>{{ $hospital->pediatric }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table table-hover clinical-service-table">
                        <tr>
                            <td>Maternal</td>
                            <td>{{ $hospital->maternal }}</td>
                        </tr>
                        <tr>
                            <td>Dental</td>
                            <td>{{ $hospital->dental }}</td>
                        </tr>
                        <tr>
                            <td>Optical</td>
                            <td>{{ $hospital->optical }}</td>
                        </tr>
                        <tr>
                            <td>Integrated Outreach Clinic (IOC)</td>
                            <td>{{ $hospital->ioc }}</td>
                        </tr>
                        <tr>
                            <td>Laboratory</td>
                            <td>{{ $hospital->laboratory }}</td>
                        </tr>
                        <tr>
                            <td>Pharmacy</td>
                            <td>{{ $hospital->pharmacy }}</td>
                        </tr>
                        <tr>
                            <td>Medical Imaging</td>
                            <td>{{ $hospital->medical_imaging }}</td>
                        </tr>
                        <tr>
                            <td>Medical Student Training</td>
                            <td>{{ $hospital->medical_student_training }}</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                  <div class="card-header fw-bold"><img src="{{ asset('images/icon-medical-personel.png') }}" style="width: 32px; height: 24px;"> Medical Personnel</div>
             <div class="card-body overflow-auto">
                 <div class="row">
                <div class="col-sm-6">
                <table class="table table-hover clinical-service-table">
                    <tr>
                        <td>Doctors</td>
                        <td>{{ $hospital->doctors }}</td>
                    </tr>
                    <tr>
                        <td>Nurses</td>
                        <td>{{ $hospital->nurses }}</td>
                    </tr>
                    <tr>
                        <td>Dental Therapist</td>
                        <td>{{ $hospital->dental_therapist }}</td>
                    </tr>
                    <tr>
                        <td>Laboratory Assistants</td>
                        <td>{{ $hospital->laboratory_assistants }}</td>
                    </tr>
                    <tr>
                        <td>Community Health Workers/Orderlies</td>
                        <td>{{ $hospital->community_health }}</td>
                    </tr>
                </table>
                </div>
                <div class="col-sm-6">
                <table class="table table-hover clinical-service-table">
                    <tr>
                        <td>Health Inspectors</td>
                        <td>{{ $hospital->health_inspectors }}</td>
                    </tr>
                    <tr>
                        <td>Malaria Control Officers</td>
                        <td>{{ $hospital->malaria_control_officers ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Health Extension Officers</td>
                        <td>{{ $hospital->health_extention_officers }}</td>
                    </tr>
                    <tr>
                        <td>Casuals</td>
                        <td>{{ $hospital->casuals }}</td>
                    </tr>
                </table>
                </div>
                </div>
            </div>
            </div>

             <div class="card">
                <div class="card-body overflow-auto">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>{!! $hospital->medical_personel_disclaimer; !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="level11Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
         <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-tosca.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">SMALL PRIVATE HOSPITAL</h5>
         </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Small Private Hospital is a low-capacity facility offering basic inpatient and outpatient services, often functioning similarly to an expanded clinic. It primarily supports primary-level care.
            </p>
            <p class="text-justify">
                <b><u>Note:</u></b> Unlike public hospitals, private hospitals in Myanmar are not formally classified into tiers by the government. Instead, they are regulated under licensing frameworks and industry standards (e.g., <a href="https://www.mphamyanmar.org/" target="_blank"> Myanmar Private Hospitals’ Association</a>), while their functional classification is analytically derived based on bed capacity, clinical capability, diagnostic infrastructure, and specialist availability.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Provide basic medical care and minor procedures</li>
                    <li>Serve local community healthcare needs</li>
                    <li>Refer most moderate and complex cases to higher-level hospitals</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, typically <50 beds</li>
                    <li>
                        <strong>Core Services</strong>
                        <ul>
                            <li>General practice / basic internal medicine</li>
                            <li>Minor surgical procedures</li>
                            <li>Basic maternal and child health services</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Limitations</strong>
                        <ul>
                            <li>No advanced specialist services</li>
	                        <li>No complex surgical capability</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Basic laboratory services (comparable to Type C) <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                            <li>Basic imaging (limited or none)</li>
                            <li>No advanced diagnostics</li>
                        </ul>
                    </li>
                </ul>
            </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level22Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
         <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-orange.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">PRIMARY HOSPITAL</h5>
         </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <h5 class="fw-bold" style="color:#3c8dbc;">
                District Hospital (Primary)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Primary-Level District Hospital refers to smaller or less-developed district hospitals that is closer to township-level capability, providing basic hospital services.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Provide first-line hospital care</li>
                    <li>Manage common medical conditions</li>
                    <li>Refer patients to secondary hospitals</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately 50–100 beds</li>
                    <li>
                        <strong>Basic Services</strong>
                        <ul>
                            <li>General medicine</li>
                            <li>Minor surgery</li>
                            <li>Maternal and child health</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Type C Basic laboratory services <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                        </ul>
                    </li>
                </ul>
            </p>
            <p class="text-justify">
                <b><U>Note:</u></b> A District Hospital is classified as Primary when it has limited capability, minimal specialist services, and functions similarly to a large township hospital.
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                Township Hospital (Primary)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Township Hospital is the main primary-level hospital, and is the first referral level within the public health system.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Provide primary hospital care</li>
                    <li>Manage common and moderate conditions</li>
                    <li>Refer patients to district and state hospitals</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately 25–100 beds</li>
                    <li>
                        <strong>Core Services</strong>
                        <ul>
                            <li>General medicine</li>
                            <li>Basic surgery</li>
                            <li>Obstetrics & Gynecology</li>
                            <li>Pediatrics</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Basic laboratory (Type C) <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                            <li>Basic imaging (X-ray in some facilities) </li>
                        </ul>
                    </li>
                </ul>
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                Station Hospital (Primary)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Station Hospital is the lowest-level hospital facility, typically located in rural or remote areas, providing essential healthcare services.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Serve as first contact healthcare facility</li>
                    <li>Provide basic medical services</li>
                    <li>Refer patients to township hospitals</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately 16–25 beds</li>
                    <li>
                        <strong>Basic Services</strong>
                        <ul>
                            <li>Outpatient and limited inpatient care</li>
                            <li>Maternal and child health</li>
                            <li>Basic treatment and stabilization</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Basic laboratory testing <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                            <li>Minimal diagnostic capability  </li>
                        </ul>
                    </li>
                </ul>
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                MYANMAR GOVERNMENT HEALTH INSURANCE
            </h5>
            <p class="text-justify">
                Myanmar does not maintain a comprehensive national health insurance system administered by the government. Healthcare coverage remains limited in scope and is not universally accessible. The closest equivalent is the Social Security Scheme (SSS) of Myanmar, which provides the following cover:
                <ul>
                    <li>Restricted primarily to formal sector workers</li>
                    <li>Covers only a limited proportion of the population</li>
                    <li>Provides a constrained range of benefits and healthcare services</li>
                </ul>
                As a result, a significant proportion of the population in Myanmar continues to rely on direct payments made by individuals to healthcare providers at the time of service, without reimbursement from insurance or government programs.
            </p>
            <h6 class="fw-bold">
                <b>Social Security Scheme (SSS) Myanmar</b>
            </h6>
            <p class="text-justify">
                SSS is a government-administered insurance program that provides health, social, and financial protection to formal-sector employees. It is managed by the Social Security Board (SSB) under the Ministry of Labour, Immigration and Population and constitutes the country’s principal contributory social protection mechanism for workers.
            </p>
            <h6 class="fw-bold">
                <b>Key facts:</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li><b>Established:</b> 1954 (restructured under the 2012 Social Security Law)</li>
                    <li><b>Administering authority:</b> Social Security Board (SSB)</li>
                    <li><b>Coverage:</b> Employees in public and private sector establishments registered under the scheme</li>
                    <li><b>Financing:</b> Payroll-based contributions from employers and employees</li>
                    <li><b>Core benefits: </b> Healthcare services, maternity benefits, sickness allowances, disability benefits, and survivors’ benefits</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Legal and institutional background</b>
            </h6>
            <p class="text-justify">
                The scheme was originally established under the Social Security Act of 1954 and subsequently reformed through the 2012 Social Security Law, which aimed to broaden coverage and enhance benefit provisions. The Social Security Board, operating under the Ministry of Labor, Immigration and Population, is responsible for member registration, contribution collection, and benefit administration. It also oversees a network of regional offices and dedicated healthcare facilities serving insured members.
            </p>
            <h6 class="fw-bold">
                <b>Coverage and benefits</b>
            </h6>
            <p class="text-justify">
                SSS applies to employees of registered enterprises employing five or more workers. Contribution rates are generally set at 5% of wages, with 3% contributed by employers and 2% by employees. Covered individuals are entitled to a range of benefits, including medical care, maternity allowances, cash sickness benefits, disability pensions, and funeral grants. Healthcare services are delivered through designated SSB hospitals and clinics, particularly in major urban centers including Yangon and Mandalay.
            </p>
            <h6 class="fw-bold">
                <b>Implementation and challenges</b>
            </h6>
            <p class="text-justify">
                Coverage remains limited to the formal sector, leaving most informal workers outside the scheme. Administrative capacity, awareness, and compliance enforcement have been ongoing challenges. Expansion efforts, including digital registration and pilot programs for informal workers, are gradually extend the protection to a broader labor force.
            </p>
            <h6 class="fw-bold">
                <b>Current role</b>
            </h6>
            <p class="text-justify">
                The Social Security Scheme is Myanmar’s primary state-backed mechanism for worker welfare and risk protection, aligning with national objectives for inclusive social protection and labor rights compliance within the country’s evolving economic framework.
            </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level33Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
         <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-green.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">MEDIUM PRIVATE HOSPITAL</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Medium Private Hospital is a moderate-capacity facility providing general and selected specialist services. It primarily supports secondary-level care, managing common and moderately complex conditions.
            </p>
            <p class="text-justify">
                <b><u>Note:</u></b> Unlike public hospitals, private hospitals in Myanmar are not formally classified into tiers by the government. Instead, they are regulated under licensing frameworks and industry standards (e.g., <a href="https://www.mphamyanmar.org/" target="_blank">Myanmar Private Hospitals’ Association</a>), while their functional classification is analytically derived based on bed capacity, clinical capability, diagnostic infrastructure, and specialist availability.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Provide general inpatient and outpatient care</li>
                    <li>Manage routine and moderate-complexity medical and surgical cases</li>
                    <li>Refer complex cases to larger private or public hospitals</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, typically 50–150 beds</li>
                    <li>
                        <strong>Core Specialties</strong>
                        <ul>
                            <li>Internal Medicine</li>
                            <li>General Surgery</li>
                            <li>Obstetrics & Gynecology</li>
                            <li>Pediatrics</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Available Services </strong>
                        <ul>
                            <li>Basic ICU or high-dependency units (limited)</li>
                            <li>Basic surgical procedures</li>
                            <li>Routine emergency care</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Laboratory services (comparable to Type B) <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                            <li>Basic imaging (X-ray, ultrasound)</li>
                            <li>Limited advanced diagnostics</li>
                        </ul>
                    </li>
                </ul>
            </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level44Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
         <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-purple.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">SECONDARY HOSPITAL</h5>
         </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <h5 class="fw-bold" style="color:#3c8dbc;">
                General Hospital (Secondary - At the Regional / State or District-Level)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Secondary-Level General Hospital in Myanmar refers to general hospitals located outside major cities, typically at the state/regional or district level. These hospitals provide broad multi-specialty services but do not possess full tertiary-level subspecialty capability.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Regional referral centers for township and station hospitals</li>
                    <li>Provide multi-specialty care for moderate to complex conditions</li>
                    <li>Stabilize and refer advanced cases to tertiary hospitals</li>
                    <li>Support regional healthcare delivery and workforce training</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately 100–500 beds</li>
                    <li>
                        <strong>Core Specialties</strong>
                        <ul>
                            <li>Internal Medicine</li>
                            <li>General Surgery</li>
                            <li>Obstetrics & Gynecology</li>
                            <li>Pediatrics</li>
                            <li>Orthopedics</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Intermediate Services </strong>
                        <ul>
                            <li>Basic ICU / High Dependency Unit (HDU)</li>
                            <li>Emergency care services</li>
                            <li>Selected specialist services</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Surgical & Procedural Capacity </strong>
                        <ul>
                            <li>Standard elective and emergency surgeries</li>
                            <li>Basic trauma center</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Imaging: X-ray, Ultrasound, CT Scan (in most facilities)</li>
                            <li>Type B / Type A Laboratory (level depending on facility) <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a> </li>
                        </ul>
                    </li>
                </ul>
            </p>
            <p class="text-justify">
                <b><U>Note:</u></b> A General Hospital is classified as Secondary when it is a regional (not national) referral center, has limited subspecialty coverage, and lacks the full advanced capabilities of tertiary hospitals.
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                Regional / State Hospital (Secondary)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Regional/State Hospital is a core secondary-level facility by definition in Myanmar’s health system. It is designed to function as the main referral hospital in a state or region, providing expanded clinical services beyond district level.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Primary referral center within a state or region</li>
                    <li>Provide expanded specialist services</li>
                    <li>Support district and township hospitals</li>
                    <li>Contribute to regional training and service delivery</li>
                </ul>
            </p>
             <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately 200–500 beds</li>
                    <li>
                        <strong>Core and Selected Specialties</strong>
                        <ul>
                            <li>Internal Medicine</li>
                            <li>General Surgery</li>
                            <li>Obstetrics & Gynecology</li>
                            <li>Pediatrics</li>
                            <li>Orthopedics</li>
                            <li>Anesthesiology</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Intermediate Services </strong>
                        <ul>
                            <li>ICU and emergency services</li>
                            <li>Expanded diagnostic capabilities</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Imaging (X-ray, Ultrasound, CT in most facilities)</li>
                            <li>Laboratory (Type B / Type A level depending on facility) <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                        </ul>
                    </li>
                </ul>
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                District Hospital (Secondary)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A District Hospital classified as a Secondary facility represents an upgraded district-level facility with expanded services and capacity, and is an intermediate referral center.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Township hospitals referral center</li>
                    <li>Manage moderate to complex medical conditions</li>
                    <li>Provide stabilization and referral to higher-level hospitals</li>
                </ul>
            </p>
             <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately 100–200+ beds</li>
                    <li>
                        <strong>Core Specialties</strong>
                        <ul>
                            <li>Internal Medicine</li>
                            <li>General Surgery</li>
                            <li>Obstetrics & Gynecology</li>
                            <li>Pediatrics</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Intermediate Services </strong>
                        <ul>
                            <li>Limited ICU capability (in upgraded facilities)</li>
                            <li>Emergency and inpatient care</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Imaging (X-ray, limited CT in some cases)</li>
                            <li>Type B Laboratory (Type B / Type A level depending on facility) <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                        </ul>
                    </li>
                </ul>
            </p>
            <p class="text-justify">
                <b><u>Note:</u></b> A District Hospital is classified as Secondary when it has higher bed capacity, expanded clinical services, and a defined referral role for surrounding township hospitals.
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                MYANMAR GOVERNMENT HEALTH INSURANCE
            </h5>
            <p class="text-justify">
                Myanmar does not maintain a comprehensive national health insurance system administered by the government. Healthcare coverage remains limited in scope and is not universally accessible. The closest equivalent is the Social Security Scheme (SSS) of Myanmar, which provides the following cover:
                <ul>
                    <li>Restricted primarily to formal sector workers</li>
                    <li>Covers only a limited proportion of the population</li>
                    <li>Provides a constrained range of benefits and healthcare services</li>
                </ul>
                As a result, a significant proportion of the population in Myanmar continues to rely on direct payments made by individuals to healthcare providers at the time of service, without reimbursement from insurance or government programs.
            </p>
            <h6 class="fw-bold">
                <b>Social Security Scheme (SSS) Myanmar</b>
            </h6>
            <p class="text-justify">
                SSS is a government-administered insurance program that provides health, social, and financial protection to formal-sector employees. It is managed by the Social Security Board (SSB) under the Ministry of Labour, Immigration and Population and constitutes the country’s principal contributory social protection mechanism for workers.
            </p>
            <h6 class="fw-bold">
                <b>Key facts:</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li><b>Established:</b> 1954 (restructured under the 2012 Social Security Law)</li>
                    <li><b>Administering authority:</b> Social Security Board (SSB)</li>
                    <li><b>Coverage:</b> Employees in public and private sector establishments registered under the scheme</li>
                    <li><b>Financing:</b> Payroll-based contributions from employers and employees</li>
                    <li><b>Core benefits: </b> Healthcare services, maternity benefits, sickness allowances, disability benefits, and survivors’ benefits</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Legal and institutional background</b>
            </h6>
            <p class="text-justify">
                The scheme was originally established under the Social Security Act of 1954 and subsequently reformed through the 2012 Social Security Law, which aimed to broaden coverage and enhance benefit provisions. The Social Security Board, operating under the Ministry of Labor, Immigration and Population, is responsible for member registration, contribution collection, and benefit administration. It also oversees a network of regional offices and dedicated healthcare facilities serving insured members.
            </p>
            <h6 class="fw-bold">
                <b>Coverage and benefits</b>
            </h6>
            <p class="text-justify">
                SSS applies to employees of registered enterprises employing five or more workers. Contribution rates are generally set at 5% of wages, with 3% contributed by employers and 2% by employees. Covered individuals are entitled to a range of benefits, including medical care, maternity allowances, cash sickness benefits, disability pensions, and funeral grants. Healthcare services are delivered through designated SSB hospitals and clinics, particularly in major urban centers including Yangon and Mandalay.
            </p>
            <h6 class="fw-bold">
                <b>Implementation and challenges</b>
            </h6>
            <p class="text-justify">
                Coverage remains limited to the formal sector, leaving most informal workers outside the scheme. Administrative capacity, awareness, and compliance enforcement have been ongoing challenges. Expansion efforts, including digital registration and pilot programs for informal workers, are gradually extend the protection to a broader labor force.
            </p>
            <h6 class="fw-bold">
                <b>Current role</b>
            </h6>
            <p class="text-justify">
                The Social Security Scheme is Myanmar’s primary state-backed mechanism for worker welfare and risk protection, aligning with national objectives for inclusive social protection and labor rights compliance within the country’s evolving economic framework.
            </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level55Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital_pin-blue.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">LARGE PRIVATE HOSPITAL</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Large Private Hospital in Myanmar is a high-capacity, multi-specialty facility that provides comprehensive secondary to limited tertiary-level care. These hospitals are typically located in major urban centers and are equipped with advanced medical technology and a wide range of specialist services.
            </p>
            <p class="text-justify">
                <b><u>Note:</u></b> Unlike public hospitals, private hospitals in Myanmar are not formally classified into tiers by the government. Instead, they are regulated under licensing frameworks and industry standards (e.g., <a href="https://www.mphamyanmar.org/" target="_blank">Myanmar Private Hospitals’ Association</a>), while their functional classification is analytically derived based on bed capacity, clinical capability, diagnostic infrastructure, and specialist availability.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Provide advanced diagnostic and therapeutic services across multiple specialties</li>
                    <li>Function as major private referral centers for complex cases</li>
                    <li>Offer an alternative to public tertiary hospitals for high-end care</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, typically 150–500+ beds</li>
                    <li>
                        <strong>Core and Advanced Specialties</strong>
                        <ul>
                            <li>Internal Medicine (with subspecialties)</li>
                            <li>General Surgery</li>
                            <li>Orthopedic Surgery</li>
                            <li>Obstetrics & Gynecology</li>
                            <li>Pediatrics</li>
                            <li>Cardiology</li>
                            <li>Neurology</li>
                            <li>Oncology (in some facilities)</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Advanced Services </strong>
                        <ul>
                            <li>Intensive Care Units (ICU, NICU)</li>
                            <li>Advanced imaging (CT, MRI)</li>
                            <li>Cardiac diagnostics and procedures</li>
                            <li>Endoscopy and minimally invasive surgery</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Full laboratory services (comparable to Type A/B) <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                            <li>Comprehensive imaging services</li>
                            <li>24/7 emergency services</li>
                        </ul>
                    </li>
                </ul>
            </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level66Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/hospital-pin-red.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">Tertiary Hospital</h5>
        </div>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <p class="text-justify">
                A Tertiary Public Hospital in Myanmar represents the highest level of care, typically consisting of major city General Hospitals, Teaching Hospitals, and Specialist Hospitals located in key urban centers including Yangon, Mandalay, and Nay Pyi Taw. These hospitals are national referral centers, managing the most complex and specialized medical conditions while also being hubs for medical education and research.
                However, a General Hospital is a hospital type rather than a fixed level of care, and is categorized as being either Secondary or Tertiary depending on its bed capacity, clinical capability, specialist, and subspecialist availability, and referral role.
                Tertiary General Hospitals are typically large facilities (above ≈500 beds) with full subspecialty coverage, advanced diagnostics (e.g., MRI, CT, specialized laboratories), and the ability to perform complex procedures including cardiac or neurosurgery. Tertiary General Hospitals are national referral centers and are mostly located in major cities, including Yangon, Mandalay, and Nay Pyi Taw.
                In contrast, Secondary General Hospitals are usually smaller (≈50 – 500 beds), provide core specialties with limited subspecialty, and manage moderate-complexity cases while referring advanced cases upward. Secondary General Hospitals typically are regional referral centers and are commonly located at the state/regional or district level.
                Consistent with Ministry of Health and Sports (MOHS) guidance, classification is determined by service capability and referral function, not by the hospital name itself. A General Hospital is classified as Tertiary when it operates as a high-capability national referral center, and Secondary when it is operating as a regional-level facility with more limited scope of care.
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                General Hospitals (Tertiary - Major City)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Major City General Hospital is a large, multi-specialty tertiary hospital located in major urban centers including Yangon, Mandalay, and Nay Pyi Taw. It provides comprehensive clinical services across all major disciplines and functions as a national referral center, managing a wide spectrum of complex medical and surgical cases.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>National referral centers for complex and critical cases</li>
                    <li>Provide advanced and subspecialty medical care</li>
                    <li>Function as teaching and training institutions for doctors and specialists</li>
                    <li>Lead clinical research and advanced medical innovation</li>
                    <li>Support lower-level hospitals through referral and technical guidance</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately above 500 beds</li>
                    <li>
                        <strong>Core and Subspecialties</strong>
                        <ul>
                            <li>Internal Medicine (cardiology, neurology, nephrology, oncology, etc.)</li>
                            <li>General Surgery</li>
                            <li>Cardiothoracic Surgery</li>
                            <li>Neurosurgery</li>
                            <li>Orthopedic Surgery</li>
                            <li>Obstetrics & Gynecology</li>
                            <li>Pediatrics (including subspecialties)</li>
                            <li>Anesthesiology</li>
                            <li>Emergency Medicine</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Advanced Tertiary Services </strong>
                        <ul>
                            <li>Organ transplantation (in selected centers)</li>
                            <li>Cardiac surgery and catheterization laboratories</li>
                            <li>Radiation oncology and advanced cancer care</li>
                            <li>Dialysis and renal replacement therapy</li>
                            <li>Advanced intensive care (ICU, NICU, CCU)</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Surgical & Procedural Capacity </strong>
                        <ul>
                            <li>Complex and high-risk surgeries</li>
                            <li>Multidisciplinary surgical procedures</li>
                            <li>Advanced minimally invasive surgery</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Imaging (X-ray, Ultrasound, CT Scan, MRI, PET-CT)</li>
                            <li>Type A Laboratory <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                        </ul>
                    </li>
                </ul>
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                Teaching Hospital (Tertiary)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Teaching Hospital is a tertiary-level hospital formally affiliated with medical universities, and is a center for medical education, specialist training, and clinical research. Teaching hospitals provide highly specialized care while simultaneously training undergraduate and postgraduate medical personnel.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Train medical students, interns, and specialist residents</li>
                    <li>Provide advanced and subspecialty clinical services</li>
                    <li>Conduct clinical research and academic activities</li>
                    <li>National referral centers for complex cases</li>
                </ul>
            </p>

            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately above 500 beds</li>
                    <li>
                        <strong>Core and Subspecialties</strong>
                        <ul>
                            <li>Full range of medical and surgical specialties<li>
                            <li>Extensive subspecialty departments across disciplines</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Advanced Tertiary Services </strong>
                        <ul>
                            <li>Highly specialized procedures (e.g., complex oncology, neurosurgery)<li>
                            <li>Multidisciplinary care teams</li>
                            <li>Advanced ICU and critical care units</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Surgical & Procedural Capacity </strong>
                        <ul>
                            <li>Complex and high-risk surgeries</li>
                            <li>Teaching-integrated surgical practice</li>
                            <li>Multidisciplinary case management</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Imaging: X-ray, Ultrasound, CT Scan, MRI, Advanced imaging modalities</li>
                            <li>Type A Laboratory <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                        </ul>
                    </li>
                </ul>
            </p>
            <p class="text-justify">
                <b><u>Note:</u></b> Teaching Hospitals are inherently tertiary due to their academic function, full specialist coverage, and role in national referral and training systems.
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                Specialist Hospital (Tertiary)
            </h5>
            <h6 class="fw-bold">
                <b>Overview</b>
            </h6>
            <p class="text-justify">
                A Specialist Hospital is a tertiary-level facility focused on a specific field of medicine, including cardiology, orthopedics, oncology, or infectious diseases. Specialist hospitals provide highly specialized and advanced care within their domain and act as national referral centers for specific conditions.
            </p>
            <h6 class="fw-bold">
                <b>Role</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Provide specialized care within a defined medical field</li>
                    <li>National referral centers for specific diseases or procedures</li>
                    <li>Support other hospitals with specialist expertise</li>
                    <li>Contribute to advanced clinical practice and training</li>
                </ul>
            </p>

            <h6 class="fw-bold">
                <b>Clinical Services</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li>Bed Capacity, approximately 200 – 800+ beds (varies by specialty)</li>
                    <li>
                        <strong>Specialized Clinical Focus</strong>
                        <ul>
                            <li>Cardiology / Cardiothoracic services<li>
                            <li>Oncology services</li>
                            <li>Orthopedic and trauma services</li>
                            <li>Infectious disease management</li>
                            <li>Other specialty-specific services</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Advanced Tertiary Services </strong>
                        <ul>
                            <li>Highly specialized procedures within the field</li>
                            <li>Advanced disease-specific treatment protocols</li>
                            <li>Specialized ICU units (e.g., cardiac ICU)</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Surgical & Procedural Capacity </strong>
                        <ul>
                           <li>Complex specialty-specific surgeries</li>
                           <li>High-risk and advanced procedures</li>
                        </ul>
                    </li>
                    <li class="mt-2">
                        <strong>Diagnostic & Support Infrastructure</strong>
                        <ul>
                            <li>Imaging: CT Scan, MRI, Specialty-specific imaging systems</li>
                            <li>Type A Laboratory <a href="{{ route('exurl') }}" target="_blank">(click here to see laboratory classifications)</a></li>
                        </ul>
                    </li>
                </ul>
            </p>
            <p class="text-justify">
                <b><u>Note:</u></b> Specialist Hospitals are classified as Tertiary due to their highly specialized capability, advanced procedures, and national referral role, even though their scope is narrower than general hospitals.
            </p>
            <h5 class="fw-bold" style="color:#3c8dbc;">
                MYANMAR GOVERNMENT HEALTH INSURANCE
            </h5>
            <p class="text-justify">
                Myanmar does not maintain a comprehensive national health insurance system administered by the government. Healthcare coverage remains limited in scope and is not universally accessible. The closest equivalent is the Social Security Scheme (SSS) of Myanmar, which provides the following cover:
                <ul>
                    <li>Restricted primarily to formal sector workers</li>
                    <li>Covers only a limited proportion of the population</li>
                    <li>Provides a constrained range of benefits and healthcare services</li>
                </ul>
                As a result, a significant proportion of the population in Myanmar continues to rely on direct payments made by individuals to healthcare providers at the time of service, without reimbursement from insurance or government programs.
            </p>
            <h6 class="fw-bold">
                <b>Social Security Scheme (SSS) Myanmar</b>
            </h6>
            <p class="text-justify">
                SSS is a government-administered insurance program that provides health, social, and financial protection to formal-sector employees. It is managed by the Social Security Board (SSB) under the Ministry of Labour, Immigration and Population and constitutes the country’s principal contributory social protection mechanism for workers.
            </p>
            <h6 class="fw-bold">
                <b>Key facts:</b>
            </h6>
            <p class="text-justify">
                <ul>
                    <li><b>Established:</b> 1954 (restructured under the 2012 Social Security Law)</li>
                    <li><b>Administering authority:</b> Social Security Board (SSB)</li>
                    <li><b>Coverage:</b> Employees in public and private sector establishments registered under the scheme</li>
                    <li><b>Financing:</b> Payroll-based contributions from employers and employees</li>
                    <li><b>Core benefits: </b> Healthcare services, maternity benefits, sickness allowances, disability benefits, and survivors’ benefits</li>
                </ul>
            </p>
            <h6 class="fw-bold">
                <b>Legal and institutional background</b>
            </h6>
            <p class="text-justify">
                The scheme was originally established under the Social Security Act of 1954 and subsequently reformed through the 2012 Social Security Law, which aimed to broaden coverage and enhance benefit provisions. The Social Security Board, operating under the Ministry of Labor, Immigration and Population, is responsible for member registration, contribution collection, and benefit administration. It also oversees a network of regional offices and dedicated healthcare facilities serving insured members.
            </p>
            <h6 class="fw-bold">
                <b>Coverage and benefits</b>
            </h6>
            <p class="text-justify">
                SSS applies to employees of registered enterprises employing five or more workers. Contribution rates are generally set at 5% of wages, with 3% contributed by employers and 2% by employees. Covered individuals are entitled to a range of benefits, including medical care, maternity allowances, cash sickness benefits, disability pensions, and funeral grants. Healthcare services are delivered through designated SSB hospitals and clinics, particularly in major urban centers including Yangon and Mandalay.
            </p>
            <h6 class="fw-bold">
                <b>Implementation and challenges</b>
            </h6>
            <p class="text-justify">
                Coverage remains limited to the formal sector, leaving most informal workers outside the scheme. Administrative capacity, awareness, and compliance enforcement have been ongoing challenges. Expansion efforts, including digital registration and pilot programs for informal workers, are gradually extend the protection to a broader labor force.
            </p>
            <h6 class="fw-bold">
                <b>Current role</b>
            </h6>
            <p class="text-justify">
                The Social Security Scheme is Myanmar’s primary state-backed mechanism for worker welfare and risk protection, aligning with national objectives for inclusive social protection and labor rights compliance within the country’s evolving economic framework.
            </p>
      </div>
    </div>
  </div>
</div>

@endsection

@push('service')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
