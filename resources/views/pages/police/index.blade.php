@extends('layouts.master')

@section('title', 'Police')
@section('page-title', 'Papua New Guinea Police')

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
    .total-airports {
        background: white;
        padding: 8px 12px;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(0,0,0,0.2);
        font-weight: bold;
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
</style>
@endpush

@section('conten')

<div class="card">

    <div class="d-flex justify-content-end p-3" style="background-color: #dfeaf1;">

        <div class="d-flex gap-2 mt-2">

            <a href="{{ url('airports') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('airports') ? 'active' : '' }}">
                <i class="bi bi-airplane fs-3"></i>
                <small>Aviation</small>
            </a>

            <a href="{{ url('aircharter') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('aircharter') ? 'active' : '' }}">
                  <img src="{{ asset('images/icon-air-charter.png') }}" style="width: 48px; height: 24px;">
                <small>Air Charter</small>
            </a>

            <a href="{{ url('hospital') }}" class="btn btn-danger d-flex flex-column align-items-center p-3 {{ request()->is('hospital') ? 'active' : '' }}">
             <img src="{{ asset('images/icon-medical.png') }}" style="width: 24px; height: 24px;">
                <small>Medical</small>
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

    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center gap-3 my-2">

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-link p-0 fw-bold text-decoration-underline text-dark" data-bs-toggle="modal" data-bs-target="#disclaimerModal">
                    <i class="bi bi-info-circle text-primary fs-5"></i>
                    <small>Disclaimer</small>
                </button>
            </div>

            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold me-2"><small>Map Legend:</small></span>

                <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level6Modal">
                    <img src="{{ asset('images/dot-blue-ring-royal-papua.png') }}" style="width:12px; height:12px;">
                    <small>National Police (HQ)</small>
                </button>

                <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level5Modal">
                    <img src="{{ asset('images/dot-red.png') }}" style="width:12px; height:12px;">
                    <small>State / Region Police Command</small>
                </button>

                <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level4Modal">
                    <img src="{{ asset('images/dot-orange-ppc.png') }}" style="width:12px; height:12px;">
                    <small>District Police Command</small>
                </button>

                <button class="btn p-1" data-bs-toggle="modal" data-bs-target="#level3Modal">
                    <img src="{{ asset('images/dot-green.png') }}" style="width:12px; height:12px;">
                    <small>Township Police Station</small>
                </button>

            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="disclaimerLabel">Disclaimer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <p class="p-modal text-justify">Every attempt has been made to ensure the completeness and accuracy of the most updated information and data available. Clients are advised, however, that provided information, and data is subject to change.</p>
       <h5 class="modal-title" id="disclaimerLabel">Google Maps Link</h5>
       <p class="p-modal text-justify">Google Maps may automatically display or translate content based on the user’s current region, browser settings, or Google account preferences. This issue may occur when opening google maps link from TCMT platform using Microsoft Edge. For the best experience, we recommend opening the Google Chrome link while logged into your Google account. You can also use your browser’s translation feature to view Google Maps in your preferred language.</p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level3Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
             <img src="{{ asset('images/dot-green.png') }}" style="width:15px; height:15px;">
            <h5 class="modal-title" id="disclaimerLabel">Township Police Force</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal text-justify">
            The Township Police Force is the main local command layer of the MPF. Connecting District-level supervision with frontline policing and manages the police units that directly serve towns, wards, village tracts, villages, and other local security areas.
        </p>
        <p class="p-modal text-justify">
            <b>Led by:</b> Police Major / Police Captain-level officer.
        </p>
        <p class="p-modal text-justify">
            <b>Area of responsibility:</b> The Township Police Force is responsible for local police command in one Township.
        </p>
        <p class="p-modal text-justify">
            A Township may include towns, wards, village tracts, villages, roads, public facilities, local security points, Police Stations, Police Posts, and Police Guard Posts.
        </p>
        <p class="p-modal text-justify">
            <b>Responsibilities, role, and functions:</b> The Township Police Force supervises Police Stations, Police Posts, and Police Guard Posts; coordinates patrols; receives crime and incident reports; supports investigations; manages local public-order operations; deploys personnel to checkpoints or guard duties; and reports operational developments to the District Police Force. It is the key command layer for managing police presence across both urban and rural areas.
        </p>
        <p class="p-modal text-justify">
            <b>Frontline Police Level:</b> Frontline police are the lowest operational layer of the Myanmar Police Force, including Police Stations, Police Posts, and Police Guard Posts. They are the first point of contact for local law enforcement matters and responsible for incident response, crime reporting, patrol operations, local security, preliminary investigations, checkpoint or guard duties, and immediate reporting to the Township Police Force. This layer provides the MPF’s direct presence at town, ward, village tract, village, facility, checkpoint, and other local security areas.
        </p>
        <ul>
            <li>
                <b>Police Station</b>
                <p class="p-modal text-justify">
                    Police Station is the primary frontline police office responsible for routine law enforcement in a defined local area and is the main operational unit below the Township Police Force.
                </p>
                <b>Led by:</b> Police Captain / Police Lieutenant-level officer, depend on the station size, location, and operational importance.
                <b>Area of responsibility:</b> Police Station is responsible for routine law enforcement and public police services in its assigned jurisdiction.
                <p class="p-modal text-justify">
                    Police Station may cover a town area, ward cluster, village tract group, road corridor, facility area, or other defined local policing zone.
                </p>
                <b>Responsibilities, role, and functions:</b> A Police Station handles frontline law enforcement, incident response, crime reporting, patrol operations, preliminary investigations, public-order support, detention and case-processing support, local security coordination, and reporting to the Township Police Force. It also serves as the main local point for public complaints, incident registration, criminal case support, and patrol coordination.
            </li>
            <li>
                <b>Police Post / Police Guard Post</b>
                <p class="p-modal text-justify">
                    A Police Post or Police Guard Post is a small frontline police presence established to extend police coverage beyond the main Police Station. It supports local security, observation, reporting, and rapid response, but usually has more limited administrative and investigative capacity than a full Police Station
                </p>
            </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level4Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
             <img src="{{ asset('images/dot-orange-ppc.png') }}" style="width:15px; height:15px;">
            <h5 class="modal-title" id="disclaimerLabel">District Police Force</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal text-justify">
            District Police Force is the intermediate territorial command between the first-level area command and the Township Police Force. It provides supervision, coordination, reporting, and operational control across several townships in a District.
        </p>
        <p class="p-modal text-justify">
            <b>Led by:</b> Police Lieutenant Colonel level officer.
        </p>
        <p class="p-modal text-justify">
            <b>Area of responsibility:</b> District Police Force is responsible for intermediate territorial police command across one District.
        </p>
        <p class="p-modal text-justify">
            A District is composed of multiple Townships. Districts sit below the State, Region, Nay Pyi Taw Union Territory, or relevant Self-Administered Area arrangement.
        </p>
        <p class="p-modal text-justify">
            <b>Responsibilities, role, and functions:</b> District Police Force coordinates district law enforcement, supervises Township Police Forces, supports criminal investigations, manages public order deployments, consolidates operational reports, monitors local security conditions, and coordinates incidents that affect more than one township. It also ensures that township-level policing follows instructions from the relevant State, Region, Nay Pyi Taw, or Self-Administered Area command.
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level5Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
             <img src="{{ asset('images/dot-red.png') }}" style="width:15px; height:15px;">
            <h5 class="modal-title" id="disclaimerLabel">State Police Force / Region Police Force</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal text-justify">
            State Police Force / Region Police Force is the main territorial police command below MPF Headquarters. It translates national police policy into State or Region level policing operations and supervises police activity across its assigned territory.
        </p>
        <p class="p-modal text-justify">
            <b>Led by:</b> Police Brigadier General / Police Colonel level officer, depend on the size, location, and operational importance of the State or Region.
        </p>
        <p class="p-modal text-justify">
            <b>Area of responsibility:</b> One State or one Region. This level corresponds to Myanmar's first-level territorial administration and supervises subordinate District Police Forces, Township Police Forces, police stations, police posts, and police guard posts in the State or Region.
        </p>
        <p class="p-modal text-justify">
            Myanmar has seven States and seven Regions.
        </p>
        <ul>
            <li><b>States:</b> Chin State, Kachin State, Kayah State, Kayin State, Mon State, Rakhine State, and Shan State.</li>
            <li><b>Regions:</b> Ayeyarwady Region, Bago Region, Magway Region, Mandalay Region, Sagaing Region, Tanintharyi Region, and Yangon Region.</li>
        </ul>
        <p class="p-modal text-justify">
            <b>Responsibilities, role, and functions:</b> State Police Force or Region Police Force is responsible for area level police command and territorial law enforcement coordination. Its functions include public order control, crime prevention, security reporting, investigation support, operational planning, inspection of subordinate units, personnel administration, and coordination with relevant civil administration and security bodies. This level consolidates reports from districts and townships, supervises local police operations, and transmits national level directives from MPF Headquarters to subordinate territorial commands.
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="level6Modal" tabindex="-1" aria-labelledby="disclaimerLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/dot-blue-ring-royal-papua.png') }}" style="width:15px; height:15px;">
            <h5 class="modal-title" id="disclaimerLabel">National Police (HQ)</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="p-modal text-justify">
           <b>Command level:</b> National headquarters
        </p>
        <p class="p-modal text-justify">
           <b>Head rank:</b> Major General / Lieutenant General level at Chief level
        </p>
        <p class="p-modal text-justify">
           <b>Subordinate department commander rank:</b> Police Brigadier General / Police Colonel level
        </p>
        <p class="p-modal text-justify">
           Myanmar Police Force Headquarters functions as the national command, control, administration, and coordination centre of the MPF. It supports the Chief of Police in exercising command over the entire police force.
        </p>
        <p class="p-modal text-justify">
            Headquarters functions:
        </p>
        <ul>
            <li>National command and control</li>
            <li>Force administration and personnel management</li>
            <li>Policy and standing-order implementation</li>
            <li>Operational coordination</li>
            <li>Criminal and security coordination</li>
            <li>Training and doctrine development</li>
            <li>Discipline, morale, and welfare supervision</li>
            <li>Logistics, supply, finance, and support services</li>
            <li>International police cooperation</li>
            <li>Coordination with territorial and specialized police formations</li>
        </ul>
        <p class="p-modal text-justify">
            Major headquarters departments and national-level police bodies are normally led by senior officers at Police Colonel level or above. Larger or more sensitive national functions may be led at Police Brigadier General level.
        </p>
      </div>
    </div>
  </div>
</div>


    <div id="map"></div>
</div>

@endsection

@push('service')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.6.0/Control.FullScreen.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// === Inisialisasi Peta ===
const map = L.map('map')
    .setView([-6.80188562253168, 144.0733101155011], 5);

// === Layer ===
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
    { position: 'topleft' }
).addTo(map);

// === Global Variable ===
let policeMarkers = L.featureGroup().addTo(map);
let radiusCircle = null;
let lastClickedLocation = null;
let drawnItems = new L.FeatureGroup().addTo(map);
let drawnPolygonGeoJSON = null;

const drawControl = new L.Control.Draw({
    draw: {
        polygon: {
            allowIntersection: false,
            shapeOptions: {
                color: '#007bff',
                fillColor: '#007bff',
                fillOpacity: 0.2
            }
        },
        polyline: false,
        rectangle: false,
        circle: false,
        marker: false,
        circlemarker: false
    },
    edit: {
        featureGroup: drawnItems
    }
});

map.addControl(drawControl);

// === Fetch Data POLICE ===
async function fetchPoliceData(filters = {}) {
    const params = new URLSearchParams();

    Object.entries(filters).forEach(([k, v]) => {
        if (Array.isArray(v)) v.forEach(x => params.append(`${k}[]`, x));
        else if (v !== '' && v != null) params.append(k, v);
    });

    if (drawnPolygonGeoJSON) {
        params.append('polygon', JSON.stringify(drawnPolygonGeoJSON));
    }

    try {
        const res = await fetch(`/api/polices?${params.toString()}`);
        return res.ok ? await res.json() : [];
    } catch (e) {
        console.error('Error fetching police:', e);
        return [];
    }
}

// === Marker POLICE ===
function addPoliceMarkers(data) {
    policeMarkers.clearLayers();

    data.forEach(police => {
        if (!police.latitude || !police.longitude) return;

        const icon = L.icon({
            iconUrl: police.icon ? police.icon : 'https://png.pngtree.com/png-vector/20221211/ourmid/pngtree-minimal-location-map-icon-logo-symbol-vector-design-transparent-background-png-image_6520892.png',
            iconSize: [12, 12],
            iconAnchor: [15, 30],
            popupAnchor: [0, -25]
        });

        const marker = L.marker(
            [police.latitude, police.longitude],
            { icon: icon }
        ).addTo(policeMarkers)

        marker.bindPopup(`
            <h5>${police.name_police || 'N/A'}</h5>
            <strong>Address:</strong>
                ${police.location || 'N/A'}
                ${police.city_name || 'N/A'}
                ${police.district_name || 'N/A'}
                ${police.province_name || 'N/A'}, Myanmar<br>
            <strong>Phone:</strong> ${police.telephone || 'N/A'}<br>
            <strong>Website:</strong> ${police.website || 'N/A'}<br>
            ${police.id ? `<a href="/police/${police.id}/detail" class="btn btn-primary btn-sm mt-2" style="color:white;">Read More</a>` : ''}
        `);
    });

    if (policeMarkers.getLayers().length > 0) {
        map.fitBounds(policeMarkers.getBounds(), { padding: [50, 50] });
    }
}

// === Apply Filter POLICE ===
async function applyPoliceFilters() {
    const provs = [...document.querySelectorAll('.province-checkbox:checked')].map(e => e.value);
    const categories = [...document.querySelectorAll('input[name="policeCategory"]:checked')].map(e => e.value);
    const policeName = $('#police_name_map').val() || '';
    const radius = parseInt(document.getElementById('radiusRangeMap')?.value || 0);

    let filters = {};

    if (policeName) filters.name = policeName;

    if (provs.length > 0)
        filters.provinces = provs;

    if (categories.length > 0)
        filters.categories = categories;

    if (policeName) filters.name = policeName;
    if (provs.length > 0) filters.provinces = provs;

    if (radius > 0 && lastClickedLocation) {
        filters.radius = radius;
        filters.center_lat = lastClickedLocation.lat;
        filters.center_lng = lastClickedLocation.lng;
    }

    const result = await fetchPoliceData(filters);

    const polices = result.polices;
    const categoryCounts = result.categoryCounts;

    addPoliceMarkers(polices);

    document.getElementById('totalCountDisplay').innerHTML =
        `<strong>Police:</strong> ${polices.length}`;

    Object.keys(categoryCounts).forEach(cat => {

        const id = cat.replace(/[^a-zA-Z0-9]/g,'-');

        const el = document.getElementById(`count-${id}`);

        if (el) {
            el.textContent = categoryCounts[cat];
        }
    });
}

// === Klik Map untuk radius ===
map.on('click', e => {
    lastClickedLocation = {
        lat: e.latlng.lat,
        lng: e.latlng.lng
    };

    const radius = parseInt(document.getElementById('radiusRangeMap').value || 0);

    if (radiusCircle) map.removeLayer(radiusCircle);

    radiusCircle = L.circle(lastClickedLocation, {
        color: 'blue',
        fillOpacity: 0.2,
        radius: radius * 1000
    }).addTo(map);

    applyPoliceFilters();
});

map.on(L.Draw.Event.CREATED, e => {
    drawnItems.clearLayers();
    drawnItems.addLayer(e.layer);

    drawnPolygonGeoJSON = e.layer.toGeoJSON();

    applyPoliceFilters(); // ✅ ganti ke police
});

map.on(L.Draw.Event.EDITED, e => {
    e.layers.eachLayer(layer => {
        drawnPolygonGeoJSON = layer.toGeoJSON();
    });

    applyPoliceFilters();
});

map.on(L.Draw.Event.DELETED, () => {
    drawnItems.clearLayers();
    drawnPolygonGeoJSON = null;

    applyPoliceFilters();
});

// === Select2 Police ===
$(document).ready(function() {
    $('#police_name_map').select2({
        width: '100%',
        placeholder: 'Search Police'
    });

    $('#police_name_map').on('change', function() {
        applyPoliceFilters();
    });
});

const FilterPanel = L.Control.extend({
    options: { position: 'topright' },

    onAdd: function () {
        const div = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');

        Object.assign(div.style, {
            background: 'white',
            borderRadius: '6px',
            boxShadow: '0 2px 6px rgba(0,0,0,0.2)',
            minWidth: '300px',
            maxWidth: '300px',
            maxHeight: '70vh',
            overflowY: 'auto',
            fontSize: '11px',
            padding: '0'
        });

        div.innerHTML = `
            <button style="background:#007bff;color:white;border:none;width:100%;padding:8px;">
                Filter & Radius (Police)
            </button>

            <div style="padding:10px;">

                <strong>Radius: <span id="radiusValueMap">0</span> km</strong>
                <input type="range" id="radiusRangeMap" min="0" max="500" value="0"
                    style="width:100%;margin-bottom:6px;">

                <div style="display:flex;gap:5px;">
                    <button id="applyRadiusMap" class="btn btn-sm btn-primary flex-fill">Apply</button>
                    <button id="resetRadiusMap" class="btn btn-sm btn-danger flex-fill">Reset</button>
                </div>

                <hr>

                <label>Police Name:</label>
                <select id="police_name_map" class="form-select form-select-sm mb-2">
                    <option value="">Select Police</option>
                    @foreach($policeNames as $n)
                        <option value="{{ $n }}">{{ $n }}</option>
                    @endforeach
                </select>

                <hr>

                <label>Category:</label>

                ${[
                    'National Police (HQ)',
                    'State / Region Police Command',
                    'District Police Command',
                    'Township Police Station',
                ].map(c => `
                <label style="display:block;font-size:13px;margin-bottom:4px;">
                    <input type="checkbox" name="policeCategory" value="${c}">
                    ${c} (<span id="count-${c.replace(/[^a-zA-Z0-9]/g,'-')}">0</span>)
                </label>
                `).join('')}

                <hr>

                <strong>Region / State</strong>
                <div style="max-height:120px;overflow-y:auto;border:1px solid #ccc;padding:5px;border-radius:5px;margin-top:6px;">
                    @foreach ($provinces as $p)
                        <div class="form-check">
                            <input class="form-check-input province-checkbox" type="checkbox" value="{{ $p->id }}">
                            <label class="form-check-label">{{ $p->provinces_region }}</label>
                        </div>
                    @endforeach
                </div>

                <hr>

                <button id="resetMapFilter" class="btn btn-sm btn-secondary w-100">
                    Reset All
                </button>

                <div id="totalCountDisplay"
                    style="margin-top:8px;text-align:center;font-size:13px;">
                </div>

            </div>
        `;

        // === AMBIL ELEMENT DARI DIV (WAJIB)
        const radiusSlider = div.querySelector('#radiusRangeMap');
        const radiusLabel = div.querySelector('#radiusValueMap');
        const applyBtn = div.querySelector('#applyRadiusMap');
        const resetRadiusBtn = div.querySelector('#resetRadiusMap');
        const resetAllBtn = div.querySelector('#resetMapFilter');

        // === SLIDER
        radiusSlider.addEventListener('input', () => {
            const r = parseInt(radiusSlider.value || 0);
            radiusLabel.textContent = r;

            if (lastClickedLocation) {
                if (radiusCircle) map.removeLayer(radiusCircle);

                radiusCircle = L.circle(lastClickedLocation, {
                    color: 'blue',
                    fillOpacity: 0.2,
                    radius: r * 1000
                }).addTo(map);
            }
        });

        // === APPLY
        applyBtn.addEventListener('click', async () => {
            const radius = parseInt(radiusSlider.value || 0);

            if (radius > 0 && !lastClickedLocation) {
                alert('Klik peta dulu untuk menentukan titik radius');
                return;
            }

            await applyPoliceFilters();
        });

        // === RESET RADIUS
        resetRadiusBtn.addEventListener('click', async () => {
            radiusSlider.value = 0;
            radiusLabel.textContent = 0;

            if (radiusCircle) {
                map.removeLayer(radiusCircle);
                radiusCircle = null;
            }

            lastClickedLocation = null;

            await applyPoliceFilters();
        });

        // === RESET ALL
        resetAllBtn.addEventListener('click', async () => {

            // checkbox
            div.querySelectorAll('.province-checkbox').forEach(cb => cb.checked = false);
            div.querySelectorAll('[name="policeCategory"]').forEach(cb => cb.checked = false);

            // select2
            $('#police_name_map').val('').trigger('change');

            // radius
            radiusSlider.value = 0;
            radiusLabel.textContent = 0;

            if (radiusCircle) {
                map.removeLayer(radiusCircle);
                radiusCircle = null;
            }

            lastClickedLocation = null;

            // polygon
            if (drawnItems) drawnItems.clearLayers();
            drawnPolygonGeoJSON = null;

            await applyPoliceFilters();
        });

        L.DomEvent.disableClickPropagation(div);
        return div;
    }
});

map.addControl(new FilterPanel());

// === Event Filter ===
document.addEventListener('change', e => {
    if (
        e.target.classList.contains('province-checkbox') ||
        e.target.name === 'policeCategory'
    ) {
        applyPoliceFilters();
    }
});

document.addEventListener('input', function(e) {
    if (e.target.id === 'radiusRangeMap') {
        const r = parseInt(e.target.value || 0);
        document.getElementById('radiusValueMap').textContent = r;

        // update circle langsung (UX lebih bagus)
        if (lastClickedLocation) {
            if (radiusCircle) map.removeLayer(radiusCircle);

            radiusCircle = L.circle(lastClickedLocation, {
                color: 'blue',
                fillOpacity: 0.2,
                radius: r * 1000
            }).addTo(map);
        }
    }
});

document.addEventListener('click', async function(e) {

  // APPLY RADIUS
    if (e.target.id === 'applyRadiusMap') {

        const radius = parseInt(document.getElementById('radiusRangeMap').value || 0);

        if (radius > 0 && !lastClickedLocation) {
            alert('Klik lokasi di peta dulu untuk menentukan titik radius');
            return;
        }

        await applyPoliceFilters();
    }

    // === RESET ALL ===
    if (e.target.id === 'resetMapFilter') {

        // 1. Reset checkbox provinsi
        document.querySelectorAll('.province-checkbox').forEach(cb => cb.checked = false);

        // 2. Reset select police (select2)
        $('#police_name_map').val('').trigger('change');

        // 3. Reset radius
        const radiusSlider = document.getElementById('radiusRangeMap');
        if (radiusSlider) {
            radiusSlider.value = 0;
            document.getElementById('radiusValueMap').textContent = 0;
        }

        // 4. Hapus circle radius
        if (radiusCircle) {
            map.removeLayer(radiusCircle);
            radiusCircle = null;
        }

        // 5. Reset titik klik
        lastClickedLocation = null;

        // 6. Hapus polygon
        if (drawnItems) {
            drawnItems.clearLayers();
        }
        drawnPolygonGeoJSON = null;

        // 7. Reload data
        await applyPoliceFilters();
    }

});

// === Init ===
applyPoliceFilters();
</script>

@endpush
