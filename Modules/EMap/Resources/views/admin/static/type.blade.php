@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.circular.registration.index')}}">ई-नक्सा </a>
                        </li>
                        <li class="breadcrumb-item active">नक्सा विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">ई-नक्सा</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col">
                                <form class="d-flex justify-content-around">
                                    <div class="col-md-4">
                                        <label for="Submission_no">Submission No</label>
                                        <input type="number" class="form-control" id="Submission_no"
                                               placeholder="Submission No">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="phone_no">Phone No</label>
                                        <input type="number" class="form-control" id="phone_no"
                                               placeholder="phone no">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="text-md-end mt-5 mt-md-0">
                                    <button type="button" class="btn btn-danger waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target="#custom-modal"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Search
                                    </button>
                                </div>
                            </div><!-- end col-->
                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>
    <section class="inner-section mt-lg-5 ">
        <div class="container">
            <div class="row d-flex ">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card mb_30">
                            <div class="card-body p-3">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">क्र.स</th>
                                        <th rowspan="2">निवेदन/प्रतिवेदन किसिम</th>
                                        <th rowspan="2">पेज नं.</th>
                                        <th colspan="3">जिम्मेवार</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="text-center">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>घरधनी</td>
                                        <td>उप-महानगरपालिका</td>
                                        <td>परामर्शदाता/सुपरिवेक्षण</td>
                                    </tr>
                                    <tr>
                                        <td>१.</td>
                                        <td>नक्सा बनाउने प्राविधिकद्धारा मन्जुरी पत्र</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>२.</td>
                                        <td>भवन डिजाईनको प्राविधिकद्धारा मन्जुरी पत्र</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>३.</td>
                                        <td>भवन निर्माण गर्ने ठेकेदारद्धारा मन्जुरी पत्र</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>४.</td>
                                        <td>भवन डिजाईन विवरण</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>५.</td>
                                        <td>भवन अनुपालन चेकलिष्ट</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>६.</td>
                                        <td>दस्तुर तथा दर्ता सम्बन्धी</td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>७.</td>
                                        <td>संधियारको नाममा जारी भएको सूचनाबारे</td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>८.</td>
                                        <td>सूचना बुझाएको भर्पाई तथा टाँस मुचुल्का बारे</td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>९.</td>
                                        <td>सार्जमिन मुचुल्का</td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>१०.</td>
                                        <td>सार्जमिनमा उ.न.पा.प्राविधिकको प्रतिवेदन</td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>११.</td>
                                        <td>अमिन प्रतिवेदन</td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>१२.</td>
                                        <td>प्लिन्थ लेभलसम्मको निर्माण कार्य<br>
                                            इजाजतको लागि निवेदन
                                        </td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>१३.</td>
                                        <td>लेआउट तथा जग जाँचको लागि निवेदन</td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>१४.</td>
                                        <td>लेआउट गरेको प्रतिवेदन</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                    </tr>
                                    <tr>
                                        <td>१५.</td>
                                        <td>सुपरस्ट्रक्चरको निर्माण कार्य <br>
                                            इजाजतको लागि निवेदन
                                        </td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>१६.</td>
                                        <td>निर्माण कार्य सम्पन्न प्रमाण-पत्रको<br>
                                            लागि निवेदन
                                        </td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>१७.</td>
                                        <td>वारेसनामा</td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>१८.</td>
                                        <td>मन्जुरीनामा</td>
                                        <td></td>
                                        <td><i class="fas fa-check"></i></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
