@extends('layouts.master-admin')

@section('title', 'Dashboard')

@section('page-title', 'Papua New Guinea Crisis Management Tools')

@push('styles')

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.6.0/Control.FullScreen.css" />

    <style>
        #map {
            height: 700px;
        }
        .filter-container {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .form-check-scrollable {
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
        }
        .total-info {
            background: white;
            padding: 8px 12px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.2);
            font-weight: bold;
            margin-left: 10px;
        }

        .select2-container .select2-selection--single {
            height: 45px;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 45px;
            right: 10px;
        }

        .p-modal{
            text-align:justify;
        }
        .hospital-legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 0 5px;
        }
        .hospital-legend-item img {
            width: 30px;
            height: 30px;
        }

        p{
        margin-bottom: 8px;
            line-height: 18px;
        }

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

        .card-header{
            padding: 0.25rem 1.25rem;
            color: #3c66b5;
            font-weight: bold;
        }

        .mb-4{
            margin-bottom: 0.5rem !important;
        }

         /* Classification section */
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
    <div class="row" style="background-color: #dfeaf1;">
         <div class="col-md-9">
            <div class="d-flex p-3" style="justify-content: center;">
                <div class="d-flex gap-2">

                <!-- Airport -->
                      <div class="class-column" style="margin-right: 100px;">
                        <div class="class-header class-airport-category">Airfield Classification</div>
                        <div class="airport-list">
                          <div class="hospital-row" style="flex-direction: column;">
                            <!-- Airport row 1 -->
                            <div class="hospital-item">
                              <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level6Modal">
                                  <img src="https://pg.concordreview.com/wp-content/uploads/2024/10/International-Airport.png" style="width:18px; height:18px;">
                                  <small>International</small>
                              </button>

                              <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level5Modal">
                                  <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/regional-airport.png" style="width:18px; height:18px;">
                                  <small>Domestic</small>
                              </button>

                              <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level4Modal">
                                  <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/regional-domestic-airport.png" style="width:18px; height:18px;">
                                  <small>Regional</small>
                              </button>
                            </div>
                            <!-- Airport row 2 -->
                            <div class="hospital-item">
                              <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level2Modal">
                                  <img src="https://pg.concordreview.com/wp-content/uploads/2024/10/civil-military-airport.png" style="width:18px; height:18px;">
                                  <small>Civil-Military</small>
                              </button>

                              <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level3Modal">
                                  <img src="https://pg.concordreview.com/wp-content/uploads/2024/10/military-airport-red.png" style="width:18px; height:18px;">
                                  <small>Military</small>
                              </button>

                              <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level1Modal">
                                  <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/private-airport.png" style="width:18px; height:18px;">
                                  <small>Private</small>
                              </button>
                            </div>
                          </div>

                        </div>
                      </div>

                      <!-- Medical Facility Legend -->
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

        <div class="col-md-3">
            <div class="d-flex justify-content-end p-3">
                <div class="d-flex gap-2 mt-2">

                    <a href="{{ url('airports') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('airports') ? 'active' : '' }}">
                        <i class="bi bi-airplane fs-3"></i>
                        <small>Airports</small>
                    </a>

                    <a href="{{ url('hospital') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('hospital') ? 'active' : '' }}">
                    <img src="{{ asset('images/icon-medical.png') }}" style="width: 24px; height: 24px;">
                        <small>Medical</small>
                    </a>

                    <a href="{{ url('aircharter') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('aircharter') ? 'active' : '' }}">
                        <img src="{{ asset('images/icon-air-charter.png') }}" style="width: 48px; height: 24px;">
                        <small>Air Charter</small>
                    </a>

                    <a href="{{ url('police') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('police') ? 'active' : '' }}">
                    <i class="bi bi-person-badge" style="width: 24px; height: 24px;"></i>
                        <small>Police</small>
                    </a>

                    <a href="{{ url('embassiees') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('embassiees') ? 'active' : '' }}">
                    <img src="{{ asset('images/icon-embassy.png') }}" style="width: 24px; height: 24px;">
                        <small>Embassies</small>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="map"></div>

<div class="row justify-content-center mt-3">

    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3 id="totalHospitalsDisplay">{{ $totalhospital }}</h3>

          <p>Medical Facility</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>

      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3 id="totalAirportsDisplay">{{ $totalairport }}</h3>

          <p>Airport</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>

      </div>
    </div>
</div>

<div class="modal fade" id="level1Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
             <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/private-airport.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">Private Airfield</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal">Also known as private airfields or airstrips are primarily used for general and private aviation are owned by private individuals, groups, corporations, or organizations operated for their exclusive use that may include limited access for authorized personnel by the owner or manager. Owners are responsible to ensure safe operation, maintenance, repair, and control of who can use the facilities. Typically, they are not open to the public or provide scheduled commercial airline services and cater to private pilots, business aviation, and sometimes small charter operations. Services may be provided if authorized by the appropriate regulatory authority.</p>

        <p class="p-modal">A large majority of private airports are grass or dirt strip fields without services or facilities, they may feature amenities such as hangars, fueling facilities, maintenance services, and ground transportation options tailored to the needs of their owners or users. Private airports are not subject to the same level of regulatory oversight as public airports, but must still comply with applicable aviation regulations, safety standards, and environmental requirements. In the event of an emergency, landing at a private airport is authorized without any prior approval and should be done if landing anywhere else compromises the safety of the aircraft, crew, passengers, or cargo.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level2Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2024/10/civil-military-airport.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">Combined Airfield</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal">Also called "joint-use airport," are used by both civilian and military aircraft, where a formal agreement exists between the military and a local government agency allowing shared access to infrastructure and facilities, typically with separate passenger terminals and designated operating areas, airspace allocation, and aircraft scheduling. Features can include aircraft maintenance, air traffic control, communications, emergency response, and fuel storage.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level3Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
             <img src="https://pg.concordreview.com/wp-content/uploads/2024/10/military-airport-red.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">Military Airfield</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal">Facilities where military aircraft operate, also known as a military airport, airbase, or air station. Features include aircraft maintenance, air traffic control, communications, emergency response, fuel and weapon storage, defensive systems, aircraft shelters, and personnel facilities.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level4Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/regional-domestic-airport.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">Regional Domestic Airfield</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal">A small or remote regional domestic airfield usually located in a geographically isolated area, far from major population centers, often with difficult terrain or vast distances from other airports with limited passenger traffic. May have shorter runways, basic facilities, and limited amenities, and basic infrastructure, serving primarily local communities providing access to essential services like medical transport or regional travel, rather than large-scale commercial flights.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level5Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2025/01/regional-airport.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">Domestic Airfield</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal">Exclusively manages flights that originate and end within the same country, does not have international customs or border control facilities. Airport often has smaller and shorter runways, suitable for smaller regional aircraft used on domestic routes, and cannot support larger haul aircraft having less developed support services. Features can include aircraft maintenance, air traffic control, communications, emergency response, and fuel storage.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level6Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="https://concord-consulting.com/static/img/cmt/icon/icon-international-airport-orange.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">International Airfield</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal">Meet standards set by the International Air Transport Association (IATA) and the International Civil Aviation Organization (ICAO), facilitate transnational travel managing flights between countries, have customs and border control facilities to manage passengers and cargo, and may have dedicated terminals for domestic and international flights. International airports have longer runways to accommodate larger, heavier aircraft, are often a main hub for air traffic, and can serve as a base for larger airlines. Features can include aircraft maintenance, air traffic control, communications, emergency response, and fuel storage</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level7Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="https://pg.concordreview.com/wp-content/uploads/2024/10/military-airport-red.png" style="width:30px; height:30px;">
            <h5 class="modal-title" id="disclaimerLabel">Military Airfield</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal">Facilities where military aircraft operate, also known as a military airport, airbase, or air station. Features include aircraft maintenance, air traffic control, communications, emergency response, fuel and weapon storage, defensive systems, aircraft shelters, and personnel facilities.</p>
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

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.6.0/Control.FullScreen.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // --- Map Initialization ---
    const map = L.map('map').setView([21.909935841888522, 95.91172488921482], 6);

    const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors', maxZoom: 19
    }).addTo(map);

    const satelliteLayer = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
        { attribution: 'Tiles © Esri', maxZoom: 19 }
    );

    L.control.layers(
        { "Street Map": osmLayer, "Satellite Map": satelliteLayer },
        null,
        { position: 'topleft' } // posisi kiri atas
    ).addTo(map);

    L.control.fullscreen({
        position: 'topleft' // tetap di kiri atas
    }).addTo(map);

    const style = document.createElement('style');
    style.textContent = `
        .leaflet-top.leaflet-left .leaflet-control-layers {
            margin-top: 5px !important;
        }
        .leaflet-top.leaflet-left .leaflet-control-zoom {
            margin-top: 10px !important;
        }
        `;
    document.head.appendChild(style);

    // --- Global States ---
    let airportMarkers = L.featureGroup().addTo(map);
    let hospitalMarkers = L.featureGroup().addTo(map);
    let radiusCircle = null;
    let radiusPinMarker = null;
    let lastClickedLocation = null;
    let drawnPolygonGeoJSON = null;
    let totalHospitals = 0;
    let totalAirports = 0;

    // --- Leaflet Draw ---
    const drawnItems = new L.FeatureGroup().addTo(map);
    const drawControl = new L.Control.Draw({
        draw: {
            polygon: { allowIntersection: false, shapeOptions: { color: '#0000FF', fillOpacity: 0.2 } },
            polyline: false, rectangle: false, circle: false, marker: false, circlemarker: false
        },
        edit: { featureGroup: drawnItems }
    });
    map.addControl(drawControl);

    map.on(L.Draw.Event.CREATED, e => {
        drawnItems.clearLayers();
        drawnItems.addLayer(e.layer);
        drawnPolygonGeoJSON = e.layer.toGeoJSON();
        applyFiltersWithMapControl('all');
    });
    map.on(L.Draw.Event.EDITED, e => {
        e.layers.eachLayer(layer => drawnPolygonGeoJSON = layer.toGeoJSON());
        applyFiltersWithMapControl('all');
    });
    map.on(L.Draw.Event.DELETED, () => {
        drawnItems.clearLayers();
        drawnPolygonGeoJSON = null;
        applyFiltersWithMapControl('all');
    });

    // --- Update Radius ---
    function updateRadiusCircleAndPin(radius = 0) {
        if (radiusCircle) { map.removeLayer(radiusCircle); radiusCircle = null; }
        if (radiusPinMarker) { map.removeLayer(radiusPinMarker); radiusPinMarker = null; }

        if (radius > 0 && lastClickedLocation) {
            radiusCircle = L.circle(lastClickedLocation, {
                color: 'red', fillColor: '#f03', fillOpacity: 0.3, radius: radius * 1000
            }).addTo(map);
            const redIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41]
            });
            radiusPinMarker = L.marker(lastClickedLocation, { icon: redIcon }).addTo(map);
        }
    }

    map.on('click', e => {
        lastClickedLocation = { lat: e.latlng.lat, lng: e.latlng.lng };
        const radius = parseInt(document.querySelector('#radiusRangeMap')?.value || 0);
        document.querySelector('#radiusValueMap').textContent = radius;
        updateRadiusCircleAndPin(radius);
    });

    // --- Fetch Data ---
    async function fetchData(url, filters = {}) {
        const params = new URLSearchParams();
        Object.entries(filters).forEach(([k, v]) => {
            if (Array.isArray(v)) v.forEach(x => params.append(`${k}[]`, x));
            else if (v !== '' && v != null) params.append(k, v);
        });
        if (drawnPolygonGeoJSON) params.append('polygon', JSON.stringify(drawnPolygonGeoJSON));

        try {
            const res = await fetch(`${url}?${params.toString()}`);
            return res.ok ? await res.json() : [];
        } catch (e) {
            console.error(`Error fetching ${url}:`, e);
            return [];
        }
    }

    // --- Add Markers ---
    function addMarkers(data, group, defaultIconUrl) {
        group.clearLayers();
        data.forEach(item => {
            if (!item || !item.latitude || !item.longitude) return;

            const icon = L.icon({
                iconUrl: item.icon || defaultIconUrl || L.Icon.Default.imagePath + '/marker-icon.png',
                iconSize: [24, 24],
                iconAnchor: [12, 24],
                popupAnchor: [0, -20]
            });

            const marker = L.marker([item.latitude, item.longitude], { icon }).addTo(group);

            let itemName = '', detailUrl = '', popupContent = '';

            if (item.airport_name) {
                itemName = item.airport_name;
                detailUrl = `/airports/${item.id}/detail`;
                popupContent = `
                    <h5 style="border-bottom:1px solid #cccccc;">${itemName}</h5>
                    <strong>Classification:</strong> ${item.category || 'N/A'}<br>
                    <strong>Address:</strong> ${item.address || 'N/A'}<br>
                    ${item.website ? `<strong>Website:</strong> <a href='${item.website}' target='__blank'>${item.website}</a><br>` : ''}
                `;
            } else if (item.name) {
                itemName = item.name;
                detailUrl = `/hospitals/${item.id}`;
                popupContent = `
                    <h5 style="border-bottom:1px solid #cccccc;">${itemName}</h5>
                    <strong>Global Classification:</strong> ${item.facility_category || 'N/A'}<br>
                    <strong>Country Classification:</strong> ${item.facility_level || 'N/A'}<br>
                    <strong>Address:</strong> ${item.address || 'N/A'}<br>
                    <strong>Coords:</strong> ${item.latitude}, ${item.longitude}<br>
                    <strong>Province:</strong> ${item.provinces_region || 'N/A'}<br>
                `;
            }

            if (item.id && detailUrl)
                popupContent += `<a href="${detailUrl}" class="btn btn-primary btn-sm mt-2" style="color:white;">Read More</a>`;

            marker.bindPopup(popupContent);
        });
    }

    // --- Apply Filters ---
    async function applyFiltersWithMapControl(
        type = 'all',
        hospitalLevels = [],
        airportClasses = [],
        provinces = [],
        radius = 0,
        airportName = '',
        hospitalName = ''
    ) {
        let common = { provinces };
        if (radius > 0 && lastClickedLocation) {
            common.radius = radius;
            common.center_lat = lastClickedLocation.lat;
            common.center_lng = lastClickedLocation.lng;
        }

        totalHospitals = 0;
        totalAirports = 0;

        // === HOSPITALS ===
        if (type === 'hospital' || type === 'all') {
            const hospitals = await fetchData('/api/hospital', {
                ...common,
                name: hospitalName,
                category: hospitalLevels
            });
            addMarkers(hospitals, hospitalMarkers, null);
            totalHospitals = hospitals.length;
        } else {
            hospitalMarkers.clearLayers();
        }

        // === AIRPORTS ===
        if (type === 'airport' || type === 'all') {
            const airports = await fetchData('/api/airports', {
                ...common,
                name: airportName
            });

            const filteredAirports = airports.filter(a => {
                if (airportClasses.length === 0) return true;
                if (!a.category) return false;
                const dbCategories = a.category.split(',').map(c => c.trim().toLowerCase());
                return airportClasses.some(sel => dbCategories.includes(sel.toLowerCase()));
            });

            addMarkers(
                filteredAirports,
                airportMarkers,
                'https://pg.concordreview.com/wp-content/uploads/2024/10/International-Airport.png'
            );
            totalAirports = filteredAirports.length;
        } else {
            airportMarkers.clearLayers();
        }

        updateRadiusCircleAndPin(radius);
        updateTotalCountDisplay();
    }

    function updateTotalCountDisplay() {
        const el = document.getElementById('totalCountDisplay');
        if (el) {
            el.innerHTML = `<strong>Airports:</strong> ${totalAirports} <br><strong>Medical Facilities:</strong> ${totalHospitals}`;
        }
    }

    // === COMBINED PANEL ===
    const CombinedPanel = L.Control.extend({
        options: { position: 'topright' },
        onAdd: function () {
            const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');
            Object.assign(div.style, {
                background: 'white',
                borderRadius: '8px',
                boxShadow: '0 2px 6px rgba(0,0,0,0.2)',
                minWidth: '260px',
                maxHeight: '85vh',
                overflowY: 'auto'
            });

            div.innerHTML = `
                <button style="background:#007bff;color:white;border:none;width:100%;padding:8px;">Filter & Radius</button>
                <div id="filterPanel" style="padding:10px;">
                    <strong>Radius: <span id="radiusValueMap">0</span> km</strong>
                    <input type="range" id="radiusRangeMap" min="0" max="500" value="0" style="width:100%;margin-bottom:6px;">
                    <div style="display:flex;gap:5px;">
                        <button id="applyRadiusMap" class="btn btn-sm btn-primary flex-fill">Apply</button>
                        <button id="resetRadiusMap" class="btn btn-sm btn-danger flex-fill">Reset</button>
                    </div>
                    <hr>
                    <h6>Filter Data</h6>
                    <select id="mapFilter" class="form-select form-select-sm mb-2">
                        <option value="all">Show All</option>
                        <option value="hospital">Hospitals</option>
                        <option value="airport">Airports</option>
                    </select>

                    <div id="airportFilter" style="display:none;">
                        <label>Airport Name:</label>
                        <select id="airport_name_map" class="form-select form-select-sm mb-2 select-search-airport">
                            <option value="">Select Airport</option>
                            @foreach($airportNames as $n)
                                <option value="{{ $n }}">{{ $n }}</option>
                            @endforeach
                        </select>
                        <label>Airport Category</label>
                        ${['International','Domestic','Military','Regional','Private'].map(c => `
                            <label style="display:block;font-size:13px;">
                                <input type="checkbox" name="airportClass" value="${c}"> ${c}
                            </label>`).join('')}
                    </div>

                    <div id="hospitalFilter" style="display:none;">
                        <label>Hospital Name:</label>
                        <select id="hospital_name_map" class="form-select form-select-sm mb-2 select-search-hospital">
                            <option value="">Select Hospital</option>
                            @foreach($hospitalNames as $n)
                                <option value="{{ $n }}">{{ $n }}</option>
                            @endforeach
                        </select>
                        <label>Facility Level</label>
                        ${['Tertiary','Secondary','Primary','Large Private','Medium Private','Small Private'].map(c => `
                            <label style="display:block;font-size:13px;">
                                <input type="checkbox" name="hospitalLevel" value="${c}"> ${c}
                            </label>`).join('')}
                    </div>

                    <hr>
                    <strong>Region</strong>
                    <div style="max-height:120px;overflow-y:auto;border:1px solid #ccc;padding:5px;border-radius:5px;margin-top:6px;">
                        @foreach ($provinces as $p)
                            <div class="form-check">
                                <input class="form-check-input province-checkbox" type="checkbox" value="{{ $p->id }}">
                                <label class="form-check-label">{{ $p->provinces_region }}</label>
                            </div>
                        @endforeach
                    </div>

                    <hr>
                    <button id="resetMapFilter" class="btn btn-sm btn-secondary w-100">Reset All</button>
                    <div id="totalCountDisplay" style="margin-top:8px;text-align:center;font-size:13px;"></div>
                </div>`;
            L.DomEvent.disableClickPropagation(div);
            return div;
        }
    });
    map.addControl(new CombinedPanel());

    // === INIT SELECT2 ===
    setTimeout(() => {
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select-search-airport').select2({ placeholder: 'Select Airport', width: '100%' });
            $('.select-search-hospital').select2({ placeholder: 'Select Hospital', width: '100%' });
        }
    }, 300);

    function getCurrentFiltersFromUI() {
        const type = document.getElementById('mapFilter')?.value || 'all';
        const hLevels = [...document.querySelectorAll('input[name="hospitalLevel"]:checked')].map(e => e.value);
        const aClasses = [...document.querySelectorAll('input[name="airportClass"]:checked')].map(e => e.value);
        const provs = [...document.querySelectorAll('.province-checkbox:checked')].map(e => e.value);
        const radius = parseInt(document.getElementById('radiusRangeMap')?.value || 0);
        // untuk select2, .value akan tetap bekerja because Select2 keeps value in the <select>
        const airportName = document.getElementById('airport_name_map')?.value || '';
        const hospitalName = document.getElementById('hospital_name_map')?.value || '';
        return { type, hLevels, aClasses, provs, radius, airportName, hospitalName };
    }

    // === Event Logic ===
    document.addEventListener('change', async e => {
        const type = document.getElementById('mapFilter').value;
        const hLevels = [...document.querySelectorAll('input[name="hospitalLevel"]:checked')].map(e => e.value);
        const aClasses = [...document.querySelectorAll('input[name="airportClass"]:checked')].map(e => e.value);
        const provs = [...document.querySelectorAll('.province-checkbox:checked')].map(e => e.value);
        const radius = parseInt(document.getElementById('radiusRangeMap').value || 0);
        const airportName = document.getElementById('airport_name_map')?.value || '';
        const hospitalName = document.getElementById('hospital_name_map')?.value || '';

        document.getElementById('airportFilter').style.display = type === 'airport' ? 'block' : 'none';
        document.getElementById('hospitalFilter').style.display = type === 'hospital' ? 'block' : 'none';

        await applyFiltersWithMapControl(type, hLevels, aClasses, provs, radius, airportName, hospitalName);
    });

    // === INPUT: update tampilan radius saat slider digeser (live) ===
document.addEventListener('input', (e) => {
    if (e.target && e.target.id === 'radiusRangeMap') {
        const r = parseInt(e.target.value || 0);
        const el = document.getElementById('radiusValueMap');
        if (el) el.textContent = r;
        // hanya update tampilan lingkaran saja (belum apply ke filter)
        updateRadiusCircleAndPin(r);
    }
});

// === CLICK: apply / reset radius dan reset all ===
document.addEventListener('click', async (e) => {
    if (!e.target) return;

    // APPLY RADIUS => ambil filter sekarang lalu panggil applyFiltersWithMapControl dengan radius
    if (e.target.id === 'applyRadiusMap') {
        const { type, hLevels, aClasses, provs, radius, airportName, hospitalName } = getCurrentFiltersFromUI();
        // pastikan lastClickedLocation ada jika radius > 0
        if (radius > 0 && !lastClickedLocation) {
            alert('Tentukan titik di peta terlebih dahulu dengan klik peta untuk menggunakan filter radius.');
            return;
        }
        await applyFiltersWithMapControl(type, hLevels, aClasses, provs, radius, airportName, hospitalName);
        return;
    }

    // RESET RADIUS (hanya reset radius visual & reapply tanpa radius)
    if (e.target.id === 'resetRadiusMap') {
        // reset slider & tampilan
        const rEl = document.getElementById('radiusRangeMap');
        const rValEl = document.getElementById('radiusValueMap');
        if (rEl) rEl.value = 0;
        if (rValEl) rValEl.textContent = '0';

        // hapus circle & pin
        if (radiusCircle) { map.removeLayer(radiusCircle); radiusCircle = null; }
        if (radiusPinMarker) { map.removeLayer(radiusPinMarker); radiusPinMarker = null; }
        lastClickedLocation = null;

        // apply ulang tanpa radius (tetap simpan filter lain)
        const { type, hLevels, aClasses, provs, airportName, hospitalName } = getCurrentFiltersFromUI();
        await applyFiltersWithMapControl(type, hLevels, aClasses, provs, 0, airportName, hospitalName);
        return;
    }

    // RESET ALL FILTERS (tombol Reset All) -> gunakan handler yang sudah komprehensif
    if (e.target.id === 'resetMapFilter') {
        // 1) UI reset
        document.querySelectorAll('#filterPanel input[type="checkbox"]').forEach(cb => cb.checked = false);

        // reset dropdown tipe
        const mapFilterEl = document.getElementById('mapFilter');
        if (mapFilterEl) mapFilterEl.value = 'all';

        // sembunyikan sub-panels
        const af = document.getElementById('airportFilter');
        const hf = document.getElementById('hospitalFilter');
        if (af) af.style.display = 'none';
        if (hf) hf.style.display = 'none';

        // 2) Reset Select2 (jika ada)
        if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
            $('.select-search-airport').each(function () { $(this).val(null).trigger('change'); });
            $('.select-search-hospital').each(function () { $(this).val(null).trigger('change'); });
        } else {
            const airportSel = document.getElementById('airport_name_map');
            const hospitalSel = document.getElementById('hospital_name_map');
            if (airportSel) airportSel.value = '';
            if (hospitalSel) hospitalSel.value = '';
        }

        // 3) Reset radius visual
        const radiusRange = document.getElementById('radiusRangeMap');
        const radiusValue = document.getElementById('radiusValueMap');
        if (radiusRange) radiusRange.value = 0;
        if (radiusValue) radiusValue.textContent = '0';
        if (radiusCircle) { map.removeLayer(radiusCircle); radiusCircle = null; }
        if (radiusPinMarker) { map.removeLayer(radiusPinMarker); radiusPinMarker = null; }
        lastClickedLocation = null;

        // 4) Remove drawn polygon and layers
        if (drawnItems) drawnItems.clearLayers();
        drawnPolygonGeoJSON = null;

        // 5) Clear markers and counters
        if (airportMarkers) airportMarkers.clearLayers();
        if (hospitalMarkers) hospitalMarkers.clearLayers();
        totalAirports = 0;
        totalHospitals = 0;
        updateTotalCountDisplay();

        // 6) Re-fetch semua data
        await applyFiltersWithMapControl('all', [], [], [], 0, '', '');

        e.stopPropagation();
        e.preventDefault();
        return;
    }
});

// === LISTEN TO CHANGE on filter inputs (kategori/provinsi/select nama) ===
// Ini memastikan ketika user change checkbox / select2, filter langsung ter-apply
function bindFilterChangeAutoApply() {
    // checkbox change
    document.querySelectorAll('#filterPanel input[type="checkbox"]').forEach(el => {
        el.addEventListener('change', async () => {
            const { type, hLevels, aClasses, provs, radius, airportName, hospitalName } = getCurrentFiltersFromUI();
            await applyFiltersWithMapControl(type, hLevels, aClasses, provs, radius, airportName, hospitalName);
        });
    });

    // select dropdown change (mapFilter)
    const mapFilterEl = document.getElementById('mapFilter');
    if (mapFilterEl) {
        mapFilterEl.addEventListener('change', () => {
            const type = mapFilterEl.value;
            document.getElementById('airportFilter').style.display = type === 'airport' ? 'block' : 'none';
            document.getElementById('hospitalFilter').style.display = type === 'hospital' ? 'block' : 'none';
            // also trigger apply
            const { type: t, hLevels, aClasses, provs, radius, airportName, hospitalName } = getCurrentFiltersFromUI();
            applyFiltersWithMapControl(t, hLevels, aClasses, provs, radius, airportName, hospitalName);
        });
    }

    // select2 change (nama)
    // if Select2 is used, listen with jQuery; otherwise plain change event above covers plain <select>
    if (typeof $ !== 'undefined' && $.fn && $.fn.select2) {
        $(document).on('change', '#airport_name_map, #hospital_name_map', async function () {
            const { type, hLevels, aClasses, provs, radius, airportName, hospitalName } = getCurrentFiltersFromUI();
            await applyFiltersWithMapControl(type, hLevels, aClasses, provs, radius, airportName, hospitalName);
        });
    } else {
        document.getElementById('airport_name_map')?.addEventListener('change', async () => {
            const { type, hLevels, aClasses, provs, radius, airportName, hospitalName } = getCurrentFiltersFromUI();
            await applyFiltersWithMapControl(type, hLevels, aClasses, provs, radius, airportName, hospitalName);
        });
        document.getElementById('hospital_name_map')?.addEventListener('change', async () => {
            const { type, hLevels, aClasses, provs, radius, airportName, hospitalName } = getCurrentFiltersFromUI();
            await applyFiltersWithMapControl(type, hLevels, aClasses, provs, radius, airportName, hospitalName);
        });
    }
}

// call binding after panel is rendered
setTimeout(bindFilterChangeAutoApply, 350);

    // --- Initial Load ---
    applyFiltersWithMapControl('all');
</script>

@endpush
