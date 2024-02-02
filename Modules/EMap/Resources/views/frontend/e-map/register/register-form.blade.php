@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section mt-lg-5 ">
        <div class="container-fluid">
            <div class="row d-flex mt-5 ">
                    <div class="breadcrumb d-flex">
                        <div>
                            <a class="whitespace-nowrap text-primary-500" href="{{url('e-map')}}">ई-नक्सा</a>
                            <i class="fa fa-angle-double-right text-light"></i>
                            <a class=" text-primary-500">नक्सा दर्ता</a>
                        </div>
                    </div>
                    <h4 class="fw-semibold heading-line">नक्सा दर्ता फर्म</h4>
                    <p>तल दिएको फर्म लाई ३ तह मा पुरा गर्नुहोस् र आफुले भरेको फर्म ठीक छ छैन प्रमाणित गरी पठाउनुहोस्
                        ।</p>
                    <div class="card-01">
                        <form class="p-2">
                            <div class="col-md-4 ms-4">
                                <label class="form-label">परामर्शदाता प्रकार:</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>--- परामर्शदाता छान्नुहोस् ---</option>
                                    <option value="1">संगठन</option>
                                    <option value="2">व्यक्ति</option>
                                </select>
                            </div>
                            <h5>व्यक्तिगत विवरण</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">पुरा नाम</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="नेपालीमा">
                                                <input type="text" class="form-control" placeholder="In English">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="email" class="form-label">इमेल</label>
                                            <input type="text" class="form-control" id="email" placeholder="इमेल">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="phone" class="form-label">सम्पर्क नम्बर</label>
                                            <input type="text" class="form-control" id="phone"
                                                   placeholder="सम्पर्क नम्बर">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="gender" class="form-label">लिङ्ग</label>
                                            <select class="form-select" id="gender">
                                                <option selected>--- लिङ्ग छान्नुहोस् ---</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="marital" class="form-label">वैवाहिक स्थिति </label>
                                            <select class="form-select" id="marital">
                                                <option selected>--- वैवाहिक स्थिति ---</option>
                                                <option value="Married">Married</option>
                                                <option value="UnMarried">UnMarried</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="inputfname" class="form-label">बुवाको नाम</label>
                                            <input type="text" class="form-control" id="inputfname"
                                                   placeholder="बुवाको नाम">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="inputGname" class="form-label">हजुर बुवाको नाम</label>
                                            <input type="text" class="form-control" id="inputGname"
                                                   placeholder="हजुर बुवाको नाम">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputpan" class="form-label">प्यान न:</label>
                                            <input type="text" class="form-control" id="inputpan" placeholder="प्यान न">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputnec" class="form-label">यन.इ.सि</label>
                                            <input type="text" class="form-control" id="inputnec" placeholder="यन.इ.सि">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="customFile">यन.इ.सि प्रमाणपत्र </label>
                                            <input type="file" class="form-control" id="customFile"/>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="inputusername" class="form-label">प्रयोगकार्तको नाम</label>
                                            <input type="text" class="form-control" id="inputusername"
                                                   placeholder="प्रयोगकार्तको नाम">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="inputpassword" class="form-label">पासवर्ड</label>
                                            <input type="text" class="form-control" id="inputpassword"
                                                   placeholder="पासवर्ड">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="confirm_password" class="form-label">पासवर्ड सुनिश्चित
                                                गर्नुहोस</label>
                                            <input type="text" class="form-control" id="confirm_password"
                                                   placeholder="पासवर्ड सुनिश्चित गर्नुहोस ">
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row g-3">
                                        <h4 class="title">नागरिकता बिबरण</h4>
                                        <div class="col-md-3">
                                            <label for="inputcitizen" class="form-label">नागरिता न:</label>
                                            <input type="text" class="form-control" id="inputcitizen"
                                                   placeholder="नागरिता न">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputcitizenahip" class="form-label"> जारी जिल्ला</label>
                                            <select class="form-select" id="inputcitizenahip">
                                                <option selected>---जारि जिल्ला ----</option>
                                                <option value="test">test</option>
                                                <option value="test">test</option>
                                                <option value="test">test</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputdate" class="form-label">जारी मिति</label>
                                            <input type="date" class="form-control" id="inputdate">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="customFile">नागरिकता अपलोड गर्नुहोस्</label>
                                            <input type="file" class="form-control" id="customFile"/>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around mt-2">
                                        <button class="px-8" mat-flat-button [color]="'primary'" type="button"
                                                matStepperNext>Next
                                        </button>
                                    </div>
                                </mat-step>
                                <mat-step [formGroupName]="'step2'" [stepControl]="horizontalStepperForm.get('step2')">
                                    <ng-template matStepLabel>ठेगाना</ng-template>
                                    <div class="address">
                                        <h4 class="title">स्थाहि ठेगाना</h4>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="par" class="form-label">प्रदेश</label>
                                                <select class="form-select" id="par">
                                                    <option selected>--- प्रदेश छान्नुहोस् ----</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="dist" class="form-label">जिल्ला</label>
                                                <select class="form-select" id="dist">
                                                    <option selected>--- जिल्ला छान्नुहोस् ----</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="muni" class="form-label">नगरपालिका</label>
                                                <select class="form-select" id="muni">
                                                    <option selected>--- नगरपालिका छान्नुहोस् ---</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="ward" class="form-label">वार्ड न:</label>
                                                <select class="form-select" id="ward">
                                                    <option selected>--- वार्ड न ---</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputaddress" class="form-label">गाउ/टोल</label>
                                                <input type="text" class="form-control" id="inputaddress"
                                                       placeholder="गाउ/टोल">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputaddresss" class="form-label">Village/Tole</label>
                                                <input type="text" class="form-control" id="inputaddresss"
                                                       placeholder="Village/Tole">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="address">
                                        <h4 class="title">अस्थाहि ठेगाना</h4>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="pard" class="form-label">प्रदेश</label>
                                                <select class="form-select" id="pard">
                                                    <option selected>--- प्रदेश छान्नुहोस् ----</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="district" class="form-label">जिल्ला</label>
                                                <select class="form-select" id="district">
                                                    <option selected>--- जिल्ला छान्नुहोस् ----</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="munici" class="form-label">नगरपालिका</label>
                                                <select class="form-select" id="munici">
                                                    <option selected>--- नगरपालिका छान्नुहोस् ---</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="wardno" class="form-label">वार्ड न:</label>
                                                <select class="form-select" id="wardno">
                                                    <option selected>--- वार्ड न ---</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputadd" class="form-label">गाउ/टोल</label>
                                                <input type="text" class="form-control" id="inputadd"
                                                       placeholder="गाउ/टोल">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputaddr" class="form-label">Village/Tole</label>
                                                <input type="text" class="form-control" id="inputaddr"
                                                       placeholder="Village/Tole">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="d-flex justify-content-around mt-2">
                                        <button class="px-8 mr-2" mat-flat-button [color]="'accent'" type="button"
                                                matStepperPrevious>
                                            Back
                                        </button>
                                        <button class="px-8" mat-flat-button [color]="'primary'" type="button"
                                                matStepperNext>
                                            Next
                                        </button>
                                    </div>
                                </mat-step>

                                <mat-step [formGroupName]="'step3'" [stepControl]="horizontalStepperForm.get('step3')">
                                    <ng-template matStepLabel>संगठन विवरण</ng-template>
                                    <div class="org">
                                        <h5 class="title">संगठन विवरण</h5>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">संगठन नाम</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="नेपालीमा">
                                                <input type="text" class="form-control" placeholder="In English">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inpute" class="form-label">इमेल</label>
                                            <input type="text" class="form-control" id="inpute" placeholder="इमेल">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputp" class="form-label">सम्पर्क नम्बर</label>
                                            <input type="text" class="form-control" id="inputp" placeholder="सम्पर्क">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inpuco" class="form-label">कम्पनी दर्ता न:</label>
                                            <input type="text" class="form-control" id="inpuco"
                                                   placeholder="कम्पनी दर्ता न">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="inputpa" class="form-label">प्यान न:</label>
                                            <input type="text" class="form-control" id="inputpa" placeholder="प्यान न">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="customFile">संगठनको लोगो राख्नुहोस</label>
                                            <input type="file" class="form-control" id="customFile"/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm">
                                            <label class="form-label" for="customFile">कम्पनी प्रमाणपत्र:</label>
                                            <input type="file" class="form-control" id="customFile"/>
                                        </div>
                                        <div class="col-sm">
                                            <label class="form-label" for="customFile">प्यान प्रमाणपत्र:</label>
                                            <input type="file" class="form-control" id="customFile"/>
                                        </div>
                                        <div class="col-sm">
                                            <label class="form-label" for="customFile">कर चुक्ता:</label>
                                            <input type="file" class="form-control" id="customFile"/>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="address">
                                        <h4 class="title">अस्थाहि ठेगाना</h4>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="pardesh" class="form-label">प्रदेश</label>
                                                <select class="form-select" id="pardesh">
                                                    <option selected>--- प्रदेश छान्नुहोस् ----</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="distri" class="form-label">जिल्ला</label>
                                                <select class="form-select" id="distri">
                                                    <option selected>--- जिल्ला छान्नुहोस् ----</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="municipality" class="form-label">नगरपालिका</label>
                                                <select class="form-select" id="municipality">
                                                    <option selected>--- नगरपालिका छान्नुहोस् ---</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="wardn" class="form-label">वार्ड न:</label>
                                                <select class="form-select" id="wardn">
                                                    <option selected>--- वार्ड न ---</option>
                                                    <option value="test">test</option>
                                                    <option value="test">test</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputaddresss" class="form-label">गाउ/टोल</label>
                                                <input type="text" class="form-control" id="inputaddresss"
                                                       placeholder="गाउ/टोल">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputad" class="form-label">Village/Tole</label>
                                                <input type="text" class="form-control" id="inputad"
                                                       placeholder="Village/Tole">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-arou mt-2">
                                        <button class="px-8 mr-2" mat-flat-button [color]="'accent'" type="button"
                                                matStepperPrevious>
                                            Back
                                        </button>
                                        <button class="px-8" mat-flat-button [color]="'primary'" type="button"
                                                matStepperNext>
                                            Next
                                        </button>
                                    </div>
                                </mat-step>

                                <mat-step>
                                    <ng-template matStepLabel>Done</ng-template>
                                    <p class="my-6 font-medium">
                                        Thank you for completing our form! You can reset the form if you would like to
                                        change your information.
                                    </p>
                                    <div class="flex justify-end mt-8">
                                        <button class="px-8 mr-2" mat-flat-button [color]="'accent'" type="button"
                                                matStepperPrevious>
                                            Back
                                        </button>
                                        <button class="px-8" mat-flat-button [color]="'primary'" type="reset"
                                                (click)="horizontalStepper.reset();">
                                            Reset
                                        </button>
                                    </div>
                                </mat-step>
                            </mat-stepper>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection
