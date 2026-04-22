<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Myanmar Lab Classification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table-header {
            background-color: #5b87c5;
            color: white;
        }
        .type-cell {
            background-color: #5b87c5;
            color: white;
            font-weight: bold;
            width: 120px;
        }
        .section-title {
            background-color: #9fb3c8;
            padding: 8px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body class="container">

<nav class="navbar">
        <a href="/home">
            <img src="{{ asset('images/CMT-logo.png') }}" alt="CMT Logo" class="brand-image">
        </a>
</nav>

<div class="container my-5">

    <div class="card shadow-sm">
    <table class="table table-bordered">
        <thead>
            <tr class="table-header">
                <th>Laboratory</th>
                <th>Hospital Class</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="type-cell">Type A</td>
                <td>
                    Tertiary Hospitals<br>
                    Secondary Level Hospital (State/Regional Hospitals)
                </td>
            </tr>
            <tr>
                <td class="type-cell">Type B</td>
                <td>Secondary Level Hospital (District Hospitals)</td>
            </tr>
            <tr>
                <td class="type-cell">Type C</td>
                <td>Primary Level Hospital (Township and Station Hospitals)</td>
            </tr>
        </tbody>
    </table>

    <h4 class="fw-bold">Type A Laboratory</h4>

    <!-- General Hematology -->
    <div class="section-title">General Hematology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>CP (Manual)</li>
                <li>ESR</li>
                <li>H inclusion body</li>
                <li>APTT</li>
                <li>G6PD (Qualitative)</li>
                <li>RA (Qualitative)</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>CP (FBC 18/26)</li>
                <li>Platelet count</li>
                <li>BT, CT</li>
                <li>LE cell</li>
                <li>ABO grouping</li>
                <li>Hb %</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Retic count</li>
                <li>PT/INR</li>
                <li>Singer’s test</li>
                <li>Rh grouping</li>
            </ul>
        </div>
    </div>

    <!-- Biochemistry -->
    <div class="section-title">Biochemistry</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Glucose (FBS, RBS, 2HPP, OGTT)</li>
                <li>Lipid profile</li>
                <li>LDH</li>
                <li>Urea</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Amylase</li>
                <li>Electrolytes (Na,K,Cl,HCO3)</li>
                <li>Liver function</li>
                <li>CKMB</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Creatinine</li>
                <li>Calcium</li>
                <li>Protein profile</li>
                <li>Uric acid</li>
                <li>HbA1c</li>
            </ul>
        </div>
    </div>

    <!-- Immunology -->
    <div class="section-title">Immunology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>T3,T4,TSH</li>
                <li>PSA</li>
                <li>Widal</li>
                <li>HBsAg</li>
                <li>Dengue</li>
                <li>Syphilis</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>AFP</li>
                <li>ASO</li>
                <li>VDRL/RPR/TPHA</li>
                <li>Anti-HBs</li>
                <li>Malaria</li>
                <li>CD4</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>CEA</li>
                <li>CRP</li>
                <li>HIV Ab</li>
                <li>Anti-HCV</li>
                <li>Filaria</li>
            </ul>
        </div>
    </div>

    <!-- Histopathology -->
    <div class="section-title">Histopathology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Biopsy (H&E)</li>
                <li>FNAC</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Pap smear</li>
                <li>FNAB</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Fluid cytology</li>
            </ul>
        </div>
    </div>

    <!-- Microbiology -->
    <div class="section-title">Microbiology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Culture & sensitivity</li>
                <li>ZN stain</li>
                <li>Urine RE</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Microscopy</li>
                <li>Indian ink</li>
                <li>Stool RE</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Gram stain</li>
                <li>Giemsa stain</li>
            </ul>
        </div>
    </div>

    <h4 class="main-title">Type B Laboratory</h4>

    <!-- General Hematology -->
    <div class="section-title">General Hematology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Hb %</li>
                <li>ESR</li>
                <li>H inclusion body</li>
                <li>ABO grouping</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>CP (Manual)</li>
                <li>Platelet count</li>
                <li>BT, CT</li>
                <li>Rh grouping</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>CP (FBC 18)</li>
                <li>Retic count</li>
                <li>PCV</li>
                <li>RA (Qualitative)</li>
            </ul>
        </div>
    </div>

    <!-- Biochemistry -->
    <div class="section-title">Biochemistry</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Glucose</li>
                <li>Liver function</li>
                <li>Urea</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Electrolytes</li>
                <li>Total protein</li>
                <li>Creatinine</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Lipid profile</li>
                <li>Uric acid</li>
            </ul>
        </div>
    </div>

    <!-- Immunology -->
    <div class="section-title">Immunology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>VDRL/RPR</li>
                <li>Anti-HCV</li>
                <li>Widal</li>
                <li>Filaria</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>HIV Ab</li>
                <li>Syphilis</li>
                <li>Dengue</li>
                <li>CD4</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>HBsAg</li>
                <li>ASO</li>
                <li>Malaria</li>
                <li>CRP</li>
            </ul>
        </div>
    </div>

    <!-- Microbiology -->
    <div class="section-title">Microbiology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Microscopy</li>
                <li>Indian ink</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Gram stain</li>
                <li>Giemsa stain</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>ZN stain</li>
                <li>Urine RE</li>
            </ul>
        </div>
    </div>


    <!-- ================= TYPE C ================= -->
    <h4 class="main-title">Type C Laboratory</h4>

    <!-- General Hematology -->
    <div class="section-title">General Hematology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Hb %</li>
                <li>Retic count</li>
                <li>ABO grouping</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>T & DC</li>
                <li>BT, CT</li>
                <li>Rh grouping</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Platelet count</li>
                <li>PCV</li>
                <li>ESR</li>
            </ul>
        </div>
    </div>

    <!-- Biochemistry -->
    <div class="section-title">Biochemistry</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Glucose</li>
                <li>ALP</li>
                <li>Urea</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Total cholesterol</li>
                <li>Total protein</li>
                <li>Creatinine</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Total bilirubin</li>
                <li>Uric acid</li>
            </ul>
        </div>
    </div>

    <!-- Immunology -->
    <div class="section-title">Immunology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Syphilis</li>
                <li>Anti-HCV</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>HIV Ab</li>
                <li>Malaria</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>HBsAg</li>
            </ul>
        </div>
    </div>

    <!-- Microbiology -->
    <div class="section-title">Microbiology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Microscopy</li>
                <li>Indian ink</li>
                <li>Stool RE</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Gram stain</li>
                <li>Giemsa stain</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>ZN stain</li>
                <li>Urine RE</li>
            </ul>
        </div>
    </div>

     <h4 class="main-title">Type A (Central) Laboratory</h4>

    <!-- General Hematology -->
    <div class="section-title">General Hematology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>CP (Manual)</li>
                <li>ESR</li>
                <li>H inclusion body</li>
                <li>APTT</li>
                <li>G6PD (Qualitative)</li>
                <li>RA (Qualitative)</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>CP (FBC 18/26)</li>
                <li>Platelet count</li>
                <li>BT, CT</li>
                <li>LE cell</li>
                <li>ABO grouping</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Hb %</li>
                <li>Retic count</li>
                <li>PT/INR</li>
                <li>Singer’s test</li>
                <li>Rh grouping</li>
            </ul>
        </div>
    </div>

    <!-- Special Hematology -->
    <div class="section-title">Special Hematology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>D-dimer</li>
            </ul>
        </div>
    </div>

    <!-- Biochemistry -->
    <div class="section-title">Biochemistry</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Glucose (FBS, RBS, 2HPP, OGTT)</li>
                <li>Lipid profile</li>
                <li>LDH</li>
                <li>Urea</li>
                <li>Amylase</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Creatinine clearance</li>
                <li>Electrolytes (Na,K,Cl,HCO3)</li>
                <li>Liver function</li>
                <li>CKMB</li>
                <li>Creatinine</li>
                <li>Urine microalbumin</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Urine electrolytes</li>
                <li>Calcium</li>
                <li>Protein profile</li>
                <li>Uric acid</li>
                <li>HbA1c</li>
                <li>Urine creatinine</li>
            </ul>
        </div>
    </div>

    <!-- Immunology -->
    <div class="section-title">Immunology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>T3,T4,TSH</li>
                <li>PSA</li>
                <li>Widal</li>
                <li>HBsAg</li>
                <li>Dengue</li>
                <li>Syphilis</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>AFP</li>
                <li>ASO</li>
                <li>VDRL/RPR/TPHA</li>
                <li>Anti-HBs</li>
                <li>Malaria</li>
                <li>CD4</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>CEA</li>
                <li>CRP</li>
                <li>HIV Ab</li>
                <li>Anti-HCV</li>
                <li>Filaria</li>
            </ul>
        </div>
    </div>

    <!-- Histopathology -->
    <div class="section-title">Histopathology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Biopsy (H&E)</li>
                <li>FNAC</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Pap smear</li>
                <li>FNAB</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Fluid cytology</li>
                <li>Special stain (PAS, Trichrome)</li>
            </ul>
        </div>
    </div>

    <!-- Immunochemistry -->
    <div class="section-title">Immunochemistry</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>ER</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>PR</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>HER2/neu</li>
            </ul>
        </div>
    </div>

    <!-- Microbiology -->
    <div class="section-title">Microbiology</div>
    <div class="row mt-2">
        <div class="col-md-4">
            <ul>
                <li>Culture & sensitivity</li>
                <li>ZN stain</li>
                <li>Urine RE</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Microscopy</li>
                <li>Indian ink</li>
                <li>Stool RE</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Gram stain</li>
                <li>Giemsa stain</li>
            </ul>
        </div>
    </div>

    </div>

</div>
<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
